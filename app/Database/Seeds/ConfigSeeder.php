<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'id_config'	=> 1,
			'namaweb' => 'Badan Pengelola Aset KM UII',
			'email'    => 'bpa.km.uii@gmail.com',
			'telepon'    => '081266111497',
			'logo'    => 'logo_web_1630150563_6267eb40706463734985.png',
			'icon'    => 'ikon_web_1630150634_71ce9264dee51def861e.png',
			'link_drive_laporan'    => 'https://www.google.com/',
			'keyword'    => 'industri, Gedung, Pernikahan, event,sewa gedung, kaliurang, SCC UII,UII,universitas islam indonesia',
			'metatext'    => '',
			'created_at'	=> 	date('Y-m-d'),
			'updated_at'	=> 	date('Y-m-d')
		];

		// Using Query Builder
		$this->db->table('config')->insert($data);
	}
}
