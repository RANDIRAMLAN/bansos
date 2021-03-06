<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11

			],
			'email'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'

			],
			'token'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'     => true
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'     => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user_token');
	}

	public function down()
	{
		$this->forge->dropTable('user_token');
	}
}
