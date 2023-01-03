<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sejarah extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_sejarah'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_konten'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_sejarah' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'isi_sejarah' => [
				'type' => 'LONGTEXT'
			],
			'isi_logo' => [
				'type' => 'LONGTEXT'
			],
			'path_gambar_sejarah' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_gambar_logo' => [
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
		$this->forge->addKey('id_sejarah', true);
		$this->forge->createTable('sejarah');
	}

	public function down()
	{
		$this->forge->dropTable('sejarah');
	}
}
