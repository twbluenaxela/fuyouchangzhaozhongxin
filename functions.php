<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function fuyou_enqueue_assets() {
	wp_enqueue_style(
		'fuyou-google-fonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;600;700&display=swap',
		[],
		null
	);
	wp_enqueue_style(
		'fuyou-style',
		get_stylesheet_uri(),
		[ 'fuyou-google-fonts' ],
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'fuyou-theme',
		get_template_directory_uri() . '/assets/css/theme.css',
		[ 'fuyou-style' ],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'fuyou_enqueue_assets' );

function fuyou_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;600;700&display=swap' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'fuyou_setup' );

function fuyou_pattern_categories() {
	register_block_pattern_category( 'fuyou-pages', [
		'label' => __( '富佑頁面', 'fuyou-care' ),
	] );
}
add_action( 'init', 'fuyou_pattern_categories' );

/**
 * Dev helper: delete all DB-stored template/part overrides so WordPress
 * always reads from theme files. Runs once per theme version bump.
 * Remove this function (or the option key) before going live.
 */
function fuyou_flush_template_cache() {
	$version   = wp_get_theme()->get( 'Version' );
	$cache_key = 'fuyou_tpl_flush_v' . str_replace( '.', '_', $version );

	if ( get_option( $cache_key ) ) {
		return;
	}

	global $wpdb;
	$theme_slug = get_stylesheet(); // 'fuyou-care'

	// Delete ALL wp_template / wp_template_part posts for this theme,
	// regardless of status, so WordPress falls back to the theme files.
	$ids = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts}
			 WHERE post_type IN ('wp_template','wp_template_part')
			   AND post_name LIKE %s",
			$wpdb->esc_like( $theme_slug . '//' ) . '%'
		)
	);

	foreach ( $ids as $id ) {
		wp_delete_post( (int) $id, true );
	}

	update_option( $cache_key, 1, false );

	// Flush the block template registry cache so WP re-scans files
	if ( class_exists( 'WP_Block_Template_Registry' ) ) {
		WP_Block_Template_Registry::get_instance()->init();
	}
	wp_cache_flush();
}
add_action( 'after_setup_theme', 'fuyou_flush_template_cache' );

/**
 * One-time: create all site pages and the primary navigation menu.
 * Runs once per theme version so re-bumping version re-runs it if needed.
 */
function fuyou_create_pages_and_nav() {
	$version   = wp_get_theme()->get( 'Version' );
	$cache_key = 'fuyou_pages_v' . str_replace( '.', '_', $version );
	if ( get_option( $cache_key ) ) {
		return;
	}

	$pages = [
		[ 'title' => '中心介紹',      'slug' => 'center-intro' ],
		[ 'title' => '入住說明',      'slug' => 'admission'    ],
		[ 'title' => '收費標準',      'slug' => 'pricing'      ],
		[ 'title' => '服務項目',      'slug' => 'services'     ],
		[ 'title' => '性騷擾防治申訴', 'slug' => 'harassment-policy' ],
		[ 'title' => '人才招募',      'slug' => 'careers'      ],
		[ 'title' => '志工資訊',      'slug' => 'volunteer'    ],
		[ 'title' => '交通資訊',      'slug' => 'directions'   ],
		[ 'title' => '聯絡我們',      'slug' => 'contact'      ],
	];

	foreach ( $pages as $page ) {
		if ( ! get_page_by_path( $page['slug'] ) ) {
			wp_insert_post( [
				'post_title'  => $page['title'],
				'post_name'   => $page['slug'],
				'post_status' => 'publish',
				'post_type'   => 'page',
			] );
		}
	}

	// Build navigation block content — all items flat so mobile overlay is clean.
	$nav_content =
		'<!-- wp:navigation-link {"label":"中心介紹","url":"/center-intro","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"服務項目","url":"/services","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"收費標準","url":"/pricing","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"入住說明","url":"/admission","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"交通資訊","url":"/directions","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"聯絡我們","url":"/contact","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"性騷擾防治申訴","url":"/harassment-policy","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"人才招募","url":"/careers","kind":"custom"} /-->' .
		'<!-- wp:navigation-link {"label":"志工資訊","url":"/volunteer","kind":"custom"} /-->';

	// Delete all existing nav posts, then create a clean one.
	$existing = get_posts( [ 'post_type' => 'wp_navigation', 'posts_per_page' => -1, 'post_status' => 'any' ] );
	foreach ( $existing as $nav ) {
		wp_delete_post( $nav->ID, true );
	}
	wp_insert_post( [
		'post_title'   => '主選單',
		'post_status'  => 'publish',
		'post_type'    => 'wp_navigation',
		'post_content' => $nav_content,
	] );

	update_option( $cache_key, 1, false );
}
add_action( 'init', 'fuyou_create_pages_and_nav' );
