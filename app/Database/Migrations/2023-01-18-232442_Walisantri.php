<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Walisantri extends Migration
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
            'id_user' => [
                'type'       => 'INT',
                'constraint' => '11',
                'unsigned'   => true
            ],
            'nis' => [
                'type'       => 'VARCHAR',
                'constraint' => '10'
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
			'tempat' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
			'tanggal_lahir' => [
                'type'       => 'date'
            ],
            'usia_santri' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'alamat' => [
                'type'       => 'text'
            ],
            'nama_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'nama_wali' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pekerjaan_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pekerjaan_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
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
        $this->forge->addForeignKey('nis', 'santri', 'nis', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'CASCADE');
        $this->forge->createTable('walisantri');
    }

    public function down()
    {
        $this->forge->dropTable('walisantri');
    }
}
