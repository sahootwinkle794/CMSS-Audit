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
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
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
				'script',
				'style',
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
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'twentynineteen' ) : null,
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'twentynineteen' ) : null,
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
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '20181214', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '20181231', true );
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




// MIME doc script 
function secure_allowed_mime_types($mimes) {
    return [
        'jpg|jpeg|jpe' => 'image/jpeg',
        'png'          => 'image/png',
        'pdf'          => 'application/pdf',
        'doc'          => 'application/msword',
        'docx'         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
}
add_filter('upload_mimes', 'secure_allowed_mime_types');

function validate_real_file_type($file) {
    $allowed = [
        'image/jpeg',
        'image/png',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowed)) {
        $file['error'] = 'Invalid file type uploaded.';
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'validate_real_file_type');

add_filter('sanitize_file_name', function($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $name      = pathinfo($filename, PATHINFO_FILENAME);

    // Normalize filename
    $name = strtolower($name);
    $name = preg_replace('/[^a-z0-9\s-_]/', '', $name); // Remove special chars
    $name = preg_replace('/[\s-_]+/', '-', $name);      // Replace spaces/underscores with dash
    $name = trim($name, '-');

    return $name . '.' . strtolower($extension);
});

function get_generic_document_display($attachment_id) {
    $file_path = get_attached_file($attachment_id);

    if (!$file_path || !file_exists($file_path)) {
        return '';
    }

    $file_size = size_format(filesize($file_path), 2);

    return '
        <div class="document-display">
            <span class="doc-icon">📄</span>
            <span class="doc-label">Document</span>
            <span class="doc-size">' . esc_html($file_size) . '</span>
        </div>
    ';
}

// MIME doc script end

// filter html and scripts from admin start
add_filter('the_content', function($content) {
    // Remove all script tags completely
    while (preg_match('/<script/i', $content)) {
        $content = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $content);
    }
    // Remove all event handlers
    $content = preg_replace('/\s+on[a-z]+\s*=\s*(["\']).*?\1/is', '', $content);
    // Remove javascript: protocol
    $content = preg_replace('/javascript\s*:/is', '', $content);
    return $content;
}, 0);

// Block it on save too
add_filter('content_save_pre', function($content) {
    return wp_kses_post($content);
}, 0);

// Remove return_user cookie completely
add_action('init', function() {
    if (isset($_COOKIE['return_user'])) {
        setcookie('return_user', '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'domain'   => '',
            'secure'   => true,       // ← changed from false to true for staging
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }
});

// Force HttpOnly on all cookies
add_action('send_headers', function() {
    if (!headers_sent()) {
        foreach ($_COOKIE as $name => $value) {
            setcookie(
                $name,
                $value,
                [
                    'expires'  => time() + 3600,
                    'path'     => '/',
                    'domain'   => '',
                    'secure'   => true,       // ← true for staging HTTPS
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]
            );
        }
    }
});
// filter html and scripts from admin end

// style injection protect start 

// ============================================================
// 1. STRIP ALL DANGEROUS TAGS BEFORE STORING IN DATABASE
// ============================================================
add_filter('content_save_pre', function($content) {
    // Remove <style> tags — prevents defacement
    $content = preg_replace('/<style\b[^>]*>.*?<\/style>/is', '', $content);
    
    // Remove <script> tags — prevents XSS
    $content = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $content);
    
    // Remove <iframe> tags — prevents clickjacking
    $content = preg_replace('/<iframe\b[^>]*>.*?<\/iframe>/is', '', $content);
    
    // Remove <object> tags
    $content = preg_replace('/<object\b[^>]*>.*?<\/object>/is', '', $content);
    
    // Remove <embed> tags
    $content = preg_replace('/<embed\b[^>]*>.*?<\/embed>/is', '', $content);
    
    // Remove on* event attributes (onclick, onmouseover etc)
    $content = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $content);
    
    // Rewrite external links to warning page
    $site_host = parse_url(home_url(), PHP_URL_HOST);
    $pattern = '#<a\s+([^>]*?)href=["\'](' . 'https?://(?!' . preg_quote($site_host, '#') . ')[^"\']+)["\']([^>]*)>#is';
    $content = preg_replace_callback($pattern, function($matches) {
        $warning_url = home_url('/external-warning/?redirect=' . urlencode($matches[2]));
        return '<a ' . $matches[1] . 'href="' . esc_url($warning_url) . '"' . $matches[3] . '>';
    }, $content);
    
    return $content;
});

// ============================================================
// 2. STRIP DANGEROUS TAGS ON FRONTEND (FOR EXISTING POSTS)
// ============================================================
add_action('wp', function() {
    if (!is_admin()) {
        add_filter('the_content', function($content) {
            $content = preg_replace('/<style\b[^>]*>.*?<\/style>/is', '', $content);
            $content = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $content);
            $content = preg_replace('/<iframe\b[^>]*>.*?<\/iframe>/is', '', $content);
            $content = preg_replace('/<object\b[^>]*>.*?<\/object>/is', '', $content);
            $content = preg_replace('/<embed\b[^>]*>.*?<\/embed>/is', '', $content);
            $content = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $content);
            return $content;
        });
    }
});

// ============================================================
// 3. REMOVE UNFILTERED HTML CAPABILITY FROM NON-ADMINS
// ============================================================
add_action('init', function() {
    $roles = array('editor', 'author', 'contributor');
    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            $role->remove_cap('unfiltered_html');
        }
    }
    
    // Register external warning rewrite rule
    add_rewrite_rule('^external-warning/?$', 'index.php?external_warning=1', 'top');
});

// ============================================================
// 4. FORCE VISUAL EDITOR FOR NON-ADMINS
// ============================================================
add_filter('wp_default_editor', function($editor) {
    if (!current_user_can('administrator')) {
        return 'tinymce';
    }
    return $editor;
});

// ============================================================
// 5. SECURITY HEADERS
// ============================================================
add_action('send_headers', function() {
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; object-src 'none'; frame-ancestors 'none';");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
});

// ============================================================
// 6. EXTERNAL WARNING PAGE QUERY VAR
// ============================================================
add_filter('query_vars', function($vars) {
    $vars[] = 'external_warning';
    return $vars;
});

// ============================================================
// 7. LOAD EXTERNAL WARNING TEMPLATE
// ============================================================
add_action('template_redirect', function() {
    if (!get_query_var('external_warning')) return;

    $redirect_url = isset($_GET['redirect']) ? esc_url_raw($_GET['redirect']) : '';
    $site_host    = parse_url(home_url(), PHP_URL_HOST);

    if (empty($redirect_url) || parse_url($redirect_url, PHP_URL_HOST) === $site_host) {
        wp_redirect(home_url());
        exit;
    }

    load_template(get_template_directory() . '/external-warning.php');
    exit;
});



// style injection protect end 

// secure from domain script inject 
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $hashes = [
        'jquery-core' => 'sha384-REPLACE_WITH_REAL_HASH',
    ];
    if (isset($hashes[$handle])) {
        $tag = str_replace(' src=', ' integrity="' . $hashes[$handle] . '" crossorigin="anonymous" src=', $tag);
    }
    return $tag;
}, 10, 3);
// secure from domain script inject 