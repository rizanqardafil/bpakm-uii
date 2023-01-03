<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class GaleriController extends BaseController
{
	protected $galeri_model;

	public function __construct()
	{
		$this->galeri_model = new GaleriModel();
	}

	public function index()
	{
		$images = $this->galeri_model->getAlbum('', 6);
		$videos = $this->galeri_model->getVideo('', 6);

		// dd($images);
		$data = [
			'titles' => 'Galeri | BPA KM UII',
			'config'	=> $this->config->getConfig(),
			'images'	=> $images,
			'videos'	=> $videos
		];

		return view('pages/galeri/index', $data);
	}

	public function foto()
	{
		$current_page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
		$per_page = 6;
		$offset = ($per_page * ($current_page - 1));

		$pager = service('pager');

		$images = $this->galeri_model->getAlbum('', $per_page, $offset);
		$total_image = sizeof($this->galeri_model->getAlbum());

		$data = [
			'titles' => 'Foto | BPA KM UII',
			'config'	=> $this->config->getConfig(),
			'images'	=> $images,
			'current_page'	=> $current_page,
			'per_page'	=> $per_page,
			'pager'		=> $pager,
			'total_image'	=> $total_image
		];

		return view('pages/galeri/foto', $data);
	}

	public function video()
	{
		$current_page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
		$per_page = 6;
		$offset = ($per_page * ($current_page - 1));

		$pager = service('pager');

		$videos = $this->galeri_model->getVideo('', $per_page, $offset);
		$total_video = sizeof($this->galeri_model->getVideo());

		$data = [
			'titles' => 'Video | BPA KM UII',
			'config'	=> $this->config->getConfig(),
			'videos'	=> $videos,
			'current_page'	=> $current_page,
			'per_page'	=> $per_page,
			'pager'		=> $pager,
			'total_video'	=> $total_video
		];

		return view('pages/galeri/video', $data);
	}
}
