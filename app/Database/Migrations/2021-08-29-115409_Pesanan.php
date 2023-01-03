<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesanan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pesanan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tanggal_pinjam'       => [
				'type' => 'DATETIME'
			],
			'tanggal_kembali' => [
				'type' => 'DATETIME'
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
		$this->forge->addKey('id_pesanan', true);
		$this->forge->createTable('pesanan');
	}

	public function down()
	{
		$this->forge->dropTable('pesanan');
	}
}
