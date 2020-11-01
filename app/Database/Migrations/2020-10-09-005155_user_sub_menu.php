<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSubMenu extends Migration
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
			'menuId'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'judul'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '128'
			],
			'url'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '128'
			],
			'icon'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '128'
			],
			'isActive'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 1
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user_sub_menu');
	}

	public function down()
	{
		$this->forge->dropTable('user_sub_menu');
	}
}
