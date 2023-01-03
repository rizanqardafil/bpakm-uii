<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GambarLaporan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_gambar'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_gambar'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_gambar' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_gambar' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_nama_gambar' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'id_laporan' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
			],
			'created_at'	=> [
				'type' => 'DATETIME',
				'null'	=> true
			],
			'updated_at'	=> [
				'type' => 'DATETIME',
				'null'	=> true
			],
			'CONSTRAINT FOREIGN KEY (id_laporan) REFERENCES laporan(id_laporan)'
		]);
		$this->forge->addKey('id_gambar', true);
		$this->forge->createTable('gambar_laporan');
	}

	public function down()
	{
		$this->forge->dropTable('gambar_laporan');
	}
}
