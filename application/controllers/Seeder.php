<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;

/**
 * @property CI_DB_query_builder $db
 */
class Seeder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_cli()) {
            show_404();
        }
        $this->load->database();
    }

    public function index()
    {
        $this->seed_users();
        exit;
    }

    private function seed_users()
    {
        $data = [
            [
                'id'         => Uuid::uuid4()->toString(),
                'name'       => 'Administrator',
                'email'      => 'admin@example.com',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'type'       => 1, // Disesuaikan dengan nama kolom 'type' (1 = Admin)
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => Uuid::uuid4()->toString(),
                'name'       => 'Regular User',
                'email'      => 'user@example.com',
                'password'   => password_hash('user123', PASSWORD_BCRYPT),
                'type'       => 0, // Disesuaikan dengan nama kolom 'type' (0 = Regular User)
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->insert_batch('users', $data);
        echo "- Tabel [users] berhasil di-seed (2 baris data)." . PHP_EOL;
    }
}