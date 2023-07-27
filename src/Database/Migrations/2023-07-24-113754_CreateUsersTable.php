<?php

namespace Michalsn\CodeIgniterKinde\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'bigint', 'unsigned' => true, 'null' => false, 'auto_increment' => true],
            'identity'      => ['type' => 'varchar', 'constraint' => 64, 'null' => false],
            'email'         => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'first_name'    => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'last_name'     => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'picture'       => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'language'      => ['type' => 'varchar', 'constraint' => 8, 'null' => false],
            'timezone'      => ['type' => 'varchar', 'constraint' => 32, 'null' => false],
            'last_login_at' => ['type' => 'datetime', 'null' => true],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true, true);
        $this->forge->addUniqueKey('identity');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
