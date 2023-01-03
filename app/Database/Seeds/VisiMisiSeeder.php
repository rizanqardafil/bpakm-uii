<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
	public function run()
	{
		$isi_visi = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis hendrerit dolor magna eget est lorem. Nisi lacus sed viverra tellus in.';
		$isi_misi = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aenean et tortor at risus viverra adipiscing. Feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper.';

		$data = [
			'id_visi_misi'	=> 1,
			'nama_konten' => 'Visi Misi',
			'slug_visi_misi'    => 'visi-misi',
			'isi_visi'    => $isi_visi,
			'isi_misi'    => $isi_misi,
			'path_gambar_visi'    => 'ava-sol-87cYflkKRhA-unsplash_1629883443_b5b283cd91167f5fa1da.jpg',
			'path_gambar_misi'    => 'kegiatan3_1629537180_476be07e9fda965aa2bd.png',
			'created_at'	=> 	date('Y-m-d'),
			'updated_at'	=> 	date('Y-m-d')
		];

		// Using Query Builder
		$this->db->table('visi_misi')->insert($data);
	}
}
