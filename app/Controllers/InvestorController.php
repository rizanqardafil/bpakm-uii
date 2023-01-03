<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\InvestorModel;

class InvestorController extends BaseController
{
	protected $investor_model;
	protected $config_model;

	public function __construct()
	{
		$this->investor_model = new InvestorModel();
		$this->config_model = new ConfigModel();
	}

	public function index()
	{
		$org = $this->investor_model->getOrganisasi();
		$reports = $this->investor_model->getLaporan('', 'laporan.nama_laporan');
		$config = $this->config_model->getConfig();

		// dd($reports);

		$data = [
			'titles' => 'Investor | BPA KM UII',
			'org'	=> $org,
			'reports' 	=>	$reports,
			'config'	=> $config
		];

		return view('pages/investor/index', $data);
	}

	public function download()
	{
		$path_laporan = $this->request->getPost('path_laporan');
		return $this->response->download('uploaded/docs/' . $path_laporan, null);
	}
}
