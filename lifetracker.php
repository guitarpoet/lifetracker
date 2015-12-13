<?php
/**
 * @package LifeTracker
 * @version 1.0
 */

/*
Plugin Name: LifeTracker Plugin For WordPress
Plugin URI: http://wordpress.org/plugins/lifetracker/
Description: This is the lifetracker plugin for wordpress.
Author: Jack
Version: 1.0
Author URI: http://lifetracker.thinkingcloud.info
*/


use Life\Tracker\Plugin;

require_once(__DIR__.'/vendor/autoload.php');

$plugin = Plugin::instance();
