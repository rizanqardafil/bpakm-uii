<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 5; $i++) {
			$nama_penulis = $faker->name();

			$data = [
				'nama_penulis' => $nama_penulis,
				'slug_penulis'    => url_title($nama_penulis, '-', true),
				'path_gambar'    => 'penulis_default.png',
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('penulis')->insert($data);
		}
	}
}
