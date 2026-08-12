<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvestorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'investor_id' => [
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
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_document' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'investment_sector' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'preferred_enterprise_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'geographic_preferences' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'technology_interests' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sustainability_preferences' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'investment_stage' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'expected_returns' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'investment_criteria' => [
                'type' => 'TEXT',
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
        
        $this->forge->addKey('investor_id', true);
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('investors');
    }

    public function down()
    {
        $this->forge->dropTable('investors');
    }
}