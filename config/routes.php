<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
Router::extensions(['json','xml','pdf']);
$routes->connect('/', ['controller' => 'Admins', 'action' => 'home']);


Router::scope('/admins', function (RouteBuilder $routes) {
    $routes->connect('/home', ['controller' => 'Admins', 'action' => 'home']);
    $routes->connect('/dashboard', ['controller' => 'Admins', 'action' => 'dashboard']);
    $routes->connect('/login', ['controller' => 'Admins', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Admins', 'action' => 'logout']);
    $routes->connect('/tour', ['controller' => 'Admins', 'action' => 'tour']);
    $routes->connect('/register', ['controller' => 'Admins', 'action' => 'register']);

    $routes->connect('/accounts', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/accounts/view', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/accounts/create', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/accounts/edit/:user_id', ['controller' => 'Admins', 'action' => 'index']);
    // profiles spa
    $routes->connect('/profiles/edit', ['controller' => 'Admins', 'action' => 'index']);

    // planning spa
    $routes->connect('/plannings', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/plannings/view', ['controller' => 'Admins', 'action' => 'index']);

    // Suivi corrections
    $routes->connect('/trainings/create', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/trainings/all', ['controller' => 'Admins', 'action' => 'index']);

    $routes->connect('/project-corrections/view/:project_id', ['controller' => 'ProjectCorrections', 'action' => 'view']);

});
//all

Router::scope('/training-asset-types', function (RouteBuilder $routes) {
    $routes->connect('/all', ['controller' => 'TrainingAssetTypes', 'action' => 'all']);
});

Router::scope('/accounts', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Accounts', 'action' => 'index']);
    $routes->connect('/view', ['controller' => 'Accounts', 'action' => 'view']);
    $routes->connect('/create', ['controller' => 'Accounts', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Accounts', 'action' => 'edit']);
    $routes->connect('/get', ['controller' => 'Accounts', 'action' => 'get']);
    $routes->connect('/unlock', ['controller' => 'Accounts', 'action' => 'unlock']);
    $routes->connect('/renew', ['controller' => 'Accounts', 'action' => 'renew']);
});

Router::scope('/roles', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Roles', 'action' => 'index']);
    $routes->connect('/all', ['controller' => 'Roles', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Roles', 'action' => 'create']);
});

Router::scope('/training-assets', function (RouteBuilder $routes) {
    $routes->connect('/add', ['controller' => 'TrainingAssets', 'action' => 'add']);
});


Router::scope('/trainings', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Trainings', 'action' => 'index']);
    $routes->connect('/all', ['controller' => 'Trainings', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Trainings', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Trainings', 'action' => 'edit']);
});


Router::scope('/users', function (RouteBuilder $routes) {
    $routes->connect('/all', ['controller' => 'Users', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Users', 'action' => 'create']);
});

Router::scope('/profiles', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Profiles', 'action' => 'index']);
    $routes->connect('/edit', ['controller' => 'Profiles', 'action' => 'edit']);
    $routes->connect('/get', ['controller' => 'Profiles', 'action' => 'get']);
    $routes->connect('/all', ['controller' => 'Profiles', 'action' => 'all']);
});

});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
