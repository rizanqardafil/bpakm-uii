<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GaleriFotoSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 5; $i++) {
			$id_album = rand(1, 3);
			$nama_foto = $faker->text(10);

			$data = [
				'nama_foto' => $nama_foto,
				'slug_galeri_foto'    => url_title($nama_foto, '-', true),
				'path_foto'    => 'default.png',
				'id_album'    => $id_album,
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('galeri_foto')->insert($data);
		}
	}
}
