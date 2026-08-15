<?php
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 */
class M_Auth extends CI_Model
{
    /**
     * Nama tabel user di database
     */
    protected string $table = 'users';

    /**
     * Nama session key untuk menyimpan ID User
     */
    protected string $sessionKey = 'user_id';

    public function __construct()
    {
        parent::__construct();

        // Safety net: Pastikan library session dan database selalu ter-load
        if (!isset($this->session)) {
            $this->load->library('session');
        }
        $this->load->database();
    }

    // ==========================================
    // 1. ATTEMPTS & CREDENTIALS CHECK
    // ==========================================

    /**
     * Melakukan verifikasi login (Laravel: Auth::attempt())
     *
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function attempt(string $email, string $password, bool $remember = false): bool
    {
        // Cari user berdasarkan email
        $user = $this->db->get_where($this->table, ['email' => $email])->row();

        if (!$user) {
            $this->incrementLoginAttempts();
            return false;
        }

        // Verifikasi password (Bcrypt / Argon2)
        if (password_verify($password, $user->password)) {
            // Berhasil login: bersihkan percobaan login & buat session
            $this->clearLoginAttempts();
            $this->login($user, $remember);
            return true;
        }

        // Gagal login
        $this->incrementLoginAttempts();
        return false;
    }

    /**
     * Mengambil jumlah percobaan login yang gagal
     */
    public function loginAttempts(): int
    {
        return (int) $this->session->userdata('login_attempts') ?? 0;
    }

    /**
     * Menambah hitungan percobaan login
     */
    public function incrementLoginAttempts(): void
    {
        $attempts = $this->loginAttempts() + 1;
        $this->session->set_userdata('login_attempts', $attempts);
    }

    /**
     * Membersihkan hitungan percobaan login
     */
    public function clearLoginAttempts(): void
    {
        $this->session->unset_userdata('login_attempts');
    }

    // ==========================================
    // 2. SESSION & STATE MANAGEMENT
    // ==========================================

    /**
     * Menyimpan data user ke dalam session (Manual Login)
     */
    public function login(object $user, bool $remember = false): void
    {
        $sessionData = [
            $this->sessionKey => $user->id,
            'user_email' => $user->email,
            'user_name' => $user->name,
            'user_level' => $user->type,
            'logged_in' => true,
        ];

        $this->session->set_userdata($sessionData);

        // Jika opsi 'Remember Me' dicentang (Opsional: perpanjang waktu session)
        if ($remember) {
            // 30 hari dalam detik
            $this->config->set_item('sess_expiration', 86400 * 30);
        }
    }

    /**
     * Cek apakah pengguna saat ini sudah terautentikasi (Laravel: Auth::check())
     */
    public function check(): bool
    {
        return (bool) $this->session->userdata('logged_in') && $this->session->userdata($this->sessionKey) !== null;
    }

    /**
     * Cek apakah pengguna saat ini adalah Guest / belum login (Laravel: Auth::guest())
     */
    public function guest(): bool
    {
        return !$this->check();
    }

    /**
     * Mengeluarkan pengguna dari sistem (Laravel: Auth::logout())
     */
    public function logout(): void
    {
        $this->session->sess_destroy();
    }

    // ==========================================
    // 3. GETTERS (AUTHENTICATED USER DATA)
    // ==========================================

    /**
     * Mengambil seluruh object data user yang sedang terautentikasi (Laravel: Auth::user())
     * Mengambil data segar dari Database jika dibutuhkan.
     * 
     * @param bool $fresh Ambil ulang dari DB atau dari Session saja?
     * @return object|null
     */
    public function user(bool $fresh = false): ?object
    {
        if (!$this->check()) {
            return null;
        }

        $userId = $this->session->userdata($this->sessionKey);

        if ($fresh) {
            return $this->db->get_where($this->table, ['id' => $userId])->row();
        }

        // Return object berbasis session data untuk performa kencang tanpa hit DB
        return (object) [
            'id' => $userId,
            'name' => $this->session->userdata('user_name'),
            'email' => $this->session->userdata('user_email'),
            'level' => $this->session->userdata('user_level'),
        ];
    }

    /**
     * Alias method auth() untuk mendapatkan user data
     */
    public function auth(bool $fresh = false): ?object
    {
        return $this->user($fresh);
    }

    /**
     * Mengambil ID user yang sedang login (Laravel: Auth::id())
     */
    public function id(): ?string
    {
        return $this->session->userdata($this->sessionKey);
    }

    /**
     * Mengambil Nama user yang sedang login
     */
    public function name(): ?string
    {
        return $this->session->userdata('user_name');
    }

    /**
     * Mengambil Email user yang sedang login
     */
    public function email(): ?string
    {
        return $this->session->userdata('user_email');
    }

    /**
     * Mengambil Level / Role user yang sedang login
     */
    public function level(): ?string
    {
        return $this->session->userdata('user_level');
    }
}