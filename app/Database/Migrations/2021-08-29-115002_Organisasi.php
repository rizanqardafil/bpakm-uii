<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Organisasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_organisasi'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_organisasi'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'keterangan' => [
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
		$this->forge->addKey('id_organisasi', true);
		$this->forge->createTable('organisasi');
	}

	public function down()
	{
		$this->forge->dropTable('organisasi');
	}
}
