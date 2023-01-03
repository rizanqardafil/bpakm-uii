<?php

namespace App\Controllers\Admin\Produk_Kami;

use App\Controllers\BaseController;
use App\Models\Admin\PaketModel;
use App\Models\ProdukModel;

class Paket extends BaseController
{
    protected $paket_model;
    protected $produk_model;

    public function __construct()
    {
        $this->paket_model = new PaketModel();
        $this->produk_model = new ProdukModel();
    }

    public function index()
    {
        $packages = $this->paket_model->getAllPackage();

        $data = [
            'title' =>  'Paket Produk - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'packages'  => $packages,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/paket/index', $data);
    }

    public function tambah()
    {
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        $data = [
            'title' => 'Tambah Paket - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'products'  => $products,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/paket/tambah_paket', $data);
    }

    public function save()
    {
        $rules = [
            'nama_paket'   =>  [
                'rules' =>  'required|is_unique[paket.nama_paket]|min_length[3]|max_length[255]',
                'errors'    =>  $this->error_message
            ],
            'harga' =>  [
                'rules' =>  'required|min_length[4]|max_length[13]|integer',
                'errors'    =>  $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/paket/tambah'))->withInput();

        $nama_paket = $this->request->getPost('nama_paket');
        $slug_paket = url_title($nama_paket, '-', true);
        $harga = $this->request->getPost('harga');
        $id_produk = $this->request->getPost('id_produk');

        $data = [
            'nama_paket'     => $nama_paket,
            'slug_paket' => $slug_paket,
            'harga'    => $harga,
            'id_produk' =>  $id_produk
        ];

        $this->paket_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Paket');

        return redirect()->to(base_url('admin/paket'));
    }

    public function update()
    {
        $slug_paket = $this->request->getPost('slug_paket');
        $nama_paket = $this->request->getPost('nama_paket');
        $package = $this->paket_model->getAllPackage($slug_paket);

        $nama_paket_rules = 'required|min_length[3]|max_length[255]';

        ($nama_paket !== $package[0]->nama_paket) ? $nama_paket_rules .= '|is_unique[paket.nama_paket]' :  '';

        $rules = [
            'nama_paket'   =>  [
                'rules' =>  $nama_paket_rules,
                'errors'    =>  $this->error_message
            ],
            'harga' =>  [
                'rules' =>  'required|min_length[4]|max_length[13]|integer',
                'errors'    =>  $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/paket/edit/' . $slug_paket))->withInput();

        $nama_paket = $this->request->getPost('nama_paket');
        $id_produk = $this->request->getPost('id_produk');
        $slug_paket = url_title($nama_paket, '-', true);
        $harga = $this->request->getPost('harga');

        $slug_paket = url_title($nama_paket, '-', true);

        $data = [
            'nama_paket'     => $nama_paket,
            'slug_paket' => $slug_paket,
            'harga'    => $harga,
            'id_produk' =>  $id_produk
        ];

        $this->paket_model->update($package[0]->id_paket, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Paket');

        return redirect()->to(base_url('admin/paket'));
    }

    public function edit($slug_paket)
    {
        $package = $this->paket_model->getAllPackage($slug_paket);
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        if (!$package) throw new \CodeIgniter\Exceptions\PageNotFoundException("Paket $slug_paket tidak ditemukan");

        $data = [
            'title' => 'Edit Paket - ' . $package[0]->nama_paket,
            'package'   => $package,
            'products'  => $products,
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/paket/edit_paket', $data);
    }

    public function delete($id)
    {
        $this->paket_model->delete($id);
        session()->setFlashdata('success', 'Berhasil Menghapus Paket');

        return redirect()->to(base_url('admin/paket'));
    }
}
