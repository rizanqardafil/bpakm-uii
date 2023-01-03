<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Artikel extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_artikel'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'judul_artikel'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_artikel' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'isi_artikel' => [
				'type' => 'LONGTEXT'
			],
			'path_gambar' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'id_penulis' => [
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
			'CONSTRAINT FOREIGN KEY (id_penulis) REFERENCES penulis(id_penulis)'
		]);
		$this->forge->addKey('id_artikel', true);
		$this->forge->createTable('artikel');
	}

	public function down()
	{
		$this->forge->dropTable('artikel');
	}
}
