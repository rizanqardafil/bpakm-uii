<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ConfigModel;

class Config extends BaseController
{
    protected $config_model;

    public function __construct()
    {
        $this->config_model = new ConfigModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Pengaturan Umum - Badan Pengelola Aset KM UII',
            'config'    => $this->config_model->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/settings/config', $data);
    }

    public function save_config()
    {
        $config = $this->config_model->getConfig();

        $this->error_message['regex_match'] = 'Kontak harus di awali angka 0';
        $rules = [
            'namaweb' =>  [
                'rules' =>  'required|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'email' =>  [
                'rules' =>  'required|valid_email',
                'errors'    =>  $this->error_message
            ],
            'telepon' =>  [
                'rules' =>  'required|min_length[3]|max_length[15]|numeric|regex_match[/^0/]',
                'errors'    => $this->error_message
            ],
            'link_drive_laporan' =>  [
                'rules' =>  'required|min_length[5]|max_length[255]',
                'errors'    => $this->error_message
            ],
            'keyword' =>  [
                'rules' =>  'required|min_length[3]|max_length[255]',
                'errors'    => $this->error_message
            ],
            'metatext' =>  [
                'rules' =>  'max_length[255]',
                'errors'    => $this->error_message
            ],
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('admin/config'))->withInput();

        $namaweb = $this->request->getPost('namaweb');
        $email = $this->request->getPost('email');
        $telepon = $this->request->getPost('telepon');
        $link_drive_laporan = $this->request->getPost('link_drive_laporan');
        $keyword = $this->request->getPost('keyword');
        $metatext = $this->request->getPost('metatext');


        $data = [
            'namaweb'     => $namaweb,
            'email'     => $email,
            'telepon' => $telepon,
            'link_drive_laporan' => $link_drive_laporan,
            'keyword' => $keyword,
            'metatext' => $metatext
        ];

        $this->config_model->update($config[0]['id_config'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Pengaturan');

        return redirect()->to(base_url('admin/config'));
    }

    public function logo_config()
    {
        $data = [
            'title' =>  'Pengaturan Logo',
            'config'    => $this->config_model->getConfig(),
            'validation'    => \Config\Services::validation()
        ];
        return view('admin/dashboard/settings/logo-config', $data);
    }

    public function save_logo()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload logo terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $config = $this->config_model->getConfig();

        $rules = [
            'logo' =>  [
                'rules' =>  'max_size[logo,8024]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ],
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('admin/logo-config'))->withInput();

        $files = $this->request->getFile('logo');
        $logo_old = $this->request->getPost('logo');
        $logo = $config[0]['logo'];

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $logo = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $logo);
            } else {
                $files->move('uploaded/images/', $logo);
            }

            (is_file('uploaded/images/' . $logo_old) && $logo_old !== 'default.png') ? unlink('uploaded/images/' . $logo_old) : '';
        }


        $data = [
            'logo'     => $logo
        ];

        $this->config_model->update($config[0]['id_config'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Logo');

        return redirect()->to(base_url('admin/logo-config'));
    }

    public function icon_config()
    {

        $data = [
            'title' =>  'Pengaturan Ikon',
            'config'    => $this->config_model->getConfig(),
            'validation'    => \Config\Services::validation()
        ];
        return view('admin/dashboard/settings/icon-config', $data);
    }

    public function save_icon()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File upload ikon terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $config = $this->config_model->getConfig();

        $rules = [
            'icon' =>  [
                'rules' =>  'max_size[icon,8024]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ],
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('admin/icon-config'))->withInput();

        $files = $this->request->getFile('icon');
        $icon_old = $this->request->getPost('icon');
        $icon = $config[0]['icon'];

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $icon = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $icon);
            } else {
                $files->move('uploaded/images/', $icon);
            }

            (is_file('uploaded/images/' . $icon_old) && $icon_old !== 'default.png') ? unlink('uploaded/images/' . $icon_old) : '';
        }


        $data = [
            'icon'     => $icon
        ];

        $this->config_model->update($config[0]['id_config'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Logo');

        return redirect()->to(base_url('admin/icon-config'));
    }
}
