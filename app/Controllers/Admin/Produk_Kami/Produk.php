<?php

namespace App\Controllers\Admin\Produk_Kami;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produk_model;

    public function __construct()
    {
        $this->produk_model = new ProdukModel();
    }

    public function index()
    {
        $prducts = $this->produk_model->getAllProduct('', '', 'produk.created_at', 'DESC');

        $data = [
            'title' =>  'Manajemen Produk - Badan Pengelola Aset KM UII',
            'products'  => $prducts,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk - Badan Pengelola Aset KM UII',
            'validation'    =>  \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/produk/tambah_produk', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $this->error_message['regex_match'] = 'Kontak harus di awali angka 0';

        $rules = [
            'nama_produk'   =>  [
                'rules' =>  'required|is_unique[produk.nama_produk]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'detail_produk' =>  [
                'rules' =>  'required|min_length[18]', // Detail produk memiliki default 9 karakter karena ketambahan tag p
                'errors'    =>  [
                    'required'  =>  'Tidak boleh kosong',
                    'min_length'    =>  'Minimal berisi 10 karakter'
                ]
            ],
            'kontak' =>  [
                'rules' =>  'permit_empty|min_length[3]|max_length[15]|numeric|regex_match[/^0/]',
                'errors'    => $this->error_message
            ],
            'path_gambar_cover' =>  [
                'rules' =>  'uploaded[path_gambar_cover]|max_size[path_gambar_cover,8024]|is_image[path_gambar_cover]|mime_in[path_gambar_cover,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/produk/tambah'))->withInput();

        $nama_produk = $this->request->getPost('nama_produk');
        $slug_produk = url_title($nama_produk, '-', true);
        $detail_produk = $this->request->getPost('detail_produk');
        $kontak = $this->request->getPost('kontak');

        $files = $this->request->getFile('path_gambar_cover');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_gambar_cover = $image_name . '_' . $files->getRandomName();
        $path_nama_gambar = $files->getName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $path_gambar_cover);
        } else {
            $files->move('uploaded/images/', $path_gambar_cover);
        }

        // $files->move('uploaded/images/', $path_gambar_cover);

        $data = [
            'nama_produk'     => $nama_produk,
            'slug_produk' => $slug_produk,
            'detail_produk'    => $detail_produk,
            'kontak'    =>  $kontak,
            'path_gambar_cover' => $path_gambar_cover,
            'path_nama_gambar' => $path_nama_gambar
        ];

        $this->produk_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Produk');

        return redirect()->to(base_url('admin/produk'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_produk = $this->request->getPost('slug_produk');
        $nama_produk = $this->request->getPost('nama_produk');
        $product = $this->produk_model->getAllProduct('', $slug_produk);

        $nama_produk_rules = 'required|min_length[3]|max_length[255]';

        ($nama_produk !== $product[0]->nama_produk) ? $nama_produk_rules .= '|is_unique[produk.nama_produk]' :  '';

        $this->error_message['regex_match'] = 'Kontak harus di awali angka 0';
        $rules = [
            'nama_produk'   =>  [
                'rules' =>  $nama_produk_rules,
                'errors'    =>  $this->error_message
            ],
            'kontak' =>  [
                'rules' =>  'permit_empty|min_length[3]|max_length[15]|numeric|regex_match[/^0/]',
                'errors'    => $this->error_message
            ],
            'detail_produk' =>  [
                'rules' =>  'required|min_length[18]', // Detail produk memiliki default 9 karakter karena ketambahan tag p
                'errors'    =>  [
                    'required'  =>  'Tidak boleh kosong',
                    'min_length'    =>  'Minimal berisi 10 karakter'
                ]
            ],
            'path_gambar_cover' =>  [
                'rules' =>  'max_size[path_gambar_cover,8024]|is_image[path_gambar_cover]|mime_in[path_gambar_cover,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/produk/edit/' . $slug_produk))->withInput();

        $nama_produk = $this->request->getPost('nama_produk');
        $slug_produk = url_title($nama_produk, '-', true);
        $detail_produk = $this->request->getPost('detail_produk');
        $kontak = $this->request->getPost('kontak');

        $files = $this->request->getFile('path_gambar_cover');
        $path_gambar_cover_old = $this->request->getPost('path_gambar_cover');
        $path_gambar_cover = $product[0]->path_gambar_cover;
        $path_nama_gambar = $product[0]->path_nama_gambar;

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_gambar_cover = $image_name . '_' . $files->getRandomName();
            $path_nama_gambar = $files->getName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_gambar_cover);
            } else {
                $files->move('uploaded/images/', $path_gambar_cover);
            }

            // $files->move('uploaded/images/', $path_gambar_cover);

            (is_file('uploaded/images/' . $path_gambar_cover_old) && $path_gambar_cover_old !== 'default.png') ? unlink('uploaded/images/' . $path_gambar_cover_old) : '';
        }

        $slug_produk = url_title($nama_produk, '-', true);

        $data = [
            'nama_produk'     => $nama_produk,
            'slug_produk' => $slug_produk,
            'detail_produk'    => $detail_produk,
            'kontak'    => $kontak,
            'path_gambar_cover' => $path_gambar_cover,
            'path_nama_gambar' => $path_nama_gambar
        ];

        $this->produk_model->update($product[0]->id_produk, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Produk');

        return redirect()->to(base_url('admin/produk'));
    }

    public function edit($slug_produk)
    {
        $product = $this->produk_model->getAllProduct('', $slug_produk);

        if (!$product) throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk $slug_produk tidak ditemukan");

        $data = [
            'title' => "Edit Produk - " . $product[0]->nama_produk,
            'product'   => $product,
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/produk/edit_produk', $data);
    }

    public function delete($id)
    {
        $product = $this->produk_model->find($id);

        try {
            $this->produk_model->delete($id);
        } catch (\Exception $e) {
            $message = 'Data berkaitan dengan <b>' . $product['nama_produk'] . '</b> harus dihapus terlebih dahulu. Cek di admin <b>Paket</b>, <b>Gambar Produk</b>, atau <b>Pesanan</b>';
            session()->setFlashdata('message', $message);

            return redirect()->to(base_url('admin/produk'));
        }

        if (is_file('uploaded/images/' . $product['path_gambar_cover']) && $product['path_gambar_cover'] !== 'default.png') {
            unlink('uploaded/images/' . $product['path_gambar_cover']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Produk');

        return redirect()->to(base_url('admin/produk'));
    }
}
