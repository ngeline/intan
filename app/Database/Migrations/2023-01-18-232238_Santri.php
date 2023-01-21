<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Santri extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nis' => [
                'type'           => 'VARCHAR',
                'constraint'     => '10'
            ],
            'id_kelas' => [
                'type'       => 'INT',
                'constraint' => '11',
                'unsigned'   => true
            ],
            'id_admin' => [
                'type'       => 'INT',
                'constraint' => '11',
                'unsigned'   => true
            ],
			'nama_santri' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
			'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
			'status_santri' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
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
        $this->forge->addKey('nis', true);
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'CASCADE');
        $this->forge->createTable('santri');
    }

    public function down()
    {
        $this->forge->dropTable('santri');
    }
}
