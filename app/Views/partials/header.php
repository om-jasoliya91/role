<?php
$session = session();

if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
    header('Location: ' . base_url('login'));
    exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="<?= base_url('student/home') ?>">
            Student Portal
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 <?= (uri_string() == 'student/home') ? 'active' : '' ?>" href="<?= base_url('student/home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= (uri_string() == 'student/course') ? 'active' : '' ?>" href="<?= base_url('student/course') ?>">Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= (uri_string() == 'student/profile') ? 'active' : '' ?>" href="<?= base_url('student/profile') ?>">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= (uri_string() == 'student/enroll') ? 'active' : '' ?>" href="<?= base_url('student/enroll') ?>">Enroll</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm rounded-pill px-4" href="<?= base_url('logout') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Custom Bootstrap overrides */
    .bg-gradient-primary {
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
    }

    .navbar-nav .nav-link.active {
        color: #ffd700 !important;
        font-weight: 600;
        border-bottom: 2px solid #ffd700;
    }

    .btn-outline-light:hover {
        background-color: #ffd700;
        color: #212529;
        border-color: #ffd700;
        transition: all 0.3s ease;
    }
</style>
