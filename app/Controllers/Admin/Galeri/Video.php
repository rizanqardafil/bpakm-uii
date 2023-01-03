<?php

namespace App\Controllers\Admin\Galeri;

use App\Controllers\BaseController;
use App\Models\Admin\GaleriVideoModel;

class Video extends BaseController
{
    protected $video_model;

    public function __construct()
    {
        $this->video_model = new GaleriVideoModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Management Galeri Video - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'videos'  => $this->video_model->getVideos()
        ];

        return view('admin/dashboard/galeri/video/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Galeri Video - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation(),
        ];

        return view('admin/dashboard/galeri/video/tambah_video', $data);
    }

    public function save()
    {
        $this->error_message['regex_match'] = 'Hanya menerima format link youtube';

        $rules = [
            'nama_video'   =>  [
                'rules' =>  'required|is_unique[galeri_video.nama_video]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'path_video' =>  [
                'rules' =>  'required|regex_match[/https:\/\//]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/video/tambah'))->withInput();

        $nama_video = $this->request->getPost('nama_video');
        $slug_galeri_video = url_title($nama_video, '-', true);
        $path_video = $this->request->getPost('path_video');

        $data = [
            'nama_video'     => $nama_video,
            'slug_galeri_video' => $slug_galeri_video,
            'path_video' => $path_video
        ];

        $this->video_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Link Video Baru');

        return redirect()->to(base_url('admin/video'));
    }

    public function update()
    {
        $slug_galeri_video = $this->request->getPost('slug_galeri_video');
        $nama_video = $this->request->getPost('nama_video');
        $video = $this->video_model->getVideos($slug_galeri_video);

        $nama_video_rules = 'required|min_length[3]|max_length[255]';

        ($nama_video !== $video['nama_video']) ? $nama_video_rules .= '|is_unique[galeri_video.nama_video]' :  '';

        $this->error_message['regex_match'] = 'Hanya menerima format link youtube';
        $rules = [
            'nama_video'   =>  [
                'rules' =>  $nama_video_rules,
                'errors'    =>  $this->error_message
            ],
            'path_video' =>  [
                'rules' =>  'required|regex_match[/https:\/\//]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/video/edit/' . $slug_galeri_video))->withInput();

        $nama_video = $this->request->getPost('nama_video');
        $slug_galeri_video = url_title($nama_video, '-', true);
        $path_video = $this->request->getPost('path_video');

        $data = [
            'nama_video'     => $nama_video,
            'slug_galeri_video' => $slug_galeri_video,
            'path_video'    => $path_video
        ];

        $this->video_model->update($video['id_galeri_video'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Galeri Video');

        return redirect()->to(base_url('admin/video'));
    }

    public function edit($slug_galeri_video)
    {
        $video = $this->video_model->getVideos($slug_galeri_video);

        if (!$video) throw new \CodeIgniter\Exceptions\PageNotFoundException("Galeri Video $slug_galeri_video tidak ditemukan");

        $data = [
            'title' => 'Edit Galeri Video - ' . $video['nama_video'],
            'video' => $video,
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/galeri/video/edit_video', $data);
    }

    public function delete($id)
    {
        $this->video_model->delete($id);

        session()->setFlashdata('success', 'Berhasil Menghapus Video');

        return redirect()->to(base_url('admin/video'));
    }
}
