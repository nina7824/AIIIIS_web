<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsActiveToSectors extends Migration
{
    public function up()
    {
        // Check if column exists before adding
        if (!$this->db->fieldExists('is_active', 'sectors')) {
            $this->forge->addColumn('sectors', [
                'is_active' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                    'after' => 'parent_id',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('is_active', 'sectors')) {
            $this->forge->dropColumn('sectors', 'is_active');
        }
    }
}