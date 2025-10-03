<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class CreateEnrollmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'u_id' => ['type' => 'INT', 'unsigned' => true],
            'c_id' => ['type' => 'INT', 'unsigned' => true],
            'course_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'course_code' => ['type' => 'VARCHAR', 'constraint' => 100],
            'duration' => ['type' => 'VARCHAR', 'constraint' => 50],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.0,
            ],
            'e_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('u_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('c_id', 'courses', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('enrollment');
    }

    public function down()
    {
        $this->forge->dropTable('enrollment');
    }
}
