<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodePos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'posDesaKelurahan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'

			],
			'desaKelurahan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'

			],
			'kecamatan'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'kabKota'            => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			]
		]);
		$this->forge->createTable('kode_pos');
	}

	public function down()
	{
		$this->forge->dropTable('kode_pos');
	}
}
