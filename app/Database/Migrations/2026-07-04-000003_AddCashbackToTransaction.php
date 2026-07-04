<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCashbackToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'cashback' => [
                'type' => 'DOUBLE',
                'null' => false,
                'default' => 0,
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'cashback');
    }
}
