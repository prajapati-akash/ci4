<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Candidate extends Migration
{
	public function up()
	{
		$this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 9,
                    'auto_increment' => true,
                ],
                'userid' => [
                    'type'  => 'INT',
                    'constraint' => 9,
                ],
                'firstname' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'middlename' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'lastname' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'education' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'language' => [
                    'type' => 'ENUM',
                    'constraint' => ['php', 'java', 'android'],
                ],
                'expirience' => [
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                ],
                'currentctc' => [
                    'type' => 'BIGINT',
                    'constraint' => '20',
                ],
                'expectedctc' => [
                    'type' => 'BIGINT',
                    'constraint' => '20',
                ],
                'language' => [
                    'type' => 'ENUM',
                    'constraint' => ['php', 'java', 'android'],
                ],
                'noticeperiod' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],                
                'interviewdate' => [
                    'type' => 'DATE',
                ],
                'reasonleavejob' => [
                    'type' => 'varchar',
                    'constraint' => '20',
                ],
                'currentstatus' => [
                    'type' => 'ENUM',
                    'constraint' => ['Reviewed','Hired','Rejected'],
                ],
                'rejectedreason' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'default' => NULL,
                ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('userid','user','id');

        $this->forge->createTable('candidate', true);
	}

	public function down()
	{
		$this->forge->dropTable('candidate', true);
	}
}
