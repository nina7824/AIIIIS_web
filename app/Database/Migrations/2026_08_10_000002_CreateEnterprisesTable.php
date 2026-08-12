<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnterprisesTable extends Migration
{
    public function up()
    {
        // Check if table exists first
        if ($this->db->tableExists('enterprises')) {
            return;
        }

        $this->forge->addField([
            'enterprise_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'enterprise_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'sector' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'contact_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'products_services' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'employees' => [
                'type' => 'INT',
                'null' => true,
            ],
            'revenue' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'growth_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'technology_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'innovation_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'environmental_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'investment_requirements' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'rdb_certificate' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('enterprise_id', true);
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('enterprises');
    }

    public function down()
    {
        $this->forge->dropTable('enterprises');
    }
}