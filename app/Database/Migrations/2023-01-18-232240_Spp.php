<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_admin' => [
                'type'       => 'INT',
                'constraint' => '11',
                'unsigned'   => true
            ],
			'nis' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
			'nama_santri' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
			'tanggal' => [
                'type'       => 'DATE',
                'null'       => true
            ],
            'jumlah_iuran'  => [
                'type'       => 'INT',
                'constrait'  => '11'
            ],
            'keterangan'    => [
                'type'      => 'text',
                'null'      => true
            ],
            'createdAt' => [
				'type'		 => 'DATETIME',
				'null'		 => TRUE
			],
			'updatedAt' => [
				'type'		 => 'DATETIME',
				'null'		 => TRUE
			]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('nis', 'santri', 'nis', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spp');
    }

    public function down()
    {
        $this->forge->dropTable('spp');
    }
}
