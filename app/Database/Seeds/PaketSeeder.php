<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PaketSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 10; $i++) {
			$id_produk = rand(1, 10);
			$harga = rand(50000, 1000000);
			$nama_paket = $faker->text(10);

			$data = [
				'nama_paket' => $nama_paket,
				'slug_paket'    => url_title($nama_paket, '-', true),
				'harga'    => $harga,
				'id_produk'    => $id_produk,
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];

			// Using Query Builder
			$this->db->table('paket')->insert($data);
		}
	}
}
