<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_barang' => [
				'type' => 'INT',
				'constraint' =>11,
				'auto_increment' => true
			],
			'nama_barang' => [
				'type' => 'VARCHAR',
				'constraint' =>225
			],
			'qty' => [
				'type' => 'INT',
				'constraint' =>11
			],
			'harga_beli' => [
				'type' => 'INT',
				'constraint' =>11
			],
			'harga_jual' => [
				'type' => 'INT',
				'constraint' =>11
			],
		]);
		$this->forge->addKey('id_barang');
		$this->forge->createTable('categories');
	}


	public function down()
	{

	}
}
