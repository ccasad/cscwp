<?php
/**
 * Child-Theme functions and definitions
 */

//Add footer menus to theme
function register_my_menus() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' ),
      'footer-sub-menu' => __( 'Footer Sub Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


//Add Sidebars to theme 
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

  register_sidebar( array(
    'name'          => 'Program Sidebar',
    'id'            => 'program',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Team Sidebar',
    'id'            => 'team',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );


}

add_action( 'widgets_init', 'arphabet_widgets_init' );
?>
