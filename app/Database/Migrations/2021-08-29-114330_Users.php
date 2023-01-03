<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_user' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at'	=> [
				'type' => 'DATETIME',
				'null'	=> true
			],
			'updated_at'	=> [
				'type' => 'DATETIME',
				'null'	=> true
			]
		]);
		$this->forge->addKey('id_user', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
