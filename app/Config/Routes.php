<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ----------------------------------------------------
// Default route
// ----------------------------------------------------
$routes->get('/', 'Login::index');  // Show login page as default

// ----------------------------------------------------
// Registration Routes
// ----------------------------------------------------
$routes->get('register', 'Register::register');
$routes->post('registerPost', 'Register::registerPost');
$routes->get('view', 'Register::view');

// Admin Add Student
$routes->get('admin/stdAdd', 'Register::stdAdd', ['filter' => 'admin']);
$routes->post('admin/stdAddPost', 'Register::stdAddPost', ['filter' => 'admin']);

// Login / Logout
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
$routes->get('home', 'Login::homeView');

$routes->group('student', function ($routes) {
    $routes->get('home', 'Student::view');
    $routes->get('updateView', 'Student::updateView');
    $routes->post('studentupdate', 'Student::updateProfile');
    $routes->get('profile', 'Student::profile');
    $routes->get('course', 'Student::course');
    $routes->get('course/(:num)', 'Student::enroll/$1');
    $routes->get('enroll', 'Student::enrollView');
    $routes->get('export', 'Student::export');
});

// ----------------------------------------------------
// Admin Routes
// ----------------------------------------------------
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboardView');

    // Student Management
    $routes->get('stdView', 'Admin::stdView');
    $routes->get('edit/(:num)', 'Admin::edit/$1');
    $routes->post('edit/(:num)', 'Admin::update/$1');
    $routes->get('delete/(:num)', 'Admin::delete/$1');

    // Course Management
    $routes->get('courseAdd', 'Admin::courseView');
    $routes->post('courseAdd', 'Admin::courseStore');
    $routes->get('courseView', 'Admin::courseList');
    $routes->get('courseEdit/(:num)', 'Admin::courseEdit/$1');
    $routes->post('courseEdit/(:num)', 'Admin::courseUpdate/$1');

    // Enrollment
    $routes->get('enrollView', 'Admin::adminEnrollView');
});

$routes->get('forgotPassword', 'Login::forgotPasswordForm');
$routes->post('forgotPassword', 'Login::sendResetLink');

$routes->get('reset-password/(:num)', 'Login::resetPassword/$1');
$routes->post('reset-password/(:num)', 'Login::updatePassword/$1');

$routes->get('lang', 'Home::index2');
$routes->get('lang/(:segment)', 'Home::switch/$1');

$routes->get('set-cookie', 'CookieController::setCookie');
$routes->get('get-cookie', 'CookieController::getCookie');
$routes->get('delete-cookie', 'CookieController::deleteCookie');

$routes->get('encrypt-demo', 'EncryptDemo::encrypt');
$routes->get('decrypt-demo/(:any)', 'EncryptDemo::decrypt/$1');

$routes->get('error/notfound', 'Error::notfound');
$routes->get('error/general', 'Error::general');

$routes->get('student_detail/(:num)','Admin::showStudent/$1');
