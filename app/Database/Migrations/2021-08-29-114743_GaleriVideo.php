<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GaleriVideo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_galeri_video'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_video'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_galeri_video' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_video' => [
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
		$this->forge->addKey('id_galeri_video', true);
		$this->forge->createTable('galeri_video');
	}

	public function down()
	{
		$this->forge->dropTable('galeri_video');
	}
}
