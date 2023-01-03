<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class ArtikelController extends BaseController
{
	protected $artikel_model;

	public function __construct()
	{
		$this->artikel_model = new ArtikelModel();
	}

	public function index()
	{
		$newest_article = $this->artikel_model->getAllArtikel()[0];

		$current_page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
		$per_page = 6;
		$addition = 1;
		if ($current_page == 1) {
			$per_page = 7;
			$addition = 0;
		}
		$offset = ($per_page * ($current_page - 1)) + $addition;

		$pager = service('pager');

		$articles = $this->artikel_model->getAllArtikel('', '', $per_page, $offset);
		$total_article = sizeof($this->artikel_model->getAllArtikel());

		if ($articles[0]->id_artikel === $newest_article->id_artikel) unset($articles[0]);

		$data = [
			'titles' => 'Artikel | BPA KM UII',
			'config'	=> $this->config->getConfig(),
			'articles'	=> $articles,
			'newest_article'	=> $newest_article,
			'articles'	=> $articles,
			'current_page'	=> $current_page,
			'per_page'	=> $per_page,
			'pager'		=> $pager,
			'total_article'	=> $total_article
		];

		return view('pages/artikel/index', $data);
	}

	public function detail($slug_artikel)
	{
		$article = $this->artikel_model->getAllArtikel('', $slug_artikel);

		$data = [
			'titles' => 'Detail Artikel | BPA KM UII',
			'config'	=> $this->config->getConfig(),
			'article'	=> $article
		];

		return view('pages/artikel/detail', $data);
	}
}
