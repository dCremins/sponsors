<?php
namespace Sponsors\Templates;

/* Search Theme for CPT templates and then use the templates in this Plugin if none are found */

add_filter('template_include', __NAMESPACE__ . '\\include_template_function', 1);


function include_template_function($template_path)
{
    if (get_post_type() == 'sponsors') {
        if (is_single()) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ($theme_file = locate_template(array ('single-sponsor.php'))) {
                return $theme_file;
            }
            return plugin_dir_path(dirname(__FILE__)) . '/lib/single-sponsor.php';
        } elseif (is_archive()) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ($theme_file = locate_template(array ('archive-sponsors.php'))) {
                return $theme_file;
            }
            return plugin_dir_path(dirname(__FILE__)) . 'lib/archive-sponsors.php';
        }
    }
    return $template_path;
}
