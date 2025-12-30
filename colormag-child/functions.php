<?php

add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style(
    'colormag-child-style',
    get_parent_theme_file_uri( 'style.css' )
  );
});

add_action( 'init', function()
{
  $options['post_type_name'] = 'app_news_item'; //  Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.

  $options['name_singular'] = 'News Item';
  $options['name_plural'] = 'News';
  $options['slug'] = strtolower( $options['name_plural'] );

  $post_type = array(
    'labels' => array(
      'name'                  => _x( $options['name_plural'], 'post type general name' ),
      'singular_name'         => _x( $options['name_singular'], 'post type singular name' ),
      'add_new'               => _x( 'Add New', $options['name_singular'] ),
      'add_new_item'          => __( 'Add ' . $options['name_singular'] ),
      'edit_item'             => __( 'Edit ' . $options['name_singular'] ),
      'new_item'              => __( 'New ' . $options['name_singular'] ),
      'all_items'             => __( 'All ' . $options['name_plural'] ),
      'view_item'             => __( 'View ' . $options['name_singular'] ),
      'search_items'          => __( 'Search ' . $options['name_plural'] ),
      'not_found'             => __( 'No ' . $options['name_plural'] . ' found'),
      'not_found_in_trash'    => __( 'No ' . $options['name_plural'] . ' found in Trash'),
      'parent_item_colon'     => '',
      'menu_name'             => $options['name_plural']
    ),

    'capabilities' => array(
        'edit_post'          => 'edit_event',
        'read_post'          => 'read_event',
        'delete_post'        => 'delete_event',
        'edit_posts'         => 'edit_events',
        'edit_others_posts'  => 'edit_others_events',
        'publish_posts'      => 'publish_events',
        'read_private_posts' => 'read_private_events',
        'create_posts'       => 'edit_events',
    ),
    'map_meta_cap'        => true,

    'menu_icon' => 'dashicons-admin-page',
    'public' => true,
    'show_in_rest' => true,

    'has_archive' => true,
    'rewrite' => array(
      'slug' => $options['slug'],
      'with_front' => false,
    ),

    'supports' => array(
      'author',
      'editor',
      'title',
      'revisions',
      'thumbnail',
    ),

    'hide_meta_box' => array(
      'slug',
      'author',
      'revisions',
      'comments',
      'commentstatus',
    )
  );

  register_post_type( $options['post_type_name'], $post_type );
});


/**
 * Setup User Permissions for Custom Post Type
 *
 * @uses register_post_type()
 */
add_action( 'admin_init', function ()
{
  $roles = array( 'administrator', 'editor' );
  foreach ( $roles as $this_role ) {
    $role = get_role( $this_role );
    $role->add_cap( 'edit_event' );
    $role->add_cap( 'read_event' );
    $role->add_cap( 'delete_event' );
    $role->add_cap( 'edit_events' );
    $role->add_cap( 'edit_others_events' );
    $role->add_cap( 'publish_events' );
    $role->add_cap( 'read_private_events' );
  }
});
