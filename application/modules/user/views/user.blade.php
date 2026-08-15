<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'User Portal' }}</title>

  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bs-body-tertiary-bg);
      transition: background-color 0.3s ease, color 0.3s ease;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Top Navbar Styling */
    .navbar-brand-logo {
      font-weight: 700;
      font-size: 1.35rem;
      color: var(--bs-body-color);
      text-decoration: none;
      letter-spacing: -0.5px;
    }

    .navbar-brand-logo span {
      color: #0d6efd;
    }

    .nav-link {
      font-weight: 500;
      font-size: 0.95rem;
      padding: 0.5rem 0.85rem !important;
      border-radius: 0.5rem;
      transition: all 0.2s ease;
    }

    .nav-link:hover,
    .nav-link.active {
      color: #0d6efd !important;
      background-color: rgba(13, 110, 253, 0.08);
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      object-fit: cover;
      border-radius: 50%;
    }

    /* Dark Mode Toggle Button */
    .theme-toggle-btn {
      border: none;
      background: transparent;
      color: var(--bs-body-color);
      font-size: 1.2rem;
      padding: 0.4rem 0.6rem;
      border-radius: 0.5rem;
      transition: background 0.2s ease;
    }

    .theme-toggle-btn:hover {
      background-color: var(--bs-tertiary-bg);
    }
  </style>
</head>

<body>

  <!-- ========================================== -->
  <!-- TOP NAVIGATION BAR (NO SIDEBAR) -->
  <!-- ========================================== -->
  <nav class="navbar navbar-expand-lg bg-body sticky-top border-bottom shadow-sm py-2">
    <div class="container">

      <!-- Brand Logo -->
      <a href="{{ base_url() }}" class="navbar-brand-logo me-4">
        <i class="bi bi-app-indicator me-2 text-primary"></i>User<span>Portal</span>
      </a>

      <!-- Mobile Hamburger Toggle Button -->
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarMainContent" aria-controls="navbarMainContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links & Actions -->
      <div class="collapse navbar-collapse" id="navbarMainContent">

        <!-- Center/Left: Main Navigation Menu -->
        <ul class="navbar-menu nav me-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="{{ base_url('dashboard') }}">
              <i class="bi bi-house-door me-1"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ base_url('orders') }}">
              <i class="bi bi-receipt me-1"></i> My Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ base_url('support') }}">
              <i class="bi bi-headset me-1"></i> Help Center
            </a>
          </li>
        </ul>

        <!-- Right: Theme Toggle & User Profile Dropdown -->
        <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">

          <!-- Dark Mode Toggle Button -->
          <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light/Dark Theme">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
          </button>

          <!-- Divider -->
          <div class="vr mx-1 my-2 text-secondary opacity-25 d-none d-lg-block"></div>

          <!-- User Profile Dropdown -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-reset"
              id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=0D6EFD&color=fff"
                alt="User Avatar" class="user-avatar me-2">
              <div class="text-start me-1">
                <div class="fw-semibold lh-1 fs-6">{{ $user->name ?? 'User Account' }}</div>
                <small class="text-muted" style="font-size: 0.75rem;">{{ $user->email ?? 'user@example.com' }}</small>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2" aria-labelledby="userDropdown">
              <li>
                <h6 class="dropdown-header">Account Options</h6>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center py-2" href="{{ base_url('profile') }}">
                  <i class="bi bi-person me-2 text-muted"></i> Edit Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center py-2" href="{{ base_url('settings') }}">
                  <i class="bi bi-shield-lock me-2 text-muted"></i> Security Settings
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="{{ base_url('auth/logout') }}">
                  <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                </a>
              </li>
            </ul>
          </div>

        </div>

      </div>
    </div>
  </nav>

  <!-- ========================================== -->
  <!-- MAIN CONTAINER (PAGE CONTENT) -->
  <!-- ========================================== -->
  <main class="container py-4 flex-grow-1">

    <!-- Page Header & Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
      <div>
        <h4 class="fw-bold mb-1">{{ $page_title ?? 'User Dashboard' }}</h4>
        <p class="text-muted mb-0">Selamat datang kembali, <strong>{{ $user->name ?? 'User' }}</strong>!</p>
      </div>

      <!-- Optional Action Button Header -->
      <div>
        <a href="{{ base_url('services') }}" class="btn btn-primary rounded-3 px-3 shadow-sm">
          <i class="bi bi-plus-lg me-1"></i> Explore Services
        </a>
      </div>
    </div>

    <!-- Blank Card Container -->
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body p-4 p-md-5">
        <h5 class="card-title fw-bold mb-3">Wadah Konten Pengguna</h5>
        <p class="card-text text-muted">
          Halaman ini dirancang murni dengan navigasi atas (tanpa sidebar) untuk memberikan ruang pandang yang lebih
          luas (*full-width focus*). Sangat cocok untuk *dashboard user*, form pendaftaran, riwayat transaksi, atau
          halaman katalog produk.
        </p>
      </div>
    </div>

  </main>

  <!-- ========================================== -->
  <!-- FOOTER -->
  <!-- ========================================== -->
  <footer class="footer py-3 bg-body border-top text-center text-muted">
    <div class="container">
      <small>&copy; {{ date('Y') }} <strong>UserPortal</strong>. All rights reserved.</small>
    </div>
  </footer>

  <!-- Bootstrap 5.3 Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {

      // 1. Dark Mode Toggle dengan Persistent storage (localStorage)
      const themeToggleBtn = document.getElementById("themeToggleBtn");
      const themeIcon = document.getElementById("themeIcon");

      const savedTheme = localStorage.getItem("theme") || "light";
      setTheme(savedTheme);

      themeToggleBtn.addEventListener("click", function () {
        const currentTheme = document.documentElement.getAttribute("data-bs-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        setTheme(newTheme);
      });

      function setTheme(theme) {
        document.documentElement.setAttribute("data-bs-theme", theme);
        localStorage.setItem("theme", theme);

        if (theme === "dark") {
          themeIcon.classList.replace("bi-moon-stars-fill", "bi-sun-fill");
          themeIcon.classList.add("text-warning");
        } else {
          themeIcon.classList.replace("bi-sun-fill", "bi-moon-stars-fill");
          themeIcon.classList.remove("text-warning");
        }
      }

      // 2. SweetAlert2 Flashdata Notification Handler
      window.addEventListener("load", function () {
        setTimeout(function () {
          @if (function_exists('session') ? session('swal_error') : $this->session->flashdata('swal_error'))
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: '{{ function_exists("session") ? session("swal_error") : $this->session->flashdata("swal_error") }}',
              confirmButtonColor: '#0d6efd',
              heightAuto: false,
              customClass: { popup: 'rounded-4' }
            });
          @endif

          @if (function_exists('session') ? session('swal_success') : $this->session->flashdata('swal_success'))
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: '{{ function_exists("session") ? session("swal_success") : $this->session->flashdata("swal_success") }}',
              timer: 3000,
              showConfirmButton: false,
              heightAuto: false,
              customClass: { popup: 'rounded-4' }
            });
          @endif
                }, 200);
      });

    });
  </script>
</body>

</html>