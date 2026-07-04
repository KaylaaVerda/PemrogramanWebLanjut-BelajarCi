<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBiayaAdminToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'biaya_admin' => [
                'type'    => 'DOUBLE',
                'null'    => false,
                'default' => 0,
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'biaya_admin');
    }
}
