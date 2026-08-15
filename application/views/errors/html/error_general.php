<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo strip_tags($heading); ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: var(--bs-body-tertiary-bg);
		}

		.error-card {
			max-width: 560px;
			width: 100%;
		}

		.error-icon-wrapper {
			width: 70px;
			height: 70px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 50%;
			background-color: rgba(220, 53, 69, 0.1);
			color: #dc3545;
			font-size: 2rem;
		}

		.error-message-body p {
			margin-bottom: 0.75rem;
			color: var(--bs-secondary-color);
		}

		.error-message-body p:last-child {
			margin-bottom: 0;
		}
	</style>
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center p-3">

	<div class="error-card text-center">
		<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
			<div class="card-body p-4 p-md-5">
				<div class="error-icon-wrapper mb-4">
					<i class="bi bi-exclamation-triangle-fill"></i>
				</div>
				<h3 class="fw-bold mb-3"><?php echo $heading; ?></h3>
				<div class="error-message-body mb-4">
					<?php echo $message; ?>
				</div>
				<div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-4">
					<button onclick="window.history.back()"
						class="btn btn-outline-secondary rounded-3 px-4 py-2 font-medium">
						<i class="bi bi-arrow-left me-1"></i> Kembali
					</button>
					<a href="<?php echo config_item('base_url'); ?>"
						class="btn btn-primary rounded-3 px-4 py-2 font-medium shadow-sm">
						<i class="bi bi-house-door me-1"></i> Ke Beranda
					</a>
				</div>

			</div>
		</div>
		<small class="text-muted d-block mt-3">
			&copy; <?php echo date('Y'); ?> System Error Notification
		</small>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>