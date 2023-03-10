<?php

namespace App\Controllers\Admin\Produk_Kami;

use App\Controllers\BaseController;
use App\Models\Admin\GambarProdukModel;
use App\Models\ProdukModel;

class Gambar extends BaseController
{
    protected $gambar_produk_model;
    protected $produk_model;

    public function __construct()
    {
        $this->gambar_produk_model = new GambarProdukModel();
        $this->produk_model = new ProdukModel();
    }

    public function index()
    {
        $images = $this->gambar_produk_model->getImages();

        $data = [
            'title' =>  'Gambar Produk - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'images'  => $images,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/gambar_produk/index', $data);
    }

    public function tambah()
    {
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        $data = [
            'title' => 'Tambah Gambar Produk - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'products'  => $products,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/gambar_produk/tambah_gambar', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'nama_gambar'   =>  [
                'rules' =>  'required|is_unique[gambar_produk.nama_gambar]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_gambar' =>  [
                'rules' =>  'uploaded[path_gambar]|max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/gambar/tambah'))->withInput();

        $nama_gambar = $this->request->getPost('nama_gambar');
        $slug_gambar = url_title($nama_gambar, '-', true);
        $id_produk = $this->request->getPost('id_produk');

        $files = $this->request->getFile('path_gambar');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_gambar = $image_name . '_' . $files->getRandomName();
        $path_nama_gambar = $files->getName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $path_gambar);
        } else {
            $files->move('uploaded/images/', $path_gambar);
        }
        // $files->move('uploaded/images/', $path_gambar);

        $data = [
            'nama_gambar'     => $nama_gambar,
            'slug_gambar' => $slug_gambar,
            'id_produk'    => $id_produk,
            'path_gambar' => $path_gambar,
            'path_nama_gambar' => $path_nama_gambar
        ];

        $this->gambar_produk_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Gambar Produk');

        return redirect()->to(base_url('admin/gambar'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_gambar = $this->request->getPost('slug_gambar');
        $nama_gambar = $this->request->getPost('nama_gambar');
        $image = $this->gambar_produk_model->getImages($slug_gambar);

        $nama_gambar_rules = 'required|min_length[3]|max_length[255]';

        ($nama_gambar !== $image[0]->nama_gambar) ? $nama_gambar_rules .= '|is_unique[gambar_produk.nama_gambar]' :  '';

        $rules = [
            'nama_gambar'   =>  [
                'rules' =>  $nama_gambar_rules,
                'errors'    =>  $this->error_message
            ],
            'path_gambar' =>  [
                'rules' =>  'max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/gambar/edit/' . $slug_gambar))->withInput();

        $nama_gambar = $this->request->getPost('nama_gambar');
        $slug_gambar = url_title($nama_gambar, '-', true);
        $id_produk = $this->request->getPost('id_produk');

        $files = $this->request->getFile('path_gambar');
        $path_gambar_old = $this->request->getPost('path_gambar');
        $path_gambar = $image[0]->path_gambar;
        $path_nama_gambar = $image[0]->path_nama_gambar;

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_gambar = $image_name . '_' . $files->getRandomName();
            $path_nama_gambar = $files->getName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_gambar);
            } else {
                $files->move('uploaded/images/', $path_gambar);
            }

            // $files->move('uploaded/images/', $path_gambar);

            (is_file('uploaded/images/' . $path_gambar_old) && $path_gambar_old !== 'default.png') ? unlink('uploaded/images/' . $path_gambar_old) : '';
        }

        $slug_gambar = url_title($nama_gambar, '-', true);

        $data = [
            'nama_gambar'     => $nama_gambar,
            'slug_gambar' => $slug_gambar,
            'id_produk'    => $id_produk,
            'path_gambar' => $path_gambar,
            'path_nama_gambar' => $path_nama_gambar
        ];

        $this->gambar_produk_model->update($image[0]->id_gambar, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Gambar Produk');

        return redirect()->to(base_url('admin/gambar'));
    }

    public function edit($slug_gambar)
    {
        $image = $this->gambar_produk_model->getImages($slug_gambar);
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        if (!$image) throw new \CodeIgniter\Exceptions\PageNotFoundException("Gambar Produk $slug_gambar tidak ditemukan");

        $data = [
            'title' => 'Edit Gambar - ' . $image[0]->nama_produk,
            'image'   => $image,
            'products'  => $products,
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];


        return view('admin/dashboard/produk_kami/gambar_produk/edit_gambar', $data);
    }

    public function delete($id)
    {
        $image = $this->gambar_produk_model->find($id);

        $this->gambar_produk_model->delete($id);

        if (is_file('uploaded/images/' . $image['path_gambar']) && $image['path_gambar'] !== 'default.png') {
            unlink('uploaded/images/' . $image['path_gambar']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Gambar Produk');

        return redirect()->to(base_url('admin/gambar'));
    }
}
