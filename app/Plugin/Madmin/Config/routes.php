<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * @package       hub.Config
 */

Router::connect('/hub', array('plugin' => 'hub', 'controller' => 'users', 'action' => 'login'));

