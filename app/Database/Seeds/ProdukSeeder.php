<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProdukSeeder extends Seeder
{
	public function run()
	{
		// Without faker
		// $data = [
		// 	[
		// 		'id_produk'	=> 1,
		// 		'nama_produk' => 'Gedung SCC',
		// 		'slug_produk'    => url_title('Gedung SCC', '-', true),
		// 		'detail_produk'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt ornare massa eget egestas purus viverra accumsan in nisl. Pharetra vel turpis nunc eget lorem dolor. Penatibus et magnis dis parturient montes. Lacus vestibulum sed arcu non odio. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Lacus vestibulum sed arcu non odio. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Feugiat scelerisque varius morbi enim. Tortor pretium viverra suspendisse potenti nullam ac.Interdum velit euismod in pellentesque massa placerat duis ultricies. Condimentum vitae sapien pellentesque habitant. Tempor nec feugiat nisl pretium fusce id. Odio morbi quis commodo odio aenean sed adipiscing. Dui sapien eget mi proin sed libero enim sed faucibus. Ipsum nunc aliquet bibendum enim facilisis. Pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Amet facilisis magna etiam tempor orci eu lobortis. Cras tincidunt lobortis feugiat vivamus at. Morbi tincidunt ornare massa eget. Amet porttitor eget dolor morbi non arcu risus quis varius. Etiam tempor orci eu lobortis elementum. Purus non enim praesent elementum facilisis leo vel. Bibendum est ultricies integer quis auctor elit sed vulputate.Molestie a iaculis at erat pellentesque adipiscing commodo elit at. Porta non pulvinar neque laoreet suspendisse interdum. Est velit egestas dui id ornare arcu. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada. Duis ut diam quam nulla porttitor. Vitae justo eget magna fermentum iaculis eu non diam phasellus. Id porta nibh venenatis cras sed felis eget. Turpis massa sed elementum tempus egestas sed sed risus. Lacus sed turpis tincidunt id aliquet risus feugiat. Sed enim ut sem viverra aliquet eget. Pulvinar neque laoreet suspendisse interdum. Faucibus et molestie ac feugiat sed lectus vestibulum. Risus commodo viverra maecenas accumsan. Sit amet commodo nulla facilisi nullam vehicula ipsum. Urna id volutpat lacus laoreet non curabitur gravida arcu ac. Et malesuada fames ac turpis egestas. Maecenas pharetra convallis posuere morbi. Non pulvinar neque laoreet suspendisse interdum consectetur. A pellentesque sit amet porttitor eget dolor morbi non arcu.</p>',
		// 		'kontak'    => '085327748123',
		// 		'path_gambar_cover'    => 'artikel2_1629537282_998fb86b4f165f9a824e.jpg',
		// 		'path_nama_gambar'    => 'artikel2.jpg',
		// 		'created_at'	=> 	date('Y-m-d'),
		// 		'updated_at'	=> 	date('Y-m-d')
		// 	],
		// 	[
		// 		'id_produk'	=> 2,
		// 		'nama_produk' => 'Tenda',
		// 		'slug_produk'    => url_title('Tenda', '-', true),
		// 		'detail_produk'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra aliquet eget sit amet tellus. At elementum eu facilisis sed odio morbi quis commodo odio. Malesuada fames ac turpis egestas maecenas. At tempor commodo ullamcorper a lacus vestibulum. Pulvinar sapien et ligula ullamcorper malesuada proin. Egestas erat imperdiet sed euismod nisi porta lorem. Eget aliquet nibh praesent tristique magna sit amet. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Semper eget duis at tellus at urna. Mi quis hendrerit dolor magna.Eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum. Vitae aliquet nec ullamcorper sit amet risus. Odio aenean sed adipiscing diam donec adipiscing. Eu mi bibendum neque egestas congue quisque egestas diam in. Dapibus ultrices in iaculis nunc sed augue lacus viverra vitae. Nunc sed augue lacus viverra. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque. Vel orci porta non pulvinar neque. Arcu cursus euismod quis viverra nibh cras pulvinar. Mauris cursus mattis molestie a iaculis at.</p>',
		// 		'kontak'    => '',
		// 		'path_gambar_cover'    => 'artikel1_1629537939_35f49be4ff8ddc4badbf.jpg',
		// 		'path_nama_gambar'    => 'artikel1.jpg',
		// 		'created_at'	=> 	date('Y-m-d'),
		// 		'updated_at'	=> 	date('Y-m-d')
		// 	],
		// 	[
		// 		'id_produk'	=> 3,
		// 		'nama_produk' => 'Mobil',
		// 		'slug_produk'    => url_title('Mobil', '-', true),
		// 		'detail_produk'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vestibulum morbi blandit cursus risus. Tempor commodo ullamcorper a lacus vestibulum sed. Est ultricies integer quis auctor elit sed vulputate mi sit. Tincidunt augue interdum velit euismod in. In cursus turpis massa tincidunt dui ut ornare. Pulvinar pellentesque habitant morbi tristique senectus et netus. Vitae turpis massa sed elementum. Nullam vehicula ipsum a arcu. Vel quam elementum pulvinar etiam. Cras adipiscing enim eu turpis egestas pretium aenean pharetra. Tortor pretium viverra suspendisse potenti nullam ac. Mattis aliquam faucibus purus in massa. Ut faucibus pulvinar elementum integer enim neque volutpat. Pellentesque diam volutpat commodo sed. At volutpat diam ut venenatis tellus in. Justo eget magna fermentum iaculis. Massa tempor nec feugiat nisl.Praesent semper feugiat nibh sed pulvinar proin gravida hendrerit. Eros donec ac odio tempor orci dapibus ultrices in iaculis. Tellus elementum sagittis vitae et. Etiam non quam lacus suspendisse faucibus interdum posuere. Bibendum ut tristique et egestas. Ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper. Ut etiam sit amet nisl. Lorem ipsum dolor sit amet consectetur adipiscing. Urna molestie at elementum eu facilisis. Varius morbi enim nunc faucibus. Urna condimentum mattis pellentesque id nibh tortor id aliquet lectus. Ac placerat vestibulum lectus mauris ultrices. Donec ac odio tempor orci dapibus ultrices in iaculis nunc. Viverra orci sagittis eu volutpat. Pulvinar pellentesque habitant morbi tristique senectus et netus et. Id faucibus nisl tincidunt eget nullam non nisi est sit. Sit amet dictum sit amet justo donec.Consectetur purus ut faucibus pulvinar elementum integer enim. Commodo quis imperdiet massa tincidunt nunc. Morbi enim nunc faucibus a pellentesque sit amet porttitor. Mattis molestie a iaculis at erat pellentesque adipiscing. Faucibus vitae aliquet nec ullamcorper sit amet. Magna sit amet purus gravida quis blandit. Neque laoreet suspendisse interdum consectetur libero id. Iaculis at erat pellentesque adipiscing commodo elit at imperdiet dui. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget. Non sodales neque sodales ut etiam. Aliquet eget sit amet tellus cras adipiscing enim. Fringilla ut morbi tincidunt augue interdum velit. Commodo quis imperdiet massa tincidunt nunc pulvinar sapien et. Urna nec tincidunt praesent semper feugiat nibh sed pulvinar. In fermentum et sollicitudin ac orci phasellus egestas. Habitant morbi tristique senectus et netus et malesuada fames ac. Et netus et malesuada fames ac turpis egestas integer eget. Auctor eu augue ut lectus arcu.',
		// 		'kontak'    => '082135794804',
		// 		'path_gambar_cover'    => 'joey-banks-YApiWyp0lqo-unsplash_1629537695_855ce2d9757a9256b1d1.jpg',
		// 		'path_nama_gambar'    => 'joey-banks-YApiWyp0lqo-unsplash.jpg',
		// 		'created_at'	=> 	date('Y-m-d'),
		// 		'updated_at'	=> 	date('Y-m-d')
		// 	],
		// ];
		// $this->db->table('produk')->insertBatch($data);

		// Using faker
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 10; $i++) {
			$nama_produk = $faker->text(50);

			$data = [
				'nama_produk' => $nama_produk,
				'slug_produk'    => url_title($nama_produk, '-', true),
				'detail_produk'    => $faker->text(500),
				'kontak'    => '',
				'path_gambar_cover'    => 'default.png',
				'path_nama_gambar'    => 'default.png',
				'created_at'	=> 	Time::createFromTimestamp($faker->unixTime()),
				'updated_at'	=> 	Time::createFromTimestamp($faker->unixTime())
			];
			$this->db->table('produk')->insert($data);
		}
	}
}
