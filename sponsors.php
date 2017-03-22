<?php
/*
Plugin Name: ICOET Sponsors
GitHub Plugin URI: https://github.com/dcremins/sponsors
GitHub Branch:      master
Description: Custom Sponsors Post Type and Views for ICOET website use
Version: 0.3.2
Author: Devin Cremins
Author URI: http://octopusoddments.com
*/

// Add all files in lib folder into array
$include = [
  '/lib/add-acf.php',           // Add Advanced Custom Fields
  '/lib/cpt.php',               // Register Post Type
  '/lib/templates.php',         // Register Views
  '/lib/sponsors-widget.php',   // Register Widget
];

// Require Once each file in the array
foreach ($include as $file) {
    if (!$filepath = (dirname(__FILE__) .$file)) {
        trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
    }
    require_once $filepath;
}
unset($file, $filepath);

/* Add main.css */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sponsors_css', plugins_url('/styles/main.css', __FILE__));
    wp_register_script('custom-carousel', plugins_url('/js/custom-carousel.js', __FILE__));
});
