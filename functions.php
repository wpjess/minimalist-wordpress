<?php

if ( ! function_exists( 'anthropic_minimal_setup' ) ) :

    function anthropic_minimal_setup() {
        load_theme_textdomain( 'anthropic-minimal', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'anthropic-minimal' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support( 'custom-background', apply_filters( 'anthropic_minimal_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        add_theme_support( 'wp-block-styles' );

        add_theme_support( 'align-wide' );

        add_theme_support( 'editor-styles' );
        add_editor_style( 'editor-style.css' );

        add_theme_support( 'responsive-embeds' );
    }
endif;
add_action( 'after_setup_theme', 'anthropic_minimal_setup' );

function anthropic_minimal_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'anthropic_minimal_content_width', 800 );
}
add_action( 'after_setup_theme', 'anthropic_minimal_content_width', 0 );

function anthropic_minimal_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'anthropic-minimal' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'anthropic-minimal' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'anthropic_minimal_widgets_init' );

function anthropic_minimal_scripts() {
    wp_enqueue_style( 'anthropic-minimal-style', get_stylesheet_uri(), array(), '1.0.0' );
    wp_style_add_data( 'anthropic-minimal-style', 'rtl', 'replace' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'anthropic_minimal_scripts' );

function anthropic_minimal_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }

    $link = sprintf(
        '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        sprintf(
            wp_kses(
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'anthropic-minimal' ),
                array( 'span' => array( 'class' => array() ) )
            ),
            get_the_title( get_the_ID() )
        )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'anthropic_minimal_excerpt_more' );

function anthropic_minimal_body_classes( $classes ) {
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_singular() && has_post_thumbnail() ) {
        $classes[] = 'has-post-thumbnail';
    }

    return $classes;
}
add_filter( 'body_class', 'anthropic_minimal_body_classes' );

function anthropic_minimal_post_classes( $classes, $post_id ) {
    if ( ! has_post_thumbnail( $post_id ) ) {
        $classes[] = 'no-post-thumbnail';
    }

    return $classes;
}
add_filter( 'post_class', 'anthropic_minimal_post_classes', 10, 2 );

function anthropic_minimal_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'anthropic_minimal_pingback_header' );

function anthropic_minimal_comment_form_default_fields( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_default_fields', 'anthropic_minimal_comment_form_default_fields' );

if ( ! function_exists( 'wp_body_open' ) ) :
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;