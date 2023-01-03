<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlbumSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				// 'id_album'	=> 1,
				'nama_album' => 'Orientasi Anggota',
				'slug_album'    => url_title('Orientasi Anggota', '-', true),
				'path_cover'    => 'default.png',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
			[
				// 'id_album'	=> 2,
				'nama_album' => 'Makrab',
				'slug_album'    => url_title('Makrab', '-', true),
				'path_cover'    => 'default.png',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
			[
				// 'id_album'	=> 3,
				'nama_album' => 'Kunjungan Industri',
				'slug_album'    => url_title('Kunjungan Industri', '-', true),
				'path_cover'    => 'default.png',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
		];

		// Using Query Builder
		$this->db->table('album')->insertBatch($data);
	}
}
