<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
      $data = [
        [
          'id' => 1,
          'email' => 'lingkunganhidup.kotamadiun@gmail.com',
          'username' => 'admin_dlh',
          // Password => 'admin_dlh'
          'password_hash' => '$2y$10$U69S/24WYjmTEoFonVGwauaqZqBtCBa4MtAFJp8eURvwZrdXH7twe',
          'reset_hash' => NULL,
          'reset_at' => NULL,
          'reset_expires' => NULL,
          'activate_hash' => NULL,
          'status' => NULL,
          'status_message' => NULL, 
          'active' => 1,
          'force_pass_reset' => 0, 
          'created_at' => '2021-09-22 04:32:37',
          'updated_at' => '2021-09-22 04:32:37',
          'deleted_at' => NULL
        ],
      ];

      $this->db->table('users')->insertBatch($data);
    }
}
