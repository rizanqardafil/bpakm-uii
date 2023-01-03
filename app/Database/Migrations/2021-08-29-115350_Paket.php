<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paket extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_paket'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_paket'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'slug_paket' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'harga' => [
				'type' => 'INT',
				'constraint' => 16,
			],
			'id_produk' => [
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
			'CONSTRAINT FOREIGN KEY (id_produk) REFERENCES produk(id_produk)'
		]);
		$this->forge->addKey('id_paket', true);
		$this->forge->createTable('paket');
	}

	public function down()
	{
		$this->forge->dropTable('paket');
	}
}
