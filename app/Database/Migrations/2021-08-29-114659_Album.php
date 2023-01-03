<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Album extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_album'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_album'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_album' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_cover' => [
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
		$this->forge->addKey('id_album', true);
		$this->forge->createTable('album');
	}

	public function down()
	{
		$this->forge->dropTable('album');
	}
}
