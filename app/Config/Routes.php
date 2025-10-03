<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Default route
$routes->get('/', 'Home::index');

// Registration Routes
$routes->get('register', 'Register::index');
$routes->post('registerPost', 'Register::registerPost');
$routes->get('view', 'Register::view');

// Login Routes
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
$routes->get('home', 'Login::homeView');

// Student Routes
$routes->get('student/home', 'Student::view');
$routes->get('student/updateView', 'Student::updateView');
$routes->post('student/studentupdate', 'Student::updateProfile');
$routes->get('student/profile', 'Student::profile');
$routes->get('student/course', 'Student::course');
$routes->get('student/course/(:num)', 'Student::enroll/$1');
$routes->get('student/enroll', 'Student::enrollView');
$routes->get('student/export', 'Student::export');

// Admin Routes
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

// Admin Add Student
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

// Forgot password flow
$routes->get('forgotPassword', 'Login::forgotPasswordForm');
$routes->post('forgotPassword', 'Login::sendResetLink');
$routes->get('resetPassword/(:num)/(:any)', 'Login::resetPassword/$1/$2');
$routes->post('resetPassword/(:num)/(:any)', 'Login::updatePassword/$1/$2');
