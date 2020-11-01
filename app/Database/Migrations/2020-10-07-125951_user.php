<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
			'nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'fotoProfil'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'roleId'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'isActive'       => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'constraint'     => true
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'constraint'     => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
