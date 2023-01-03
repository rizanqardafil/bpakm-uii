<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class ProdukController extends BaseController
{
	protected $product_model;

	public function __construct()
	{
		$this->product_model = new ProdukModel();
	}

	public function index()
	{
		$current_page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
		$offset = (6 * ($current_page - 1));

		$pager = service('pager');

		$products = $this->product_model->getAllProduct('', '', 'produk.nama_produk', 'ASC', 6, $offset);
		$total_products = sizeof($this->product_model->getAllProduct('', '', 'produk.nama_produk'));

		$nama_produk = $this->request->getGet('nama_produk') ?? '';
		$tanggal_pinjam = $this->request->getGet('tanggal_pinjam') ?? '';
		$tanggal_kembali = $this->request->getGet('tanggal_kembali') ?? '';

		$search_input = [
			'nama_produk'	=> $nama_produk,
			'tanggal_pinjam'	=> $tanggal_pinjam,
			'tanggal_kembali'	=> $tanggal_kembali
		];

		if ($nama_produk || $tanggal_pinjam || $tanggal_kembali) {
			$products = $this->product_model->searchProduct($nama_produk, $tanggal_pinjam, $tanggal_kembali, 6, $offset);
			$total_products = sizeof($this->product_model->searchProduct($nama_produk, $tanggal_pinjam, $tanggal_kembali));
		}

		$data = [
			'titles' => 'Produk Kami | BPA KM UII',
			'products'	=> $products,
			'pager'	=> $pager,
			'total'	=> $total_products,
			'current_page'	=> $current_page,
			'search_input'	=> $search_input,
			'config'	=> $this->config->getConfig()
		];

		return view('pages/produk/index', $data);
	}

	public function detail($slug_produk)
	{
		$product = $this->product_model->getDetailProduct($slug_produk);
		$packages = $this->product_model->getPackage($slug_produk);

		$data = [
			'titles' => 'Detail Produk | BPA KM UII',
			'product'	=> $product,
			'packages'	=>	$packages,
			'config'	=> $this->config->getConfig()
		];

		return view('pages/produk/detail', $data);
	}
}
