<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bansos extends Migration
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
			'noKK'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'kepalaKeluarga' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'idBansos' => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'namaBansos' => [
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
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'statusAnggota' => [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
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
		$this->forge->createTable('bansos');
	}

	public function down()
	{
		$this->forge->dropTable('bansos');
	}
}
