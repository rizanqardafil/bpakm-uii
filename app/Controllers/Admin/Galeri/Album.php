<?php

namespace App\Controllers\Admin\Galeri;

use App\Controllers\BaseController;
use App\Models\Admin\AlbumModel;

class Album extends BaseController
{
    protected $album_model;

    public function __construct()
    {
        $this->album_model = new AlbumModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Management Album - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation(),
            'albums'  => $this->album_model->getAlbums()
        ];

        return view('admin/dashboard/galeri/album/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Album - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/galeri/album/tambah_album', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File cover album terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'nama_album'   =>  [
                'rules' =>  'required|is_unique[album.nama_album]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_cover' =>  [
                'rules' =>  'uploaded[path_cover]|max_size[path_cover,8024]|is_image[path_cover]|mime_in[path_cover,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/album/tambah'))->withInput();

        $nama_album = $this->request->getPost('nama_album');
        $slug_album = url_title($nama_album, '-', true);

        $files = $this->request->getFile('path_cover');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_cover = $image_name . '_' . $files->getRandomName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $path_cover);
        } else {
            $files->move('uploaded/images/', $path_cover);
        }

        // $files->move('uploaded/images/', $path_cover);

        $data = [
            'nama_album'     => $nama_album,
            'slug_album' => $slug_album,
            'path_cover' => $path_cover,
        ];

        $this->album_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Album Baru');

        return redirect()->to(base_url('admin/album'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File cover album terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_album = $this->request->getPost('slug_album');
        $nama_album = $this->request->getPost('nama_album');
        $album = $this->album_model->getAlbums($slug_album);

        $nama_album_rules = 'required|min_length[3]|max_length[255]';

        ($nama_album !== $album['nama_album']) ? $nama_album_rules .= '|is_unique[album.nama_album]' :  '';

        $rules = [
            'nama_album'   =>  [
                'rules' =>  $nama_album_rules,
                'errors'    =>  $this->error_message
            ],
            'path_cover' =>  [
                'rules' =>  'max_size[path_cover,8024]|is_image[path_cover]|mime_in[path_cover,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/album/edit/' . $slug_album))->withInput();

        $nama_album = $this->request->getPost('nama_album');
        $slug_album = url_title($nama_album, '-', true);

        $files = $this->request->getFile('path_cover');
        $path_cover_old = $this->request->getPost('path_cover');
        $path_cover = $album['path_cover'];

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_cover = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_cover);
            } else {
                $files->move('uploaded/images/', $path_cover);
            }

            // $files->move('uploaded/images/', $path_cover);

            (is_file('uploaded/images/' . $path_cover_old) && $path_cover_old !== 'default.png') ? unlink('uploaded/images/' . $path_cover_old) : '';
        }

        $slug_album = url_title($nama_album, '-', true);

        $data = [
            'nama_album'     => $nama_album,
            'slug_album' => $slug_album,
            'path_cover' => $path_cover
        ];

        $this->album_model->update($album['id_album'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Album');

        return redirect()->to(base_url('admin/album'));
    }

    public function edit($slug_album)
    {
        $album = $this->album_model->getAlbums($slug_album);

        if (!$album) throw new \CodeIgniter\Exceptions\PageNotFoundException("Album $slug_album tidak ditemukan");

        $data = [
            'title' => 'Edit Album - ' . $album['nama_album'],
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'album' => $album
        ];

        return view('admin/dashboard/galeri/album/edit_album', $data);
    }

    public function delete($id)
    {
        $album = $this->album_model->find($id);

        try {
            $this->album_model->delete($id);
        } catch (\Exception $e) {
            $message = 'Data berkaitan dengan <b>' . $album['nama_album'] . '</b> harus dihapus terlebih dahulu. Cek di admin <b>Foto</b>';
            session()->setFlashdata('message', $message);

            return redirect()->to(base_url('admin/album'));
        }

        if (is_file('uploaded/images/' . $album['path_cover']) && $album['path_cover'] !== 'default.png') {
            unlink('uploaded/images/' . $album['path_cover']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Album');

        return redirect()->to(base_url('admin/album'));
    }
}
