<?php
$session = session();

if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
    return redirect()->to('login')->send();
    exit;
}
?>

<nav class="navbar">
    <div class="container">
        <a class="brand" href="<?= base_url('student/home') ?>">
            🎓 Student Portal
        </a>

        <!-- Mobile Hamburger -->
        <button class="toggle" onclick="document.getElementById('navbarContent').classList.toggle('show')">
            ☰
        </button>

        <div class="nav-links" id="navbarContent">
            <ul class="left">
                <li><a class="<?= (uri_string() == 'student/home') ? 'active' : '' ?>" href="<?= base_url('student/home') ?>">Home</a></li>
                <li><a class="<?= (uri_string() == 'student/course') ? 'active' : '' ?>" href="<?= base_url('student/course') ?>">Course</a></li>
                <li><a class="<?= (uri_string() == 'student/profile') ? 'active' : '' ?>" href="<?= base_url('student/profile') ?>">Profile</a></li>
                <li><a class="<?= (uri_string() == 'student/enroll') ? 'active' : '' ?>" href="<?= base_url('student/enroll') ?>">Enroll</a></li>
            </ul>
            <ul class="right">
                <li><a class="logout" href="<?= base_url('logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Reset */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: "Segoe UI", Roboto, sans-serif; background: #f5f7fa; }

    /* Navbar Base */
    .navbar {
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(12px);
        background: rgba(30, 60, 114, 0.85); /* glass effect */
        color: #fff;
        padding: 14px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .container {
        max-width: 1100px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Brand */
    .brand {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        letter-spacing: 1px;
    }

    /* Nav links */
    .nav-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-grow: 1;
    }

    .nav-links ul {
        list-style: none;
        display: flex;
        align-items: center;
    }

    .nav-links ul.left {
        gap: 24px;
    }

    .nav-links ul.right {
        margin-left: auto;
    }

    .nav-links a {
        color: #e0e0e0;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .nav-links a:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    /* Active link */
    .nav-links a.active {
        color: #ffd700;
        font-weight: 600;
        border-bottom: 2px solid #ffd700;
    }

    /* Logout button */
    .logout {
        border: 2px solid #ffd700;
        padding: 6px 20px;
        border-radius: 30px;
        transition: all 0.3s ease;
        color: #ffd700 !important;
        font-weight: bold;
    }

    .logout:hover {
        background: #ffd700;
        color: #1e3c72 !important;
    }

    /* Mobile Menu */
    .toggle {
        background: none;
        border: none;
        font-size: 26px;
        color: #fff;
        cursor: pointer;
        display: none;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            margin-top: 15px;
        }

        .nav-links.show {
            display: flex;
        }

        .nav-links ul {
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .nav-links ul.right {
            margin-left: 0;
        }

        .toggle {
            display: block;
        }
    }
</style>
