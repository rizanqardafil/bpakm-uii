<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GaleriFoto extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_galeri_foto'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_foto'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_galeri_foto' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'path_foto' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'id_album' => [
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
			'CONSTRAINT FOREIGN KEY (id_album) REFERENCES album(id_album)'
		]);
		$this->forge->addKey('id_galeri_foto', true);
		$this->forge->createTable('galeri_foto');
	}

	public function down()
	{
		$this->forge->dropTable('galeri_foto');
	}
}
