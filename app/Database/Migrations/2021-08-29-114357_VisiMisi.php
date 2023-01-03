<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VisiMisi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_visi_misi'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_konten'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_visi_misi' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'isi_visi' => [
				'type' => 'LONGTEXT'
			],
			'isi_misi' => [
				'type' => 'LONGTEXT'
			],
			'path_gambar_visi' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_gambar_misi' => [
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
		$this->forge->addKey('id_visi_misi', true);
		$this->forge->createTable('visi_misi');
	}

	public function down()
	{
		$this->forge->dropTable('visi_misi');
	}
}
