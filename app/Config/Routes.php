<?php

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->set404Override(function () {
//   redirect()->to('/')->send();
//   exit; // force end of execution
// });

// OPEN ROUTES
$routes->get('/unauthorized', 'Home::unauthorized');
$routes->get('results', 'Home::results');
$routes->get('ballots', 'Ballots::ballots');
$routes->get('candidate', 'Candidates::candidates');
$routes->get('has_election', 'Ballots::has_election_schedule');
$routes->get('retrieve_ballots', 'Ballots::retrieve_ballots');
$routes->get('count_votes', 'Ballots::count_votes');
$routes->get('register', 'Auth::register');

// ADMIN ROUTES
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
  $routes->get('/', 'Campaigns::index');
  $routes->get('results/(:num)', 'Home::results/$1');

  $routes->post('create-account', 'Auth::create_account');

  $routes->group('profile', function ($routes) {
    $routes->get('', 'Admin::profile');
    $routes->post('update_profile_image', 'Admin::update_profile_image');
    $routes->post('update_profile', 'Admin::update_profile');

    $routes->group('organization', function ($routes) {
      $routes->get('', 'Organizations::organizations');
      $routes->post('create', 'Organizations::create_organization');
      $routes->post('deactivate/(:num)', 'Organizations::deactivate_organization/$1');
      $routes->post('activate/(:num)', 'Organizations::activate_organization/$1');
      $routes->get('retrieve_organizations', 'Organizations::retrieve_organizations');
      $routes->get('retrieve_positions', 'Organizations::retrieve_positions');
      $routes->get('search/(:segment)', 'Organizations::find_organization/$1');
    });

    $routes->group('position', function ($routes) {
      $routes->get('', 'Organizations::positions');
      $routes->post('create_position/(:segment)', 'Organizations::create_position/$1');
      $routes->post('deactivate/(:segment)/(:segment)', 'Organizations::deactivate_position/$1/$2');
      $routes->post('activate/(:segment)/(:segment)', 'Organizations::activate_position/$1/$2');
    });

    $routes->group('users', function ($routes) {
      $routes->get('', 'Users::users');
      $routes->post('create', 'Users::create_user');
      $routes->post('create_admin', 'Users::create_admin');
      $routes->get('retrieve', 'Users::retrieve_users');
      $routes->post('update/(:num)', 'Users::update_users/$1');
      $routes->post('deactivate/(:num)', 'Users::deactivate_user/$1');
      $routes->post('activate/(:num)', 'Users::activate_user/$1');
      $routes->post('add_officer', 'Users::add_officer');
      $routes->post('add_admin', 'Users::add_admin');
    });

    $routes->group('election', function ($routes) {
      $routes->get('', 'Election::profile_election');
      $routes->post('create', 'Election::create_election');
      $routes->get('retrieve', 'Election::retrieve_election');
      $routes->post('update/(:num)', 'Election::update_election/$1');
    });

  });
});
$routes->get('retrieve_positions/(:segment)', 'Organizations::retrieve_positions/$1', ['filter' => 'role:admin,officer']);

// OFFICER ROUTES
$routes->group('officer', ['filter' => 'role:officer'], function ($routes) {
  $routes->get('/', 'Campaigns::index');

  $routes->get('profile', 'Officer::profile');

  $routes->group('ballots', function ($routes) {
    $routes->post('create', 'Ballots::create_ballot');
  });
});

// STUDENT ROUTES
$routes->group('student', ['filter' => 'role:student'], function ($routes) {
  $routes->get('/', 'Campaigns::index');

  $routes->get('profile', 'Student::profile');
  $routes->post('submit_votes', 'Student::submit_votes');
});

// ADMIN AND OFFICER ROUTES
$routes->group('campaigns', ['filter' => 'role:admin,officer'], function ($routes) {
  $routes->get('campaign_lists', 'Campaigns::campaign_lists');
  $routes->post('create', 'Campaigns::create_campaign');
  $routes->get('retrieve', 'Campaigns::retrieve_campaigns');
  $routes->post('update/(:num)', 'Campaigns::update_campaign/$1');
  $routes->post('delete/(:num)', 'Campaigns::delete_campaign/$1');
  $routes->get('retrieve_partylist', 'Campaigns::retrieve_partylist');
});

// CANDIDATE ROUTES
$routes->group('candidate', ['filter' => 'role:admin,officer'], function ($routes) {
  $routes->get('retrieve', 'Candidates::retrieve_candidates');
  $routes->get('candidate_lists', 'Candidates::candidate_lists');
  $routes->post('candidate_create/(:num)', 'Candidates::create_candidate/$1');
  $routes->post('disqualify_candidate/(:num)', 'Candidates::disqualify_candidate/$1');
});

// STUDENT ROUTES
$routes->group('students', ['filter' => 'role:admin,officer'], function ($routes) {
  $routes->get('student_lists', 'Students::students');
  $routes->get('retrieve', 'Students::retrieve_students');
  $routes->get('search/(:any)', 'Students::search_student/$1');
});

// STUDENT ADMIN MANAGEMENT ROUTES
$routes->group('students', ['filter' => 'role:admin'], function ($routes) {
  $routes->post('create', 'Students::create_student');
  $routes->post('update/(:num)', 'Students::update_student/$1');
  $routes->post('deactivate_all', 'Students::deactivate_all_students');
  $routes->post('deactivate/(:num)', 'Students::deactivate_student/$1');
  $routes->post('activate/(:num)', 'Students::activate_student/$1');
});

// IF USER IS STILL LOGGED IN, REDIRECT BACK TO HOME PAGE
$routes->group('login', ['filter' => 'isloggedin'], function ($routes) {
  $routes->get('', 'Auth::login');
  $routes->post('signin', 'Auth::signin');
});

$routes->get('/', 'Home::home');
$routes->post('logout', 'Auth::logout');
