<?php

//Include the /acf folder in the places to look for ACF Local JSON files
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = plugin_dir_path(dirname(__FILE__)) . '/acf/acf-json';
    return $paths;
});

add_filter('acf/settings/save_json', function ($path) {
    $path = plugin_dir_path(dirname(__FILE__)) . '/acf/acf-json';
    return $path;
});
