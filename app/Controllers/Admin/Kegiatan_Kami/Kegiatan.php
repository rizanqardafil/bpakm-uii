<?php

namespace App\Controllers\Admin\Kegiatan_Kami;

use App\Controllers\BaseController;
use App\Models\Admin\KegiatanModel;

class Kegiatan extends BaseController
{
    protected $kegiatan_model;

    public function __construct()
    {
        $this->kegiatan_model = new KegiatanModel();
    }

    public function index()
    {
        $activities = $this->kegiatan_model->getActivity();
        $total_activity = sizeof($activities);

        $data = [
            'title' =>  'Manajemen Kegiatan - Badan Pengelola Aset KM UII',
            'activities'  => $activities,
            'total_activity'    =>  $total_activity,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/kegiatan_kami/kegiatan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kegiatan - Badan Pengelola Aset KM UII',
            'validation'    =>  \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/kegiatan_kami/kegiatan/tambah_kegiatan', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File gambar kegiatan kami terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'judul'   =>  [
                'rules' =>  'required|is_unique[kegiatan.judul]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'sub_judul' =>  [
                'rules' =>  'required|min_length[10]|max_length[450]',
                'errors'    =>  $this->error_message
            ],
            'image' =>  [
                'rules' =>  'uploaded[image]|max_size[image,8024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/kegiatan-kami/tambah'))->withInput();

        $judul = $this->request->getPost('judul');
        $slug_kegiatan = url_title($judul, '-', true);
        $sub_judul = $this->request->getPost('sub_judul');

        $files = $this->request->getFile('image');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $image = $image_name . '_' . $files->getRandomName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $image);
        } else {
            $files->move('uploaded/images/', $image);
        }

        // $files->move('uploaded/images/', $image);

        $data = [
            'judul'     => $judul,
            'slug_kegiatan' => $slug_kegiatan,
            'sub_judul'    => $sub_judul,
            'image' => $image
        ];

        $this->kegiatan_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Kegiatan Baru');

        return redirect()->to(base_url('admin/kegiatan-kami'));
    }

    public function update()
    {
        $slug_kegiatan = $this->request->getPost('slug_kegiatan');
        $judul = $this->request->getPost('judul');
        $activity = $this->kegiatan_model->getActivity($slug_kegiatan);

        $judul_rules = 'required|min_length[3]|max_length[255]';

        ($judul !== $activity['judul']) ? $judul_rules .= '|is_unique[kegiatan.judul]' :  '';

        $rules = [
            'judul'   =>  [
                'rules' =>  $judul_rules,
                'errors'    =>  $this->error_message
            ],
            'sub_judul' =>  [
                'rules' =>  'required|min_length[10]|max_length[450]',
                'errors'    =>  $this->error_message
            ],
            'image' =>  [
                'rules' =>  'max_size[image,8024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/kegiatan-kami/edit/' . $slug_kegiatan))->withInput();

        $judul = $this->request->getPost('judul');
        $slug_kegiatan = url_title($judul, '-', true);
        $sub_judul = $this->request->getPost('sub_judul');

        $files = $this->request->getFile('image');
        $image_old = $this->request->getPost('image');
        $image = $activity['image'];

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $image = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $image);
            } else {
                $files->move('uploaded/images/', $image);
            }

            // $files->move('uploaded/images/', $image);

            (is_file('uploaded/images/' . $image_old) && $image_old !== 'default.png') ? unlink('uploaded/images/' . $image_old) : '';
        }

        $data = [
            'judul'     => $judul,
            'slug_kegiatan' => $slug_kegiatan,
            'sub_judul'    => $sub_judul,
            'image' => $image
        ];

        $this->kegiatan_model->update($activity['id_kegiatan'], $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Kegiatan');

        return redirect()->to(base_url('admin/kegiatan-kami'));
    }

    public function edit($slug_kegiatan)
    {
        $activity = $this->kegiatan_model->getActivity($slug_kegiatan);

        if (!$activity) throw new \CodeIgniter\Exceptions\PageNotFoundException("Kegiatan $slug_kegiatan tidak ditemukan");

        $data = [
            'title' => "Edit Kegiatan - " . $activity['judul'],
            'activity'  => $activity,
            'config'    => $this->config->getConfig(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dashboard/kegiatan_kami/kegiatan/edit_kegiatan', $data);
    }

    public function delete($id)
    {
        $activity = $this->kegiatan_model->find($id);

        $data = [
            'image' => 'default.png',
            'judul' => 'Kegiatan telah dihapus',
            'sub_judul' => 'Tidak ada kegiatan terbaru'
        ];

        $this->kegiatan_model->update($activity['id_kegiatan'], $data);

        if (is_file('uploaded/images/' . $activity['image']) && $activity['image'] !== 'default.png') {
            unlink('uploaded/images/' . $activity['image']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Kegiatan');

        return redirect()->to(base_url('admin/kegiatan-kami'));
    }
}
