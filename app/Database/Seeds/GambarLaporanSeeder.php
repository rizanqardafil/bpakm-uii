<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GambarLaporanSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 5; $i++) {
			$id_laporan = rand(1, 4);
			$nama_gambar = $faker->text(10);

			$data = [
				'nama_gambar' => $nama_gambar,
				'slug_gambar'    => url_title($nama_gambar, '-', true),
				'path_gambar'    => 'default.png',
				'path_nama_gambar'    => 'default.png',
				'id_laporan'    => $id_laporan,
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('gambar_laporan')->insert($data);
		}
	}
}
