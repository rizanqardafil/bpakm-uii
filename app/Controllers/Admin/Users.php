<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UsersModel;

class Users extends BaseController
{
    protected $user_model;

    public function __construct()
    {
        $this->user_model = new UsersModel();
    }

    public function index()
    {
        helper('form');

        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $this->user_model->getUsers(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/users/index', $data);
    }

    public function tambah()
    {

        $data = [
            'title' => 'Tambah Pengguna - Badan Pengelola Aset KM UII',
            'validation'    =>  \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/users/tambah_pengguna', $data);
    }

    public function edit($slug)
    {
        $user = $this->user_model->getUsers('', $slug);

        if ($user['username'] === 'admin') {
            session()->setFlashdata('message', "Super admin tidak dapat diubah");
            return redirect()->to(base_url('admin/users'));
        }

        $data = [
            'title' => 'Edit Pengguna - ' . $user['name'],
            'user' => $user,
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/users/edit', $data);
    }
}
