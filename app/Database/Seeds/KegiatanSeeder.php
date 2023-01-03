<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KegiatanSeeder extends Seeder
{
	public function run()
	{

		$data = [
			[
				'id_kegiatan'	=> 1,
				'judul' => 'Yes, We Are Open !',
				'slug_kegiatan'    => url_title('Yes, We Are Open !', '-', true),
				'sub_judul'    => 'BPA KM UII kembali membuka seluruh produknya seperti SCC dan SAC pada tahun 2021 ! Segera hubungi customer service untuk mendapatkan harga spesial dari setiap produk BPA KM UII !',
				'image'    => 'ng-creative-4rkipskuVcs-unsplash_1629882381_9e2d24203fc4a586e2b6.jpg',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
			[
				'id_kegiatan'	=> 2,
				'judul' => 'BPA KM UII Sukses Mengadakan CreativePreneurTalks 2020 !',
				'slug_kegiatan'    => url_title('BPA KM UII Sukses Mengadakan CreativePreneurTalks 2020 !', '-', true),
				'sub_judul'    => 'Sabtu ( 31/10/2020), tim magang BPA KM UII sukses mengadakan webinar CreativePreneurTalks 2020 dengan tema " Digital Branding Dalam Eksistensi Ekonomi Kreatif " banget',
				'image'    => 'dmitriy-frantsev-zbafP5GeL0Q-unsplash_1629885298_1a8d826dd5c825f15717.jpg',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
			[
				'id_kegiatan'	=> 3,
				'judul' => 'Sosialisasi Gedung SCC',
				'slug_kegiatan'    => url_title('Sosialisasi Gedung SCC', '-', true),
				'sub_judul'    => 'BPA (Badan Pengelola Aset ) KM UII adalah sebuah organisasi yang awalnya disebut Tim Kerja Pengelola Aset SCC UII yang pertama kali dibentuk tahun 2014. Terbentuknya BPA KM UII didasari atas kepentingan jangka Panjang Lembaga KM UII  yaitu dalam upaya menjadi lebih baik',
				'image'    => 'tim-marshall--Ic0ESCHvWU-unsplash_1630225860_3398a640ae4193da5cfa.jpg',
				'created_at'	=> 	date('Y-m-d'),
				'updated_at'	=> 	date('Y-m-d')
			],
		];

		// Using Query Builder
		$this->db->table('kegiatan')->insertBatch($data);
	}
}
