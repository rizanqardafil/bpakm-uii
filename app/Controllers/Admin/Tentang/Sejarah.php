<?php

namespace App\Controllers\Admin\Tentang;

use App\Controllers\BaseController;
use App\Models\TentangModel;

class Sejarah extends BaseController
{
    protected $sejarah_model;

    public function __construct()
    {
        $this->sejarah_model = new TentangModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Sejarah - Badan Pengelola Aset KM UII',
            'sejarah'   => $this->sejarah_model->getSejarah(),
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/tentang/sejarah/index', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $sejarah = $this->sejarah_model->getSejarah();

        $rules = [
            'isi_sejarah' =>  [
                'rules' =>  'required|min_length[18]|max_length[600]',
                'errors'    =>  $this->error_message
            ],
            'isi_logo' =>  [
                'rules' =>  'required|min_length[18]',
                // 'rules' =>  'required|min_length[10]|max_length[400]',
                'errors'    =>  $this->error_message
            ],
            'path_gambar_sejarah' =>  [
                'rules' =>  'max_size[path_gambar_sejarah,8024]|is_image[path_gambar_sejarah]|mime_in[path_gambar_sejarah,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ],
            'path_gambar_logo' =>  [
                'rules' =>  'max_size[path_gambar_logo,8024]|is_image[path_gambar_logo]|mime_in[path_gambar_logo,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('admin/sejarah'))->withInput();

        $isi_sejarah = $this->request->getPost('isi_sejarah');
        $isi_logo = $this->request->getPost('isi_logo');

        $files_sejarah = $this->request->getFile('path_gambar_sejarah');
        $image_old_sejarah = $this->request->getPost('path_gambar_sejarah');
        $path_gambar_sejarah = $sejarah[0]['path_gambar_sejarah'];

        if ($files_sejarah->getError() !== 4) {
            $image_name = substr($files_sejarah->getName(), 0, strrpos($files_sejarah->getName(), '.'));
            $path_gambar_sejarah = $image_name . '_' . $files_sejarah->getRandomName();

            if ($files_sejarah->getSize() > 1000000) {
                $this->image_compression($files_sejarah, 'uploaded/images/', $path_gambar_sejarah);
            } else {
                $files_sejarah->move('uploaded/images/', $path_gambar_sejarah);
            }

            // $files_sejarah->move('uploaded/images/', $path_gambar_sejarah);

            (is_file('uploaded/images/' . $image_old_sejarah) && $image_old_sejarah !== 'default.png') ? unlink('uploaded/images/' . $image_old_sejarah) : '';
        }

        $files_logo = $this->request->getFile('path_gambar_logo');
        $image_old_logo = $this->request->getPost('path_gambar_logo');
        $path_gambar_logo = $sejarah[0]['path_gambar_logo'];

        if ($files_logo->getError() !== 4) {
            $image_name = substr($files_logo->getName(), 0, strrpos($files_logo->getName(), '.'));
            $path_gambar_logo = $image_name . '_' . $files_logo->getRandomName();

            if ($files_logo->getSize() > 1000000) {
                $this->image_compression($files_logo, 'uploaded/images/', $path_gambar_logo);
            } else {
                $files_logo->move('uploaded/images/', $path_gambar_logo);
            }
            // $files_logo->move('uploaded/images/', $path_gambar_logo);

            (is_file('uploaded/images/' . $image_old_logo) && $image_old_logo !== 'default.png') ? unlink('uploaded/images/' . $image_old_logo) : '';
        }

        $data = [
            'isi_sejarah'     => $isi_sejarah,
            'isi_logo'     => $isi_logo,
            'path_gambar_sejarah' => $path_gambar_sejarah,
            'path_gambar_logo' => $path_gambar_logo,
        ];

        $this->sejarah_model->update($sejarah[0]['id_sejarah'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Data Sejarah');

        return redirect()->to(base_url('admin/sejarah'));
    }
}
