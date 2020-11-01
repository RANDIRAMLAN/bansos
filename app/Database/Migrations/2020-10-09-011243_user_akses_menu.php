<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAksesMenu extends Migration
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
			'roleId'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'menuId'       => [
				'type'           => 'INT',
				'constraint'     => 11
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user_akses_menu');
	}

	public function down()
	{
		$this->forge->dropTable('user_akses_menu');
	}
}
