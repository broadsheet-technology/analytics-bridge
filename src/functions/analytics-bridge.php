<?php

// Prevent direct file access
if (!defined('ABSPATH')) {
  exit();
}

// Toggle this to generate fake data.
define('FAKE_API', false);

/** Table defines */
global $wpdb;
define('METRICS_TABLE', $wpdb->prefix . 'bt_analyticsbridge_metrics');
define('PAGES_TABLE', $wpdb->prefix . 'bt_analyticsbridge_pages');

/** Include Google PHP client library. */
require_once '/srv/vendor/autoload.php';

require_once plugin_dir_path(__FILE__) . 'analytics-bridge/classes/AnalyticsBridgeGoogleClient.php';
require_once plugin_dir_path(__FILE__) . 'analytics-bridge/classes/AnalyticsBridgeService.php';
require_once plugin_dir_path(__FILE__) . 'analytics-bridge/classes/AnalyticsBridgePopularPosts.php';
require_once plugin_dir_path(__FILE__) .
  'analytics-bridge/classes/AnalyticsBridgeGoogleAnalytics.php';

/**
 * Registers admin option page and populates with
 * plugin settings
 */
require_once 'analytics-bridge/inc/options.php';

/**
 * Registers admin option page and populates with
 * plugin settings
 */
require_once 'analytics-bridge/inc/blog-options.php';

/**
 * Functions for activating/deactivating the plugin
 */
require_once 'analytics-bridge/inc/installation.php';

/**
 * Cron job and interface functions to retrieve analytics data
 * from Google Analytics
 */
require_once 'analytics-bridge/inc/ga-interface.php';
require_once 'analytics-bridge/inc/mock-ga-interface.php';

/**
 * API for querying popular post IDs
 */
require_once 'analytics-bridge/inc/popular-posts-api.php';

/**
 * Dashboard widget
 */
require_once 'analytics-bridge/inc/dash-widget.php';