<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$name = 'Super Admin';
		$slug_user = url_title($name, '-', true);
		$password = password_hash('admin123', PASSWORD_BCRYPT);

		$data = [
			'id_user'	=> 1,
			'name' => $name,
			'slug_user'    => $slug_user,
			'username'    => 'admin',
			'email'    => 'admin@gmail.com',
			'password'    => $password,
			'created_at'	=> 	date('Y-m-d'),
			'updated_at'	=> 	date('Y-m-d')
		];

		// Using Query Builder
		$this->db->table('users')->insert($data);
	}
}
