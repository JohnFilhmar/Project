<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', function($routes) {
  $routes->get('/', 'Admin::index');
  $routes->get('results', 'Admin::results');
  $routes->get('candidates', 'Admin::candidates');
  $routes->get('student-lists', 'Admin::studentLists');
  $routes->post('campaigns/add', 'Admin::addCampaign');
});
$routes->group('/', function($routes) {
  $routes->get('/', 'Home::index');
  $routes->get('login', 'Home::login');
});