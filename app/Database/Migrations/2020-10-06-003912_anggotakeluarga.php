<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggotakeluarga extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'noKK'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'noKTP' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'nama' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'tempatLahir' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'tanggalLahir' => [
				'type'           => 'DATE',
				'null'           => true
			],
			'jenisKelamin' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'statusPerkawinan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'pendidikan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'pekerjaan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'catatan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'fotoKTP' => [
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
		$this->forge->createTable('anggotakeluarga');
	}

	public function down()
	{
		$this->forge->dropTable('anggotakeluarga');
	}
}
