<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Config extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_config'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'namaweb'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'telepon' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'logo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'icon' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'link_drive_laporan' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'keyword' => [
				'type' => 'TEXT'
			],
			'metatext' => [
				'type' => 'TEXT'
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
		$this->forge->addKey('id_config', true);
		$this->forge->createTable('config');
	}

	public function down()
	{
		$this->forge->dropTable('config');
	}
}
