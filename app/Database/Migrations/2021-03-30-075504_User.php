<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
        $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint'     => 9,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'profile_image' => [
                    'type' => 'VARCHAR',
                    'constraint' => '500',
                ],
                'role' => [
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'default'  => 'user',
                ],
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
                'deleted_at datetime default NULL',
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['1', '0'],
                    'default' => '1',
                ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user', true);
	}

	public function down()
	{
		$this->forge->dropTable('user', true);
	}
}
