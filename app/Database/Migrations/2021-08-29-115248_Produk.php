<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_produk'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_produk'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_produk' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'detail_produk' => [
				'type' => 'LONGTEXT'
			],
			'kontak' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_gambar_cover' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'path_nama_gambar' => [
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
		$this->forge->addKey('id_produk', true);
		$this->forge->createTable('produk');
	}

	public function down()
	{
		$this->forge->dropTable('produk');
	}
}
