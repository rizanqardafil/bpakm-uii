<?php

namespace App\Controllers\Admin\Artikel;

use App\Controllers\BaseController;
use App\Models\Admin\PenulisModel;

class Penulis extends BaseController
{
    protected $penulis_model;

    public function __construct()
    {
        $this->penulis_model = new PenulisModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Manajemen Penulis Artikel - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'writers'  => $this->penulis_model->getWriters()
        ];

        return view('admin/dashboard/artikel/penulis/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Penulis Artikel - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/artikel/penulis/tambah_penulis', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File foto penulis terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'nama_penulis'   =>  [
                'rules' =>  'required|is_unique[penulis.nama_penulis]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_gambar' =>  [
                'rules' =>  'max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/penulis/tambah'))->withInput();

        $nama_penulis = $this->request->getPost('nama_penulis');
        $slug_penulis = url_title($nama_penulis, '-', true);

        $files = $this->request->getFile('path_gambar');
        $path_gambar = 'penulis_default.png';

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_gambar = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_gambar);
            } else {
                $files->move('uploaded/images/', $path_gambar);
            }

            // $files->move('uploaded/images/', $path_gambar);
        }

        $data = [
            'nama_penulis'     => $nama_penulis,
            'slug_penulis' => $slug_penulis,
            'path_gambar' => $path_gambar
        ];

        $this->penulis_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Penulis Baru');

        return redirect()->to(base_url('admin/penulis'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File foto penulis terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_penulis = $this->request->getPost('slug_penulis');
        $nama_penulis = $this->request->getPost('nama_penulis');
        $writer = $this->penulis_model->getWriters($slug_penulis);

        $nama_penulis_rules = 'required|min_length[3]|max_length[255]';

        ($nama_penulis !== $writer['nama_penulis']) ? $nama_penulis_rules .= '|is_unique[penulis.nama_penulis]' :  '';

        $rules = [
            'nama_penulis'   =>  [
                'rules' =>  $nama_penulis_rules,
                'errors'    =>  $this->error_message
            ],
            'path_gambar' =>  [
                'rules' =>  'max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/penulis/edit/' . $slug_penulis))->withInput();

        $nama_penulis = $this->request->getPost('nama_penulis');
        $slug_penulis = url_title($nama_penulis, '-', true);

        $files = $this->request->getFile('path_gambar');
        $path_gambar_old = $this->request->getPost('path_gambar');
        $path_gambar = $writer['path_gambar'];

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_gambar = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_gambar);
            } else {
                $files->move('uploaded/images/', $path_gambar);
            }

            // $files->move('uploaded/images/', $path_gambar);

            (is_file('uploaded/images/' . $path_gambar_old) && $path_gambar_old !== 'penulis_default.png') ? unlink('uploaded/images/' . $path_gambar_old) : '';
        }

        $data = [
            'nama_penulis'     => $nama_penulis,
            'slug_penulis' => $slug_penulis,
            'path_gambar' => $path_gambar,
        ];

        $this->penulis_model->update($writer['id_penulis'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Profil Penulis');

        return redirect()->to(base_url('admin/penulis'));
    }

    public function edit($slug_penulis)
    {
        $writer = $this->penulis_model->getWriters($slug_penulis);

        if (!$writer) throw new \CodeIgniter\Exceptions\PageNotFoundException("Penulis $slug_penulis tidak ditemukan");

        $data = [
            'title' => 'Edit Penulis Artikel - ' . $writer['nama_penulis'],
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'writer'    => $writer
        ];

        return view('admin/dashboard/artikel/penulis/edit_penulis', $data);
    }

    public function delete($id)
    {
        $writer = $this->penulis_model->find($id);

        try {
            $this->penulis_model->delete($id);
        } catch (\Exception $e) {
            $message = 'Data berkaitan dengan Penulis <b>' . $writer['nama_penulis'] . '</b> harus dihapus terlebih dahulu. Cek di admin <b>Artikel</b>';
            session()->setFlashdata('message', $message);

            return redirect()->to(base_url('admin/penulis'));
        }

        if (is_file('uploaded/images/' . $writer['path_gambar']) && $writer['path_gambar'] !== 'penulis_default.png') {
            unlink('uploaded/images/' . $writer['path_gambar']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Penulis');

        return redirect()->to(base_url('admin/penulis'));
    }
}
