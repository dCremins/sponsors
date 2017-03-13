<?php

namespace Sponsors\CPT;

function sponsors_post_type()
{
    register_post_type('sponsors', [
    'labels'        => [
      'name'                => __('Sponsors'),
      'singular_name'       => __('Sponsor'),
      'add_new'             => __('Add New'),
      'add_new_item'        => __('Add New Sponsor'),
      'new_item'            => __('New Sponsors'),
      'edit_item'           => __('Edit Sponsors'),
      'view_item'           => __('View Sponsors'),
      'all_items'           => __('All Sponsors'),
      'search_items'        => __('Search Sponsors'),
      'parent_item_colon'   => __('Parent Sponsors'),
      'not_found'           => __('No Sponsors found.'),
      'not_found_in_trash'  => __('No Sponsors found in Trash.'),
    ],
    'public'        => true,
    'query_var'     => true,
    'has_archive'   => true,
    'menu_icon'     => 'dashicons-businessman',
    'supports'      => array('title', 'editor'),

    ]);
}

add_action('init', __NAMESPACE__ . '\\sponsors_post_type');
