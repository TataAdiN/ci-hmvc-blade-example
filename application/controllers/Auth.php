<?php
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property M_Auth $mAuth
 */
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth', 'mAuth');
    }

    public function process()
    {
        $this->middleware('guest');

        if ($this->mAuth->loginAttempts() >= 5) {
            $this->session->set_flashdata('swal_error', 'Terlalu banyak percobaan login yang gagal. Silakan coba beberapa saat lagi!');
            redirect();
            exit;
        }

        $email = $this->input->post('email', true);
        $password = $this->input->post('password');
        $remember = (bool) $this->input->post('remember');

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('swal_error', 'Email dan Password wajib diisi!');
            redirect();
            exit;
        }

        if ($this->mAuth->attempt($email, $password, $remember)) {
            $this->session->set_flashdata('swal_success', 'Selamat datang kembali, ' . $this->mAuth->name() . '!');
            redirect('admin');
        } else {
            $this->session->set_flashdata('swal_error', 'Email atau password yang Anda masukkan salah.');
            redirect();
        }
    }

    public function logout()
    {
        $this->mAuth->logout();
        $this->session->set_flashdata('swal_success', 'Anda telah berhasil keluar dari sistem.');
        redirect();
    }
}