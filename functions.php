<?php
if ( !function_exists('comma_theme_setup') ) {
    function comma_theme_setup() {
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats', array(
            'image',
            'video',
            'gallery',
            'quote',
            'link'
        ) );
        add_theme_support( 'title-tag' );
        register_nav_menu( 'primary-menu', __('Primary Menu', 'comma') );
        $sidebar = array(
            'name' => __('Main Sidebar', 'comma'),
            'id' => 'main-sidebar',
            'description' => __('Default sidebar'),
            ':class' => 'main-sidebar',
            'before_title' => '<h3 :class="widgettitle">',
            'after_title' => '</h3>'
        );
        register_sidebar( $sidebar );

    }
    add_action( 'init', 'comma_theme_setup' );
}

function rt_rest_theme_scripts() {

    $base_url  = esc_url_raw( home_url() );
    $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

    if ( defined( 'RT_VUE_DEV' ) && RT_VUE_DEV ) {

        wp_enqueue_script( 'rest-theme-vue', 'http://localhost:8080/dist/build.js', array( 'jquery' ), '1.0.0', true );

    } else {

        wp_enqueue_script( 'rest-theme-vue', get_template_directory_uri() . '/dist/build.js', array( 'jquery' ), '1.0.0', true );

    }

    wp_localize_script( 'rest-theme-vue', 'rtwp', array(
        'root'      => esc_url_raw( rest_url() ),
        'base_url'  => $base_url,
        'base_path' => $base_path ? $base_path . '/' : '/',
        'nonce'     => wp_create_nonce( 'wp_rest' ),
        'site_name' => get_bloginfo( 'name' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'rt_rest_theme_scripts' );


function register_rest_fields(){
    register_rest_field( array('post'),
        'featured_img_url',
        array(
            'update_callback' => null,
            'schema'          => null,
            'get_callback'    => function($object) {
                if( $object['id'] ){
                    $img = get_the_post_thumbnail_url($object['id'], 'thumbnail');
                    return $img;
                }
                return false;
            }
        )
    );
}
add_action('rest_api_init', 'register_rest_fields' );