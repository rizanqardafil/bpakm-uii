<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ArtikelSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 5; $i++) {
			$id_penulis = rand(1, 5);
			$judul_artikel = $faker->text(30);

			$data = [
				'judul_artikel' => $judul_artikel,
				'slug_artikel'    => url_title($judul_artikel, '-', true),
				'isi_artikel'    => $faker->text(1000),
				'path_gambar'    => 'default.png',
				'id_penulis'    => $id_penulis,
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('artikel')->insert($data);
		}
	}
}
