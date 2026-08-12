<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title ?? 'Admin Dashboard' }}</title>

	<!-- Google Fonts: Inter -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Bootstrap 5.3 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	<style>
		:root {
			--sidebar-width: 260px;
		}

		body {
			font-family: 'Inter', sans-serif;
			background-color: var(--bs-body-tertiary-bg);
			transition: background-color 0.3s ease, color 0.3s ease;
		}

		#wrapper {
			display: flex;
			min-height: 100vh;
			overflow-x: hidden;
		}

		/* Sidebar Styling */
		#sidebar-wrapper {
			min-width: var(--sidebar-width);
			max-width: var(--sidebar-width);
			background-color: var(--bs-body-bg);
			border-right: 1px solid var(--bs-border-color);
			transition: margin 0.25s ease-out;
			z-index: 1000;
		}

		#wrapper.toggled #sidebar-wrapper {
			margin-left: calc(-1 * var(--sidebar-width));
		}

		.sidebar-brand {
			padding: 1.25rem 1.5rem;
			font-size: 1.25rem;
			font-weight: 700;
			color: var(--bs-body-color);
			text-decoration: none;
			display: flex;
			align-items: center;
		}

		.sidebar-brand span {
			color: #0d6efd;
		}

		.sidebar-heading {
			padding: 0.75rem 1.5rem 0.25rem;
			font-size: 0.75rem;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			color: var(--bs-secondary-color);
		}

		.sidebar-link {
			display: flex;
			align-items: center;
			padding: 0.65rem 1.25rem;
			color: var(--bs-body-color);
			text-decoration: none;
			border-radius: 0.5rem;
			margin: 0.2rem 0.8rem;
			font-size: 0.925rem;
			font-weight: 500;
			transition: all 0.2s ease;
		}

		.sidebar-link:hover,
		.sidebar-link.active {
			background-color: rgba(13, 110, 253, 0.1);
			color: #0d6efd;
		}

		.sidebar-link i {
			font-size: 1.15rem;
			margin-right: 0.75rem;
		}

		/* Content Wrapper */
		#page-content-wrapper {
			width: 100%;
			min-width: 0;
			display: flex;
			flex-direction: column;
		}

		/* Top Navbar */
		.top-navbar {
			background-color: var(--bs-body-bg);
			border-bottom: 1px solid var(--bs-border-color);
			padding: 0.75rem 1.5rem;
		}

		.user-avatar {
			width: 38px;
			height: 38px;
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

		@media (max-width: 768px) {
			#sidebar-wrapper {
				margin-left: calc(-1 * var(--sidebar-width));
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: 0;
			}
		}
	</style>
</head>

