<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UsersModel;

class Auth extends BaseController
{
    protected $user_model;
    protected $session;

    public function __construct()
    {
        $this->user_model = new UsersModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Administrator | BPA KM UII',
            'config'    => $this->config->getConfig()
        ];

        return view('admin/auth/login', $data);
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/index', $data);
    }

    public function save()
    {
        //include helper form
        helper(['form']);

        //set rules validation form
        $rules = [
            'name'          => [
                'rules' =>  'required|min_length[3]|max_length[20]',
                'errors'    => $this->error_message
            ],
            'username'      => [
                'rules' =>  'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors'    =>  $this->error_message
            ],
            'email'         => [
                'rules' =>  'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'errors'    =>  $this->error_message
            ],
            'password'      => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  $this->error_message
            ],
            'repeat_password'  => [
                'rules' =>  'matches[password]',
                'errors'    => $this->error_message
            ]
        ];

        if ($this->validate($rules)) {
            $username = strtolower($this->request->getPost('username'));
            $username = url_title($username, '', true);

            $user_name = $this->request->getPost('name');
            $slug = url_title($user_name, '-', true);

            $data = [
                'name'     => $user_name,
                'username' => $username,
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
            ];
            $this->user_model->save($data);

            $data = $this->user_model->where('username', $username)->first();
            $slug = (string)$data['id_user'] . '-' . $slug;

            $this->user_model->update($data['id_user'], ["slug_user" => $slug]);

            session()->setFlashdata('success', 'Berhasil Menambahkan Admin');

            return redirect()->to(base_url('admin/users'));
        } else {
            // session()->setFlashdata('message', $this->validator->listErrors());
            return redirect()->to(base_url('admin/users/tambah'))->withInput();
        }
    }

    public function update($slug)
    {
        $user = $this->user_model->getUsers('', $slug);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $repeat_password = $this->request->getPost('repeat_password');

        if ($user['username'] === 'admin') {
            session()->setFlashdata('message', "Super admin tidak dapat diubah");
            return redirect()->to(base_url('admin/users'));
        }

        $rules = [
            'name'          => [
                'rules' =>  'required|min_length[3]|max_length[20]',
                'errors'    => $this->error_message
            ],
            'email'         => [
                'rules' => 'required|min_length[6]|max_length[50]|valid_email',
                'errors'    =>  $this->error_message
            ],
        ];

        if ($email !== $user['email']) {
            $rules['email']['rules'] = $rules['email']['rules'] . '|is_unique[users.email]';
        }

        if ($password || $repeat_password) {
            $rules['password'] = [
                'rules'   => 'required|min_length[6]|max_length[200]',
                'errors'    =>  $this->error_message
            ];
            $rules['repeat_password'] = [
                'rules'   => 'matches[password]',
                'errors'    =>  $this->error_message
            ];
        }

        if ($this->validate($rules)) {
            $user_name = $this->request->getPost('name');

            $slug = url_title($user_name, '-', true);
            $slug = (string)$user['id_user'] . '-' . $slug;

            $data = [
                'name'     => $user_name,
                'slug_user' => $slug,
                'email'    => $this->request->getPost('email'),
            ];

            if ($password) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
            }

            $this->user_model->update($user['id_user'], $data);

            if ($password && session()->get('username') == $user['username']) {
                return redirect()->to(base_url('admin/logout'));
            }

            session()->setFlashdata('success', 'Berhasil Mengubah Admin');

            return redirect()->to(base_url('admin/users'));
        } else {
            return redirect()->to(base_url("admin/users/$slug"))->withInput();
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id_user');

        $user_admin = $this->user_model->find($id);

        if ($user_admin['username'] === 'admin') {
            session()->setFlashdata('message', "Super admin tidak dapat dihapus");
            return redirect()->to(base_url('admin/users'));
        }

        if (!$id) {
            session()->setFlashdata('message', "Admin tidak terdaftar");
            return redirect()->to(base_url('admin/users'));
        }

        $this->user_model->delete($id);
        session()->setFlashdata('success', "Admin berhasil dihapus");
        return redirect()->to(base_url('admin/users'));
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->user_model->getUsers($username);

        if (!$data) {
            $this->session->setFlashdata('message', 'Username tidak ditemukan');
            return redirect()->to(base_url('/admin/login'))->withInput();
        }

        $pass = $data['password'];
        $verify_pass = password_verify($password, $pass);

        if (!$verify_pass) {
            $this->session->setFlashdata('message', 'Password salah');
            return redirect()->to(base_url('/admin/login'))->withInput();
        }

        $ses_data = [
            'user_id'       => $data['id_user'],
            'username'     => $data['username'],
            'user_email'    => $data['email'],
            'logged_in'     => TRUE
        ];

        $this->session->set($ses_data);
        return redirect()->to(base_url('/admin/dashboard'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/admin/logout'));
    }
}
