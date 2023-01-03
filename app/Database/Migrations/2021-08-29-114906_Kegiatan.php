<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kegiatan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'judul'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_kegiatan' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'sub_judul' => [
				'type' => 'LONGTEXT'
			],
			'image' => [
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
		$this->forge->addKey('id_kegiatan', true);
		$this->forge->createTable('kegiatan');
	}

	public function down()
	{
		$this->forge->dropTable('kegiatan');
	}
}
