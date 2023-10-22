<?php

/**
 * Plugin Name: Pre Build Snippets
 * Plugin URI: https://github.com/usamakhan143/pre-build-snippets
 * Description: This plugin can help you enable extra features on one click for which you are using different snippets to achieve specific functionality.
 * Author: Usama Khan
 * Author URI: https://github.com/usamakhan143
 * Text Domain: pre-build-snippets
 * Requires PHP: 7.4
 * Version: 1.0.0
 */


// First Option to secure the plugin
 if(!defined('ABSPATH')) {
    die;
    exit;
 }


// check the class before initializing if it is not exist then initialize it or else don't initialize the class
if (!class_exists('PreBuildSnippets')) {
class PreBuildSnippets {

    // methods
    function __construct()
    {
        define('PRE_BUILD_SNIPPETS_URL', plugin_dir_url(__FILE__));
        define('PRE_BUILD_SNIPPETS_PATH', plugin_dir_path(__FILE__));
        require_once(PRE_BUILD_SNIPPETS_PATH . '/vendor/autoload.php');
    }

    function initialize() {
        include_once(PRE_BUILD_SNIPPETS_PATH . '/includes/utilities.php');
        include_once(PRE_BUILD_SNIPPETS_PATH . '/includes/options-page.php');
        include_once(PRE_BUILD_SNIPPETS_PATH . '/includes/pre-build-snippets.php');
    }
}
}
$preBuildSnippets = new PreBuildSnippets();
$preBuildSnippets->initialize();