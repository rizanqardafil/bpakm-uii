<?php

namespace App\Controllers\Admin\Galeri;

use App\Controllers\BaseController;
use App\Models\Admin\AlbumModel;
use App\Models\GaleriModel;

class Foto extends BaseController
{
    protected $galeri_foto;
    protected $album_model;

    public function __construct()
    {
        $this->galeri_foto = new GaleriModel();
        $this->album_model = new AlbumModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Manajemen Galeri Foto - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'images'  => $this->galeri_foto->getImage()
        ];

        return view('admin/dashboard/galeri/foto/index', $data);
    }

    public function tambah()
    {
        $albums = $this->album_model->getAlbums();

        $data = [
            'title' => 'Tambah Galeri Foto - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'albums'  => $albums
        ];

        return view('admin/dashboard/galeri/foto/tambah_foto', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File foto terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'nama_foto'   =>  [
                'rules' =>  'required|is_unique[galeri_foto.nama_foto]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_foto' =>  [
                'rules' =>  'uploaded[path_foto]|max_size[path_foto,8024]|is_image[path_foto]|mime_in[path_foto,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/foto/tambah'))->withInput();

        $nama_foto = $this->request->getPost('nama_foto');
        $slug_galeri_foto = url_title($nama_foto, '-', true);
        $id_album = $this->request->getPost('id_album');

        $files = $this->request->getFile('path_foto');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_foto = $image_name . '_' . $files->getRandomName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $path_foto);
        } else {
            $files->move('uploaded/images/', $path_foto);
        }

        // $files->move('uploaded/images/', $path_foto);

        $data = [
            'nama_foto'     => $nama_foto,
            'slug_galeri_foto' => $slug_galeri_foto,
            'id_album'    => $id_album,
            'path_foto' => $path_foto
        ];

        $this->galeri_foto->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Galeri Foto Baru');

        return redirect()->to(base_url('admin/foto'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File foto terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_galeri_foto = $this->request->getPost('slug_galeri_foto');
        $nama_foto = $this->request->getPost('nama_foto');
        $image = $this->galeri_foto->getImage('', $slug_galeri_foto);

        $nama_foto_rules = 'required|min_length[3]|max_length[255]';

        ($nama_foto !== $image[0]->nama_foto) ? $nama_foto_rules .= '|is_unique[galeri_foto.nama_foto]' :  '';

        $rules = [
            'nama_foto'   =>  [
                'rules' =>  $nama_foto_rules,
                'errors'    =>  $this->error_message
            ],
            'path_foto' =>  [
                'rules' =>  'max_size[path_foto,8024]|is_image[path_foto]|mime_in[path_foto,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/foto/edit/' . $slug_galeri_foto))->withInput();

        $nama_foto = $this->request->getPost('nama_foto');
        $slug_galeri_foto = url_title($nama_foto, '-', true);
        $id_album = $this->request->getPost('id_album');

        $files = $this->request->getFile('path_foto');
        $path_foto_old = $this->request->getPost('path_foto');
        $path_foto = $image[0]->path_foto;

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_foto = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_foto);
            } else {
                $files->move('uploaded/images/', $path_foto);
            }

            // $files->move('uploaded/images/', $path_foto);

            (is_file('uploaded/images/' . $path_foto_old) && $path_foto_old !== 'default.png') ? unlink('uploaded/images/' . $path_foto_old) : '';
        }

        $slug_galeri_foto = url_title($nama_foto, '-', true);

        $data = [
            'nama_foto'     => $nama_foto,
            'slug_galeri_foto' => $slug_galeri_foto,
            'id_album'    => $id_album,
            'path_foto' => $path_foto
        ];

        $this->galeri_foto->update($image[0]->id_galeri_foto, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Galeri Foto');

        return redirect()->to(base_url('admin/foto'));
    }

    public function edit($slug_galeri_foto)
    {
        $image = $this->galeri_foto->getImage('', $slug_galeri_foto);
        $albums = $this->album_model->getAlbums();

        if (!$image) throw new \CodeIgniter\Exceptions\PageNotFoundException("Galeri Foto $slug_galeri_foto tidak ditemukan");

        $data = [
            'title' => 'Edit Galeri Foto - ' . $image[0]->nama_foto,
            'image' =>  $image,
            'config'    => $this->config->getConfig(),
            'albums'    => $albums,
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/galeri/foto/edit_foto', $data);
    }

    public function delete($id)
    {
        $image = $this->galeri_foto->find($id);

        $this->galeri_foto->delete($id);

        if (is_file('uploaded/images/' . $image['path_foto']) && $image['path_foto'] !== 'default.png') {
            unlink('uploaded/images/' . $image['path_foto']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Foto');

        return redirect()->to(base_url('admin/foto'));
    }
}
