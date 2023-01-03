<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SejarahSeeder extends Seeder
{
	public function run()
	{
		$isi_sejarah = 'BPA (Badan Pengelola Aset ) KM UII adalah sebuah organisasi yang awalnya disebut Tim Kerja Pengelola Aset SCC UII yang pertama kali dibentuk tahun 2014. Terbentuknya BPA KM UII didasari atas kepentingan jangka Panjang Lembaga KM UII  yaitu dalam upaya mewujudkan kemandirian, serta proses perbaikan sistem kelembagaan sehingga dapat meningkatkan tata kelola di Lembaga KM UII. Unit Usaha BPA yang awalnya hanya mengandalkan penyewaan SCC, sekarang terus berkembang hingga pada usaha-usaha lain diantaranya pengelolaan jas almamater, layanan sistem informasi, dan usaha strategis lainnya.';
		$isi_logo = 'Ini Logo. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc vel risus commodo viverra maecenas. Vestibulum mattis ullamcorper velit sed. Nisl vel pretium lectus quam id leo in vitae. Nunc vel risus commodo viverra maecenas. Vestibulum mattis ullamcorper velit sed. Nisl vel pretium lectus quam id leo in vitae. ';

		$data = [
			'id_sejarah'	=> 1,
			'nama_konten' => 'Sejarah',
			'slug_sejarah'    => 'sejarah',
			'isi_sejarah'    => $isi_sejarah,
			'isi_logo'    => $isi_logo,
			'path_gambar_sejarah'    => 'kegiatan3_1629512108_c3bca03a7b037f502025.png',
			'path_gambar_logo'    => 'artikel1_1629511876_db90cbb8f0f59d64f97d.jpg',
			'created_at'	=> 	date('Y-m-d'),
			'updated_at'	=> 	date('Y-m-d')
		];

		// Using Query Builder
		$this->db->table('sejarah')->insert($data);
	}
}
