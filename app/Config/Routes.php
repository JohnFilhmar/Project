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
  $routes->group('profile', function($routes) {
    $routes->get('/', 'Admin::profile');
    $routes->get('election', 'Admin::profile_election');
    $routes->get('organization', 'Admin::profile_organization');
    $routes->get('position', 'Admin::profile_position');
    $routes->get('officers', 'Admin::profile_officers');
  });
  $routes->post('campaigns/add', 'Admin::addCampaign');
});
$routes->group('/', function($routes) {
  $routes->get('/', 'Home::index');
  $routes->get('login', 'Home::login');
});