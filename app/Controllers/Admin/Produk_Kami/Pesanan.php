<?php

namespace App\Controllers\Admin\Produk_Kami;

use App\Controllers\BaseController;
use App\Models\Admin\PesananModel;
use App\Models\ProdukModel;

class Pesanan extends BaseController
{
    protected $pesanan_model;
    protected $produk_model;

    public function __construct()
    {
        $this->pesanan_model = new PesananModel();
        $this->produk_model = new ProdukModel();
    }

    public function index()
    {
        $orders = $this->pesanan_model->getOrders();

        $data = [
            'title' =>  'Pesanan Produk - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'orders'  => $orders,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/pesanan/index', $data);
    }

    public function tambah()
    {
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        $data = [
            'title' => 'Tambah Pesanan - Badan Pengelola Aset KM UII',
            'validation'    => \Config\Services::validation(),
            'products'  => $products,
            'config'    => $this->config->getConfig()
        ];

        return view('admin/dashboard/produk_kami/pesanan/tambah_pesanan', $data);
    }

    public function save()
    {
        $rules = [
            'tanggal_pinjam'   =>  [
                'rules' =>  'required',
                'errors'    =>  $this->error_message
            ],
            'tanggal_kembali' =>  [
                'rules' =>  'required',
                'errors'    =>  $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/pesanan/tambah'))->withInput();

        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');
        $id_produk = $this->request->getPost('id_produk');

        $data = [
            'tanggal_pinjam'     => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'id_produk' =>  $id_produk
        ];

        $this->pesanan_model->save($data);

        session()->setFlashdata('success', 'Berhasil Menambahkan Pesanan');

        return redirect()->to(base_url('admin/pesanan'));
    }

    public function update()
    {
        $id_pesanan = $this->request->getPost('id_pesanan');
        $order = $this->pesanan_model->getOrders($id_pesanan);

        $rules = [
            'tanggal_pinjam'   =>  [
                'rules' =>  'required',
                'errors'    =>  $this->error_message
            ],
            'tanggal_kembali' =>  [
                'rules' =>  'required',
                'errors'    =>  $this->error_message
            ]
        ];

        if (!$this->validate($rules)) return redirect()->to(base_url('/admin/pesanan/edit/' . $id_pesanan))->withInput();

        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');
        $id_produk = $this->request->getPost('id_produk');

        $data = [
            'tanggal_pinjam'     => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'id_produk' =>  $id_produk
        ];

        $this->pesanan_model->update($id_pesanan, $data);

        session()->setFlashdata('success', 'Berhasil Mengubah Pesanan');

        return redirect()->to(base_url('admin/pesanan'));
    }

    public function edit($id)
    {
        $order = $this->pesanan_model->getOrders($id);
        $products = $this->produk_model->getAllProduct('', '', 'produk.nama_produk');

        if (!$order) throw new \CodeIgniter\Exceptions\PageNotFoundException("Pesanan dengan nomor $id tidak ditemukan");

        $data = [
            'title' => 'Edit Pesanan - ' . $order[0]->nama_produk,
            'order'   => $order,
            'products'  => $products,
            'validation'    => \Config\Services::validation(),
            'config'    => $this->config->getConfig()
        ];


        return view('admin/dashboard/produk_kami/pesanan/edit_pesanan', $data);
    }

    public function delete($id)
    {
        $this->pesanan_model->delete($id);
        session()->setFlashdata('success', 'Berhasil Menghapus Pesanan');

        return redirect()->to(base_url('admin/pesanan'));
    }
}
