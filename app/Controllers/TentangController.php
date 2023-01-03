<?php

namespace App\Controllers;

use App\Models\TentangModel;

class TentangController extends BaseController
{
	protected $tentang_model;

	public function __construct()
	{
		$this->tentang_model = new TentangModel();
	}

	public function index()
	{
		$sejarah = $this->tentang_model->getSejarah();
		$visi_misi = $this->tentang_model->getVisiMisi();

		$data = [
			'titles' => 'Tentang Kami | BPA KM UII',
			'sejarah'	=> $sejarah,
			'visi_misi'	=> $visi_misi,
			'config'	=> $this->config->getConfig()
		];

		return view('pages/tentang/index', $data);
	}
}
