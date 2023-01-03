<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penulis extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_penulis'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_penulis'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_penulis' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_gambar' => [
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
		$this->forge->addKey('id_penulis', true);
		$this->forge->createTable('penulis');
	}

	public function down()
	{
		$this->forge->dropTable('penulis');
	}
}
