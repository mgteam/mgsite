<?php
/**
 * This file is loaded automatically
 *
 * This file should load/create any Hub Plugin wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * @package       hub.Config
 */


CakePlugin::load('Search', array('bootstrap' => false, 'routes' => false));
CakePlugin::load('CsvView');

/**
 * Load Site wise Configuration File
 */
Configure::load('Madmin.madmin_configuration.php');

/**
 * Load Site wise Constants file
 */
require_once('madmin_constants.php');