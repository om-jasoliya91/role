<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Default route
$routes->get('/', 'Home::index');

// Registration Routes
$routes->get('register', 'Register::register');  // Public registration form
$routes->post('registerPost', 'Register::registerPost');  // Public registration submit
$routes->get('view', 'Register::view');  // Optional: user view

// Login Routes
$routes->get('login', 'Login::index');  // Login form
$routes->post('login', 'Login::authenticate');  // Login submit
$routes->get('logout', 'Login::logout');  // Logout

// Student Routes (manually prefixed with 'student/')
$routes->get('student/home', 'Student::view');
$routes->get('student/updateView', 'Student::updateView');
$routes->post('student/studentupdate', 'Student::updateProfile');
$routes->get('student/profile', 'Student::profile');
$routes->get('student/course', 'Student::course');
$routes->get('student/course/(:num)', 'Student::enroll/$1');
$routes->get('student/enroll', 'Student::enrollView');
$routes->get('student/export', 'Student::export');

// Admin Routes (manually prefixed with 'admin/')
$routes->get('admin/dashboard', 'Admin::dashboardView');

// Admin Student Management
$routes->get('admin/stdView', 'Admin::stdView');
$routes->get('admin/edit/(:num)', 'Admin::edit/$1');
$routes->post('admin/edit/(:num)', 'Admin::update/$1');
$routes->get('admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'admin']);

// Admin Course Management
$routes->get('admin/courseAdd', 'Admin::courseView');
$routes->post('admin/courseAdd', 'Admin::courseStore');
$routes->get('admin/courseView', 'Admin::courseList');
$routes->get('admin/courseEdit/(:num)', 'Admin::courseEdit/$1');
$routes->post('admin/courseEdit/(:num)', 'Admin::courseUpdate/$1');

// Admin Enrollment View
$routes->get('admin/enrollView', 'Admin::adminEnrollView');

// Admin Add Student (with admin filter)
$routes->get('admin/stdAdd', 'Register::stdAdd', ['filter' => 'admin']);
$routes->post('admin/stdAddPost', 'Register::stdAddPost', ['filter' => 'admin']);
// Language localization
$routes->get('lang', 'Home::index2');
$routes->get('lang/(:segment)', 'Home::switch/$1');

// Cookie routes
$routes->get('set-cookie', 'CookieController::setCookie');
$routes->get('get-cookie', 'CookieController::getCookie');
$routes->get('delete-cookie', 'CookieController::deleteCookie');

// Encryption demo routes
$routes->get('encrypt-demo', 'EncryptDemo::encrypt');
$routes->get('decrypt-demo/(:any)', 'EncryptDemo::decrypt/$1');

// Forgot password
$routes->get('forgotPassword', 'Login::forgotPasswordForm');   // Show form
$routes->post('forgotPassword', 'Login::sendResetLink');       // Handle form submit

