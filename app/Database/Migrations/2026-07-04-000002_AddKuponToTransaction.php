<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKuponToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'kupon_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'default' => null,
            ],
            'diskon_kupon' => [
                'type' => 'DOUBLE',
                'null' => false,
                'default' => 0,
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'kupon_code');
        $this->forge->dropColumn('transaction', 'diskon_kupon');
    }
}
