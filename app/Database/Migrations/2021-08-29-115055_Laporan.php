<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_laporan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_laporan'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_laporan' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_laporan' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_nama_laporan' => [
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
		$this->forge->addKey('id_laporan', true);
		$this->forge->createTable('laporan');
	}

	public function down()
	{
		$this->forge->dropTable('laporan');
	}
}
