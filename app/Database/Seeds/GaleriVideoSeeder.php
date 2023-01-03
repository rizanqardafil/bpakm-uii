<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GaleriVideoSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 6; $i++) {
			$nama_video = $faker->text(30);

			$data = [
				'nama_video' => $nama_video,
				'slug_galeri_video'    => url_title($nama_video, '-', true),
				'path_video'    => 'https://youtu.be/W0Zolvz1Z3A',
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('galeri_video')->insert($data);
		}
	}
}
