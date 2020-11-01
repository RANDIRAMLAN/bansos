<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterBansos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'idBansos'          => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'namaBansos'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'kategori' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'pendamping' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'nominal' => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'tipeBansos' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('data_bansos');
	}

	public function down()
	{
		$this->forge->dropTable('data_bansos');
	}
}
