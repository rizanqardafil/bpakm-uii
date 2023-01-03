<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrganisasiSeeder extends Seeder
{
	public function run()
	{
		$keterangan = 'Struktur Organisasi BPA KM UII terdiri dari sekumpulan mahasiswa yang mana, bertugas untuk memimpin dan menjalankan organisasi, bertanggung jawab penuh atas keseluruhan organisasi, serta mengambil keputusan tertinggi mengenai kebijakan dan tata kelola organisasi selama satu periode tersebut.';

		$data = [
			'id_organisasi'	=> 1,
			'nama' => 'Anggota BPA',
			'slug_organisasi'    => 'anggota-bpa',
			'keterangan'    => $keterangan,
			'image'    => 'organisasi_1629439217_bf317bcabccf7f3ae73b.jpg',
			'created_at'	=> 	date('Y-m-d'),
			'updated_at'	=> 	date('Y-m-d')
		];

		// Using Query Builder
		$this->db->table('organisasi')->insert($data);
	}
}
