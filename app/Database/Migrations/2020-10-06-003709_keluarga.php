<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keluarga extends Migration
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
			'jumlahAnggotaKeluarga' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'alamat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'kabKota' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'kecamatan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'desaKelurahan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'status' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'fotoKK' => [
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
		$this->forge->createTable('keluarga');
	}

	public function down()
	{
		$this->forge->dropTable('keluarga');
	}
}