<body>

	<div id="wrapper">

		<!-- ========================================== -->
		<!-- 1. SIDEBAR -->
		<!-- ========================================== -->
		<aside id="sidebar-wrapper">
			<a href="{{ base_url('dashboard') }}" class="sidebar-brand">
				<i class="bi bi-box-seam-fill me-2 text-primary"></i>Admin<span>Panel</span>
			</a>

			<div class="list-group list-group-flush my-2">
				<div class="sidebar-heading">Main Menu</div>

				<a href="{{ base_url('dashboard') }}" class="sidebar-link active">
					<i class="bi bi-grid-1x2-fill"></i>Dashboard
				</a>

				<a href="{{ base_url('product') }}" class="sidebar-link">
					<i class="bi bi-bag-check-fill"></i>Products
				</a>

				<a href="#" class="sidebar-link">
					<i class="bi bi-people-fill"></i>Users
				</a>

				<div class="sidebar-heading mt-3">System</div>

				<a href="#" class="sidebar-link">
					<i class="bi bi-gear-fill"></i>Settings
				</a>

				<a href="{{ base_url('logout') }}" class="sidebar-link text-danger mt-4">
					<i class="bi bi-box-arrow-right"></i>Logout
				</a>
			</div>
		</aside>

		<!-- ========================================== -->
		<!-- 2. MAIN CONTENT WRAPPER -->
		<!-- ========================================== -->
		<div id="page-content-wrapper">

			<!-- Top Header Navbar -->
			<nav class="top-navbar d-flex justify-content-between align-items-center sticky-top shadow-sm">

				<!-- Left: Sidebar Toggle -->
				<div class="d-flex align-items-center">
					<button class="btn btn-light border-0 me-3" id="sidebarToggle">
						<i class="bi bi-list fs-5"></i>
					</button>
					<!-- Breadcrumb Sederhana -->
					<nav aria-label="breadcrumb" class="d-none d-sm-block">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-decoration-none">Admin</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								{{ $page_title ?? 'Blank Container' }}</li>
						</ol>
					</nav>
				</div>

				<!-- Right: Action Buttons (Dark Mode & User Menu) -->
				<div class="d-flex align-items-center gap-2">

					<!-- Dark Mode Toggle -->
					<button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light/Dark Theme">
						<i class="bi bi-moon-stars-fill" id="themeIcon"></i>
					</button>

					<!-- Divider -->
					<div class="vr mx-1 my-2 text-secondary opacity-25"></div>

					<!-- User Profile Dropdown -->
					<div class="dropdown">
						<a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-reset"
							id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Admin') }}&background=0D6EFD&color=fff"
								alt="User Avatar" class="user-avatar me-2">
							<div class="d-none d-md-block text-start me-1">
								<div class="fw-semibold lh-1">{{ $user->name ?? 'Administrator' }}</div>
								<small class="text-muted"
									style="font-size: 0.75rem;">{{ $user->email }}</small>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2"
							aria-labelledby="userDropdown">
							<li>
								<h6 class="dropdown-header">User Account</h6>
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center py-2" href="#">
									<i class="bi bi-person me-2 text-muted"></i> My Profile
								</a>
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center py-2" href="#">
									<i class="bi bi-gear me-2 text-muted"></i> Account Settings
								</a>
							</li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center py-2 text-danger"
									href="{{ base_url('auth/logout') }}">
									<i class="bi bi-box-arrow-right me-2"></i> Sign Out
								</a>
							</li>
						</ul>
					</div>

				</div>
			</nav>

			<!-- Main Page Content -->
			<main class="container-fluid p-4">

				<!-- Page Header Title -->
				<div class="d-flex justify-content-between align-items-center mb-4">
					<div>
						<h4 class="fw-bold mb-1">{{ $page_title ?? 'Blank Container' }}</h4>
						<p class="text-muted mb-0">Halaman wadah kosong untuk menaruh konten admin Anda.</p>
					</div>
					<div>
						<button class="btn btn-primary rounded-3 px-3 shadow-sm">
							<i class="bi bi-plus-lg me-1"></i> Add New Data
						</button>
					</div>
				</div>

				<!-- Blank Card Container -->
				<div class="card border-0 shadow-sm rounded-4">
					<div class="card-body p-4">
						<h5 class="card-title fw-bold mb-3">Card Title</h5>
						<p class="card-text text-muted">
							Di sini Anda bisa meletakkan konten tabel, form, statistik, atau grafik. Seluruh kontainer
							ini sudah mendukung **Dark Mode** secara otomatis mengikuti tema Bootstrap 5.3.
						</p>
					</div>
				</div>

			</main>

			<!-- Footer -->
			<footer class="footer mt-auto py-3 bg-body border-top text-center text-muted fs-7">
				<div class="container-fluid">
					<small>&copy; {{ date('Y') }} <strong>AdminPanel</strong>. All rights reserved.</small>
				</div>
			</footer>

		</div>

	</div>

	<!-- Bootstrap 5.3 Bundle JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function () {

			// 1. Sidebar Toggle Functionality
			const sidebarToggle = document.getElementById("sidebarToggle");
			const wrapper = document.getElementById("wrapper");

			if (sidebarToggle) {
				sidebarToggle.addEventListener("click", function (e) {
					e.preventDefault();
					wrapper.classList.toggle("toggled");
				});
			}

			// 2. Dark Mode Toggle with localStorage
			const themeToggleBtn = document.getElementById("themeToggleBtn");
			const themeIcon = document.getElementById("themeIcon");

			// Cek preferensi tema yang tersimpan
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

			// 3. SweetAlert2 Flashdata Toast Notification
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