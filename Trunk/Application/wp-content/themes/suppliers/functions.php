<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary', 'twentynineteen' ),
				'cmsswings' => __( 'Main wings', 'twentynineteen' ),
				'gallerymenu' => __( 'CMSS Gallery', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'footerimp' => __( 'Footer Imp', 'twentynineteen' ),
				'footerusefull' => __( 'Footer Usefull Links', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Right Sidbar', 'twentynineteen' ),
			'id'            => 'right-sidebar',
			'description'   => __( 'Add widgets here to appear in your Right Sidebar.', 'twentynineteen' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	); 

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );
function custom_post_type() {
 
    $labels = array(
        'name'                => _x( 'Highlights', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Highlights', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Highlights', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Highlights', 'twentynineteen' ),
        'all_items'           => __( 'All Highlights', 'twentynineteen' ),
        'view_item'           => __( 'View Highlights', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Highlights', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Highlights', 'twentynineteen' ),
        'update_item'         => __( 'Update Highlights', 'twentynineteen' ),
        'search_items'        => __( 'Search Highlights', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $args = array(
        'label'               => __( 'Highlights', 'twentynineteen' ),
        'description'         => __( 'Highlights news and reviews', 'twentynineteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genre' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'highlights', $args );
	
	$banner_labels = array(
        'name'                => _x( 'Banner', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Banner', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Banner', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Banner', 'twentynineteen' ),
        'all_items'           => __( 'All Banner', 'twentynineteen' ),
        'view_item'           => __( 'View Banner', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Banner', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Banner', 'twentynineteen' ),
        'update_item'         => __( 'Update Banner', 'twentynineteen' ),
        'search_items'        => __( 'Search Banner', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $banner_args = array(
        'label'               => __( 'Banner', 'twentynineteen' ),
        'description'         => __( 'Banner news and reviews', 'twentynineteen' ),
        'labels'              => $banner_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        //'taxonomies'          => array( 'genre' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'Banner', $banner_args );
	
	$warehouse_labels = array(
        'name'                => _x( 'Warehouse', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Warehouse', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Warehouse', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Warehouse', 'twentynineteen' ),
        'all_items'           => __( 'All Warehouse', 'twentynineteen' ),
        'view_item'           => __( 'View Warehouse', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Warehouse', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Warehouse', 'twentynineteen' ),
        'update_item'         => __( 'Update Warehouse', 'twentynineteen' ),
        'search_items'        => __( 'Search Warehouse', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $warehouse_args = array(
        'label'               => __( 'Warehouse', 'twentynineteen' ),
        'description'         => __( 'Warehouse news and reviews', 'twentynineteen' ),
        'labels'              => $warehouse_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        //'taxonomies'          => array( 'genre' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'warehouse', $warehouse_args );
	
	$blacklisted_labels = array(
        'name'                => _x( 'Blacklisted Firms', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Blacklisted Firms', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Blacklisted Firms', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Blacklisted Firms', 'twentynineteen' ),
        'all_items'           => __( 'All Blacklisted Firms', 'twentynineteen' ),
        'view_item'           => __( 'View Blacklisted Firms', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Blacklisted Firms', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Blacklisted Firms', 'twentynineteen' ),
        'update_item'         => __( 'Update Blacklisted Firms', 'twentynineteen' ),
        'search_items'        => __( 'Search Blacklisted Firms', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $blacklisted_args = array(
        'label'               => __( 'Blacklisted Firms', 'twentynineteen' ),
        'description'         => __( 'Blacklisted Firms', 'twentynineteen' ),
        'labels'              => $blacklisted_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        //'taxonomies'          => array( 'genre' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'blacklisted', $blacklisted_args );
	
	$progress_labels = array(
        'name'                => _x( 'CMSS Progress', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'CMSS Progress', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'CMSS Progress', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent CMSS Progress', 'twentynineteen' ),
        'all_items'           => __( 'All CMSS Progress', 'twentynineteen' ),
        'view_item'           => __( 'View CMSS Progress', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New CMSS Progress', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit CMSS Progress', 'twentynineteen' ),
        'update_item'         => __( 'Update CMSS Progress', 'twentynineteen' ),
        'search_items'        => __( 'Search CMSS Progress', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $progress_args = array(
        'label'               => __( 'CMSS Progress', 'twentynineteen' ),
        'description'         => __( 'CMSS Progress', 'twentynineteen' ),
        'labels'              => $progress_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        //'taxonomies'          => array( 'genre' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'progress', $progress_args );
	
	$whoiswho_labels = array(
        'name'                => _x( 'Management', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Management', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Management', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Management', 'twentynineteen' ),
        'all_items'           => __( 'All Management', 'twentynineteen' ),
        'view_item'           => __( 'View Management', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Management', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Management', 'twentynineteen' ),
        'update_item'         => __( 'Update Management', 'twentynineteen' ),
        'search_items'        => __( 'Search Management', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$whoiswho_args = array(
        'label'               => __( 'Management', 'twentynineteen' ),
        'description'         => __( 'CMSS Management', 'twentynineteen' ),
        'labels'              => $whoiswho_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'whoiswho', $whoiswho_args );
	
	$whoiswhos_labels = array(
        'name'                => _x( 'Who is Who', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Who is Who', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Who is Who', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Who is Who', 'twentynineteen' ),
        'all_items'           => __( 'All Who is Who', 'twentynineteen' ),
        'view_item'           => __( 'View Who is Who', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Who is Who', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Who is Who', 'twentynineteen' ),
        'update_item'         => __( 'Update Who is Who', 'twentynineteen' ),
        'search_items'        => __( 'Search Who is Who', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$whoiswhos_args = array(
        'label'               => __( 'Who is Who', 'twentynineteen' ),
        'description'         => __( 'CMSS Who is Who', 'twentynineteen' ),
        'labels'              => $whoiswhos_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'whoiswhos', $whoiswhos_args );
	
	$suppliers_labels = array(
        'name'                => _x( 'Suppliers', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Suppliers', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Suppliers', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Partner', 'twentynineteen' ),
        'all_items'           => __( 'All Suppliers', 'twentynineteen' ),
        'view_item'           => __( 'View Partner', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Suppliers', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Suppliers', 'twentynineteen' ),
        'update_item'         => __( 'Update Suppliers', 'twentynineteen' ),
        'search_items'        => __( 'Search Suppliers', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$suppliers_args = array(
        'label'               => __( 'Suppliers', 'twentynineteen' ),
        'description'         => __( 'CMSS Suppliers', 'twentynineteen' ),
        'labels'              => $suppliers_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'suppliers', $suppliers_args );
	
	$offer_labels = array(
        'name'                => _x( 'What We Offer', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'What We Offer', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'What We Offer', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent What We Offer', 'twentynineteen' ),
        'all_items'           => __( 'All What We Offer', 'twentynineteen' ),
        'view_item'           => __( 'View What We Offer', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New What We Offer', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit What We Offer', 'twentynineteen' ),
        'update_item'         => __( 'Update What We Offer', 'twentynineteen' ),
        'search_items'        => __( 'Search What We Offer', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$offer_args = array(
        'label'               => __( 'What We Offer', 'twentynineteen' ),
        'description'         => __( 'CMSS What We Offer', 'twentynineteen' ),
        'labels'              => $offer_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'weoffer', $offer_args );
	
	$achievement_labels = array(
        'name'                => _x( 'Achievements', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Achievements', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Achievements', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Achievement', 'twentynineteen' ),
        'all_items'           => __( 'All Achievements', 'twentynineteen' ),
        'view_item'           => __( 'View Achievement', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Achievements', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Achievements', 'twentynineteen' ),
        'update_item'         => __( 'Update Achievements', 'twentynineteen' ),
        'search_items'        => __( 'Search Achievements', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$achievement_args = array(
        'label'               => __( 'Achievements', 'twentynineteen' ),
        'description'         => __( 'CMSS Achievements', 'twentynineteen' ),
        'labels'              => $achievement_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
	register_post_type( 'achievements', $achievement_args );
	
	$events_labels = array(
        'name'                => _x( 'Events', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Events', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Events', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Events', 'twentynineteen' ),
        'all_items'           => __( 'All Events', 'twentynineteen' ),
        'view_item'           => __( 'View Events', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Events', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Events', 'twentynineteen' ),
        'update_item'         => __( 'Update Events', 'twentynineteen' ),
        'search_items'        => __( 'Search Events', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$events_args = array(
        'label'               => __( 'Events', 'twentynineteen' ),
        'description'         => __( 'Events', 'twentynineteen' ),
        'labels'              => $events_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'events', $events_args );
	
	$tender_labels = array(
        'name'                => _x( 'Tender & Notices', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Tender&Notices', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Tender & Notices', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Tender & Notices', 'twentynineteen' ),
        'all_items'           => __( 'All Tender & Notices', 'twentynineteen' ),
        'view_item'           => __( 'View Tender & Notices', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Tender & Notices', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Tender & Notices', 'twentynineteen' ),
        'update_item'         => __( 'Update Tender & Notices', 'twentynineteen' ),
        'search_items'        => __( 'Search Tender & Notices', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$tender_args = array(
        'label'               => __( 'Tender & Notices', 'twentynineteen' ),
        'description'         => __( 'Tender & Notices', 'twentynineteen' ),
        'labels'              => $tender_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'projects_technologies', 'locations' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'tender&notices', $tender_args );
	
	$updates_labels = array(
        'name'                => _x( 'News & Updates', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'News & Updates', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'News & Updates', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent News & Update', 'twentynineteen' ),
        'all_items'           => __( 'All News & Updates', 'twentynineteen' ),
        'view_item'           => __( 'View News & Updates', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New News & Updates', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Job', 'twentynineteen' ),
        'update_item'         => __( 'Update Job', 'twentynineteen' ),
        'search_items'        => __( 'Search Job', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$updates_args = array(
        'label'               => __( 'News & Updates', 'twentynineteen' ),
        'description'         => __( 'Vacancy in News & Updates', 'twentynineteen' ),
        'labels'              => $updates_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'projects_technologies', 'locations' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'newsupdates', $updates_args );
	
	$social_labels = array(
        'name'                => _x( 'Social & Webcast', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Social & Webcast', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Social & Webcast', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Social & Webcast', 'twentynineteen' ),
        'all_items'           => __( 'All Social & Webcast', 'twentynineteen' ),
        'view_item'           => __( 'View Social & Webcast', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Social & Webcast', 'twentynineteen' ),
        'add_new'             => __( 'Add Social & Webcast', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Social & Webcast', 'twentynineteen' ),
        'update_item'         => __( 'Update Social & Webcast', 'twentynineteen' ),
        'search_items'        => __( 'Search Social & Webcast', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $social_args = array(
        'label'               => __( 'Social & Webcast', 'twentynineteen' ),
        'description'         => __( 'Social & Webcast', 'twentynineteen' ),
        'labels'              => $social_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes', 'revisions', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'Social & Webcast', $social_args );
	
	$dashboard_labels = array(
        'name'                => _x( 'Dashboard', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Dashboard', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Dashboard', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Dashboard', 'twentynineteen' ),
        'all_items'           => __( 'All Dashboard', 'twentynineteen' ),
        'view_item'           => __( 'View Dashboard', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Dashboard', 'twentynineteen' ),
        'add_new'             => __( 'Add Dashboard', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Dashboard', 'twentynineteen' ),
        'update_item'         => __( 'Update Dashboard', 'twentynineteen' ),
        'search_items'        => __( 'Search Dashboard', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
     
    $dashboard_args = array(
        'label'               => __( 'Dashboard', 'twentynineteen' ),
        'description'         => __( 'Dashboard', 'twentynineteen' ),
        'labels'              => $dashboard_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes', 'revisions', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'Dashboard', $dashboard_args );
	
	$footerlogo_labels = array(
        'name'                => _x( 'Footer Logo', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Footer Logo', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Footer Logo', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Footer Logo', 'twentynineteen' ),
        'all_items'           => __( 'All Footer Logo', 'twentynineteen' ),
        'view_item'           => __( 'View Footer Logo', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Footer Logo', 'twentynineteen' ),
        'add_new'             => __( 'Add New', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Footer Logo', 'twentynineteen' ),
        'update_item'         => __( 'Update Footer Logo', 'twentynineteen' ),
        'search_items'        => __( 'Search Footer Logo', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	$footerlogo_args = array(
        'label'               => __( 'Footer Logo', 'twentynineteen' ),
        'description'         => __( 'CMSS Footer Logo', 'twentynineteen' ),
        'labels'              => $footerlogo_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'projects_technologies' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
	register_post_type( 'footerlogo', $footerlogo_args );
			
	$gallery_labels = array(
        'name'                => _x( 'Gallery', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Gallery', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Gallery', 'twentynineteen' ),
        'all_items'           => __( 'All Gallery', 'twentynineteen' ),
        'view_item'           => __( 'View Gallery', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Gallery', 'twentynineteen' ),
        'add_new'             => __( 'Add Gallery', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Gallery', 'twentynineteen' ),
        'update_item'         => __( 'Update Gallery', 'twentynineteen' ),
        'search_items'        => __( 'Search Gallery', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	
    $gallery_args = array(
        'label'               => __( 'Gallery', 'twentynineteen' ),
        'description'         => __( 'Gallery', 'twentynineteen' ),
        'labels'              => $gallery_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes', 'revisions', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'galleries', $gallery_args );
	
	$annualreport_labels = array(
        'name'                => _x( 'Annual Report', 'Post Type General Name', 'twentynineteen' ),
        'singular_name'       => _x( 'Annual Report', 'Post Type Singular Name', 'twentynineteen' ),
        'menu_name'           => __( 'Annual Report', 'twentynineteen' ),
        'parent_item_colon'   => __( 'Parent Annual Report', 'twentynineteen' ),
        'all_items'           => __( 'All Annual Report', 'twentynineteen' ),
        'view_item'           => __( 'View Annual Report', 'twentynineteen' ),
        'add_new_item'        => __( 'Add New Annual Report', 'twentynineteen' ),
        'add_new'             => __( 'Add Annual Report', 'twentynineteen' ),
        'edit_item'           => __( 'Edit Annual Report', 'twentynineteen' ),
        'update_item'         => __( 'Update Annual Report', 'twentynineteen' ),
        'search_items'        => __( 'Search Annual Report', 'twentynineteen' ),
        'not_found'           => __( 'Not Found', 'twentynineteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentynineteen' ),
    );
	
    $annualreport_args = array(
        'label'               => __( 'Annual Report', 'twentynineteen' ),
        'description'         => __( 'Annual Report', 'twentynineteen' ),
        'labels'              => $annualreport_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes', 'revisions', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'annual_report', $annualreport_args );
	
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type', 0 );

add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
	register_taxonomy(
        'whoiswho-category',
        array('whoiswho'),
        array(
            'labels' => array(
                'name' => 'Management Category',
                'add_new_item' => 'Add New Management Category',
                'new_item_name' => "New Management Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
			'show_admin_column' => true
        )
    );
	register_taxonomy(
        'whoiswhos-category',
        array('whoiswhos'),
        array(
            'labels' => array(
                'name' => 'who is who Category',
                'add_new_item' => 'Add New who is who Category',
                'new_item_name' => "New who is who Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
			'show_admin_column' => true
        )
    );
	register_taxonomy(
        'social-category',
        array('socialwebcast'),
        array(
            'labels' => array(
                'name' => 'Social Category',
                'add_new_item' => 'Add New Social Category',
                'new_item_name' => "New Social Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
			'show_admin_column' => true
        )
    );
}
remove_filter( 'the_content', 'wpautop' );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
//* Remove type tag from script and style
add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('autoptimize_html_after_minify', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle)
{
    return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');
remove_action('wp_head', 'wp_generator');
add_action( 'send_headers', 'tgm_io_strict_transport_security' );
/**
* Enables the HTTP Strict Transport Security (HSTS) header.
*
* @since 1.0.0
*/
function tgm_io_strict_transport_security() {

	header( 'Strict-Transport-Security: max-age=10886400' );

}
add_action('login_init', 'acme_autocomplete_login_init');
function acme_autocomplete_login_init()
{
    ob_start();
}
 
add_action('login_form', 'acme_autocomplete_login_form');
function acme_autocomplete_login_form()
{
    $content = ob_get_contents();
    ob_end_clean();

    $content = str_replace('id="user_pass"', 'id="user_pass" autocomplete="off"', $content);

    echo $content;
}
function remove_wordpress_version_number() {
return '';
}
add_filter('the_generator', 'remove_wordpress_version_number');

function remove_version_from_scripts( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_version_from_scripts');
add_filter( 'script_loader_src', 'remove_version_from_scripts');

add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle ) 
{
    $handles_with_version = [ 'style' ];

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}
/** Change default error messages **/
function no_wordpress_errors(){
  return 'Something is wrong!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

add_filter( 'upload_mimes', 'theme_restrict_mime_types' );
function theme_restrict_mime_types( $mime_types )
{
    $mime_types = array(
        'pdf' => 'application/pdf',
        'jpg|jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png'
    );
    return $mime_types;
}

// Remove Lost Password Link
function vpsb_remove_lostpassword_text ( $text ) {
         if ($text == 'Lost your password?'){$text = '';}
                return $text;
         }
add_filter( 'gettext', 'vpsb_remove_lostpassword_text' );

if( current_user_can( 'editor' ) ) {
    add_filter( 'show_password_fields', '__return_false' );
}
// this action performs in admit footer
function load_script_to_remove_arrow(){
?>
<script>
jQuery(document).ready(function() {
    jQuery('#wp-admin-bar-site-name a').attr('target','_blank');
    jQuery('#wp-admin-bar-view-site a').attr('target','_blank');
    jQuery('#sample-permalink a').attr('target','_blank');
    jQuery('.row-actions span.view a').attr('target','_blank');
    jQuery('.notice.notice-success').css('display','none');
    jQuery('.updated').css('display','none');
    jQuery('.inline-edit-group').css('display','none');
    jQuery('#wppmoldpass').css('display','none');
    jQuery('span.description').css('display','none');
});
</script>
<?php
}
add_action( 'admin_footer', 'load_script_to_remove_arrow' );

function my_editor_settings($settings) {
    if ( ! current_user_can('administrator') ) {
        $settings['quicktags'] = false;
        return $settings;
    } else {
        $settings['quicktags'] = true;
        return $settings;
    }
}

add_filter('wp_editor_settings', 'my_editor_settings');

function mg_publishing_actions(){
echo '<style type="text/css">
.editor-post-visibility__choice{ display:none;}
#post-visibility-select{display: none !important;}
</style>';

}
add_action('admin_head-post.php', 'mg_publishing_actions');
add_action('admin_head-post-new.php', 'mg_publishing_actions');
add_action('admin_head-post-new.php', 'mg_publishing_actions');


function remove_empty_style_tags() {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Remove empty style tags
            document.querySelectorAll("style:empty").forEach(function(emptyStyleTag) {
                emptyStyleTag.remove();
            });
        });
    </script>';
}

add_action('wp_footer', 'remove_empty_style_tags');


function format_file_size($size) {
	$units = array('B', 'KB', 'MB', 'GB', 'TB');
	$i = 0;
	while ($size >= 1024) {
		$size /= 1024;
		$i++;
	}

	return round($size, 2) . ' ' . $units[$i];
}


// Search only in page titles
function search_pages_by_title_only( $search, $wp_query ) {
	global $wpdb;

	if ( empty( $search ) || ! $wp_query->is_search() ) {
		return $search;
	}

	$q = $wp_query->query_vars;
	$search = '';
	$n = ! empty( $q['exact'] ) ? '' : '%';
	$searchand = '';

	foreach ( (array) $q['search_terms'] as $term ) {
		$term = esc_sql( $wpdb->esc_like( $term ) );
		$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
		$searchand = ' AND ';
	}

	if ( ! empty( $search ) ) {
		$search = " AND ({$search}) ";
		if ( ! is_user_logged_in() ) {
			$search .= " AND ($wpdb->posts.post_password = '') ";
		}
	}

	return $search;
}
add_filter( 'posts_search', 'search_pages_by_title_only', 10, 2 );

// Restrict search to pages only
function limit_search_to_pages( $query ) {
	if ( $query->is_search() && $query->is_main_query() ) {
		$query->set( 'post_type', 'page' );
	}
}
add_action( 'pre_get_posts', 'limit_search_to_pages' );


function enqueue_carousel_scripts() {
  wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), null, true);
//   wp_enqueue_script('carousel-control', get_template_directory_uri() . '/js/carousel-control.js', array('jquery', 'owl-carousel'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_carousel_scripts');


