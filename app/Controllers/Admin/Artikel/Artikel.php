<?php

namespace App\Controllers\Admin\Artikel;

use App\Controllers\BaseController;
use App\Models\Admin\PenulisModel;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikel_model;
    protected $penulis_model;

    public function __construct()
    {
        $this->artikel_model = new ArtikelModel();
        $this->penulis_model = new PenulisModel();
    }

    public function index()
    {
        $data = [
            'title' =>  'Management Artikel - Badan Pengelola Aset KM UII',
            'config'    => $this->config->getConfig(),
            'articles'  => $this->artikel_model->getAllArtikel(),
        ];

        return view('admin/dashboard/artikel/artikel/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Artikel - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig(),
            'writers'  => $this->penulis_model->getWriters()
        ];

        return view('admin/dashboard/artikel/artikel/tambah_artikel', $data);
    }

    public function save()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File cover artikel terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $rules = [
            'judul_artikel'   =>  [
                'rules' =>  'required|is_unique[artikel.judul_artikel]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'isi_artikel' =>  [
                'rules' =>  'required|min_length[18]', // Isi artikel memiliki default 9 karakter karena ketambahan tag p
                'errors'    =>  [
                    'required'  =>  'Tidak boleh kosong',
                    'min_length'    =>  'Minimal berisi 10 karakter'
                ]
            ],
            'path_gambar' =>  [
                'rules' =>  'uploaded[path_gambar]|max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/artikel/tambah'))->withInput();

        $judul_artikel = $this->request->getPost('judul_artikel');
        $slug_artikel = url_title($judul_artikel, '-', true);
        $isi_artikel = $this->request->getPost('isi_artikel');
        $id_penulis = $this->request->getPost('id_penulis');

        $files = $this->request->getFile('path_gambar');
        $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
        $path_gambar = $image_name . '_' . $files->getRandomName();

        if ($files->getSize() > 1000000) {
            $this->image_compression($files, 'uploaded/images/', $path_gambar);
        } else {
            $files->move('uploaded/images/', $path_gambar);
        }

        // $files->move('uploaded/images/', $path_gambar);

        $data = [
            'judul_artikel'     => $judul_artikel,
            'slug_artikel' => $slug_artikel,
            'isi_artikel'    => $isi_artikel,
            'path_gambar' => $path_gambar,
            'id_penulis' => $id_penulis
        ];

        $this->artikel_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Artikel');

        return redirect()->to(base_url('admin/artikel'));
    }

    public function update()
    {
        if (!$this->request->getVar('csrf_test_name')) {
            session()->setFlashdata('message', 'File cover artikel terlalu besar dan melebihi kapasitas server. Silahkan upload file < 8 MB');
            return redirect()->back()->withInput();
        }

        $slug_artikel = $this->request->getPost('slug_artikel');
        $judul_artikel = $this->request->getPost('judul_artikel');
        $article = $this->artikel_model->getAllArtikel('', $slug_artikel);

        $judul_artikel_rules = 'required|min_length[3]|max_length[255]';

        ($judul_artikel !== $article[0]->judul_artikel) ? $judul_artikel_rules .= '|is_unique[artikel.judul_artikel]' :  '';

        $rules = [
            'judul_artikel'   =>  [
                'rules' =>  $judul_artikel_rules,
                'errors'    =>  $this->error_message
            ],
            'isi_artikel' =>  [
                'rules' =>  'required|min_length[18]', // Isi artikel memiliki default 9 karakter karena ketambahan tag p
                'errors'    =>  [
                    'required'  =>  'Tidak boleh kosong',
                    'min_length'    =>  'Minimal berisi 10 karakter'
                ]
            ],
            'path_gambar' =>  [
                'rules' =>  'max_size[path_gambar,8024]|is_image[path_gambar]|mime_in[path_gambar,image/jpg,image/jpeg,image/png]',
                'errors'    => $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/artikel/edit/' . $slug_artikel))->withInput();

        $judul_artikel = $this->request->getPost('judul_artikel');
        $slug_artikel = url_title($judul_artikel, '-', true);
        $isi_artikel = $this->request->getPost('isi_artikel');
        $id_penulis = $this->request->getPost('id_penulis');

        $files = $this->request->getFile('path_gambar');
        $path_gambar_old = $this->request->getPost('path_gambar');
        $path_gambar = $article[0]->cover;

        if ($files->getError() !== 4) {
            $image_name = substr($files->getName(), 0, strrpos($files->getName(), '.'));
            $path_gambar = $image_name . '_' . $files->getRandomName();

            if ($files->getSize() > 1000000) {
                $this->image_compression($files, 'uploaded/images/', $path_gambar);
            } else {
                $files->move('uploaded/images/', $path_gambar);
            }

            // $files->move('uploaded/images/', $path_gambar);

            (is_file('uploaded/images/' . $path_gambar_old) && $path_gambar_old !== 'default.png') ? unlink('uploaded/images/' . $path_gambar_old) : '';
        }

        $data = [
            'judul_artikel'     => $judul_artikel,
            'slug_artikel' => $slug_artikel,
            'isi_artikel'    => $isi_artikel,
            'path_gambar' => $path_gambar,
            'id_penulis' => $id_penulis
        ];

        $this->artikel_model->update($article[0]->id_artikel, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Artikel');

        return redirect()->to(base_url('admin/artikel'));
    }

    public function edit($slug_artikel)
    {
        $article = $this->artikel_model->getAllArtikel('', $slug_artikel);
        $writers = $this->penulis_model->getWriters('', 'penulis.nama_penulis', 'ASC');

        if (!$article) throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel $slug_artikel tidak ditemukan");

        $data = [
            'title' => 'Edit Artikel - ' . $article[0]->judul_artikel,
            'validation'    => \Config\Services::validation(),
            'article'   => $article,
            'config'    => $this->config->getConfig(),
            'writers'    => $writers
        ];

        return view('admin/dashboard/artikel/artikel/edit_artikel', $data);
    }

    public function delete($id)
    {
        $article = $this->artikel_model->find($id);

        $this->artikel_model->delete($id);

        if (is_file('uploaded/images/' . $article['path_gambar']) && $article['path_gambar'] !== 'default.png') {
            unlink('uploaded/images/' . $article['path_gambar']);
        }

        session()->setFlashdata('success', 'Berhasil Menghapus Artikel');

        return redirect()->to(base_url('admin/artikel'));
    }
}
