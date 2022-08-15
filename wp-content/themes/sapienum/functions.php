<?php
/**
 * Sapienum functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 */

/**
 * Sapienum only works in WordPress 4.7 or later.
 */

if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sapienum_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/sapienum
     * If you're building a theme based on Sapienum, use a find and replace
     * to change 'sapienum' to the name of your theme in all the template files.
     */
    load_theme_textdomain('sapienum');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('sapienum-featured-image', 2000, 1200, true);

    add_image_size('sapienum-thumbnail-avatar', 100, 100, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'main' => __('Main Menu', 'sapienum'),
        'social' => __('Social Links Menu', 'sapienum'),
        'login' => __('Login Menu', 'sapienum'),
        'loggedin' => __('LoggedIn Menu', 'sapienum'),
        'footer' => __('Footer Menu', 'sapienum'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
     */
    add_editor_style(array('assets/css/editor-style.css', sapienum_fonts_url()));

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets' => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),

            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),

            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array(
            'home',
            'about' => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog' => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),

        // Create the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
            'image-espresso' => array(
                'post_title' => _x('Espresso', 'Theme starter content', 'sapienum'),
                'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
            ),
            'image-sandwich' => array(
                'post_title' => _x('Sandwich', 'Theme starter content', 'sapienum'),
                'file' => 'assets/images/sandwich.jpg',
            ),
            'image-coffee' => array(
                'post_title' => _x('Coffee', 'Theme starter content', 'sapienum'),
                'file' => 'assets/images/coffee.jpg',
            ),
        ),

        // Default to a static front page and assign the front and posts pages.
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods' => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'top' => array(
                'name' => __('Top Menu', 'sapienum'),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),

            // Assign a menu to the "social" location.
            'social' => array(
                'name' => __('Social Links Menu', 'sapienum'),
                'items' => array(
                    'link_yelp',
                    'link_facebook',
                    'link_twitter',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );

    /**
     * Filters Sapienum array of starter content.
     *
     * @since Sapienum 1.1
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters('sapienum_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}
add_action('after_setup_theme', 'sapienum_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sapienum_content_width()
{

    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (sapienum_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    /**
     * Filter Sapienum content width of the theme.
     *
     * @since Sapienum 1.0
     *
     * @param int $content_width Content width in pixels.
     */
    $GLOBALS['content_width'] = apply_filters('sapienum_content_width', $content_width);
}
add_action('template_redirect', 'sapienum_content_width', 0);

/**
 * Register custom fonts.
 */
function sapienum_fonts_url()
{
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $libre_franklin = _x('on', 'Libre Franklin font: on or off', 'sapienum');

    if ('off' !== $libre_franklin) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Sapienum 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function sapienum_resource_hints($urls, $relation_type)
{
    if (wp_style_is('sapienum-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'sapienum_resource_hints', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sapienum_widgets_init()
{
    register_sidebar(array(
        'name' => __('Blog Sidebar', 'sapienum'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'sapienum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => __('Home Page', 'sapienum'),
        'id' => 'sidebar-4',
        'description' => __('Add widgets here to appear in your home page side area.', 'sapienum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 1', 'sapienum'),
        'id' => 'sidebar-2',
        'description' => __('Add widgets here to appear in your footer.', 'sapienum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'sapienum'),
        'id' => 'sidebar-3',
        'description' => __('Add widgets here to appear in your footer.', 'sapienum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'sapienum_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Sapienum 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function sapienum_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }

    $link = sprintf('<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'sapienum'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'sapienum_excerpt_more');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Sapienum 1.0
 */
function sapienum_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'sapienum_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function sapienum_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
    }
}
add_action('wp_head', 'sapienum_pingback_header');

/**
 * Display custom color CSS.
 */
function sapienum_colors_css_wrap()
{
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once get_parent_theme_file_path('/inc/color-patterns.php');
    $hue = absint(get_theme_mod('colorscheme_hue', 250));
    ?>
	<style type="text/css" id="custom-theme-colors" <?php if (is_customize_preview()) {echo 'data-hue="' . $hue . '"';}?>>
		<?php echo sapienum_custom_colors_css(); ?>
	</style>
	<?php }
add_action('wp_head', 'sapienum_colors_css_wrap');

/**
 * Enqueue scripts and styles.
 */
function sapienum_scripts()
{
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('sapienum-fonts', sapienum_fonts_url(), array(), null);

    // Theme stylesheet.
    wp_enqueue_style('sapienum-style', get_stylesheet_uri());

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('sapienum-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('sapienum-style'), '1.0');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('sapienum-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('sapienum-style'), '1.0');
        wp_style_add_data('sapienum-ie9', 'conditional', 'IE 9');
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('sapienum-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('sapienum-style'), '1.0');
    wp_style_add_data('sapienum-ie8', 'conditional', 'lt IE 9');

    wp_enqueue_style('responsive', get_theme_file_uri('/assets/css/responsive.css'), array(), '3.7.3');
    wp_enqueue_style('jquery-uicss', get_theme_file_uri('/assets/css/jquery-ui.css'), array(), '3.7.3');

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '3.7.3');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('sapienum-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '1.0', true);

    $sapienum_l10n = array(
        'quote' => sapienum_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('sapienum-navigation', get_theme_file_uri('/assets/js/navigation.js'), array('jquery'), '1.0', true);
        $sapienum_l10n['expand'] = __('Expand child menu', 'sapienum');
        $sapienum_l10n['collapse'] = __('Collapse child menu', 'sapienum');
        $sapienum_l10n['icon'] = sapienum_get_svg(array('icon' => 'angle-down', 'fallback' => true));
    }

    wp_enqueue_script('sapienum-global', get_theme_file_uri('/assets/js/global.js'), array('jquery'), '1.0', true);

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

    // wp_enqueue_script( 'theme-script', get_theme_file_uri( '/assets/js/theme-script.js' ), array( 'jquery' ), '2.1.2', true );

    wp_localize_script('sapienum-skip-link-focus-fix', 'sapienumScreenReaderText', $sapienum_l10n);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sapienum_scripts');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Sapienum 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function sapienum_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];

    if (740 <= $width) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }

    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
        if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }

    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'sapienum_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Sapienum 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function sapienum_header_image_tag($html, $header, $attr)
{
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}
add_filter('get_header_image_tag', 'sapienum_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Sapienum 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function sapienum_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if (is_archive() || is_search() || is_home()) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'sapienum_post_thumbnail_sizes_attr', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Sapienum 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function sapienum_front_page_template($template)
{
    return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'sapienum_front_page_template');

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

require get_parent_theme_file_path('/inc/useripchek.php');
require get_parent_theme_file_path('/inc/like-dislike.php');

/**
 * user login registration
 */
require get_parent_theme_file_path('/functions/registration.php');
require get_parent_theme_file_path('/functions/login.php');

add_action('wp_ajax_nopriv_fetch_category_post_sapienum', 'rs_fetch_category_post_callback');
add_action('wp_ajax_fetch_category_post_sapienum', 'rs_fetch_category_post_callback');

/*category post fetch by ajax request*/
function rs_fetch_category_post_callback()
{
    $slugs = rtrim($_POST['cat'], '/');
    $slug = explode('/', $slugs);
    $currentCategory = end($slug);

// print_r($currentCategory);
    // echo "Category ".$currentCategory;
    ?>

<div class="postList">
    <ul>
        <?php query_posts(array(
        'post_type' => 'post',
        'category_name' => $currentCategory,
        'post_status' => 'publish',
    ));
    ?>
            <?php while (have_posts()): the_post();?> <li class="wow rotateInDownRight"> <a href="<?php the_permalink()?>"> <span><?php the_title();?></span> </a> <sub> <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments; ?></sub> </li> <?php endwhile; wp_reset_query();?>
        </ul>
    </div>
<?php
die(0);
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
        'icon_url' => 'dashicons-laptop',
    ));
}

function remove_category($string, $type)
{
    if ($type != 'single' && $type == 'category' && (strpos($string, 'category') !== false)) {
        $url_without_category = str_replace("/category/", "/", $string);
        return trailingslashit($url_without_category);
    }
    return $string;
}

add_filter('user_trailingslashit', 'remove_category', 100, 2);

if (function_exists('register_sidebar')) {register_sidebar(array('name' => 'Left Sidebar', 'id' => 'left-sidebar', 'description' => 'Appears as the sidebar on left Side', 'before_widget' => '<div style="height: 280px"></div><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li>', 'before_title' => '<h2 class="widgettitle">', 'after_title' => '</h2>'));}

// localize wp-ajax, notice the path to our theme-ajax.js file
wp_enqueue_script('form-validation', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.js', array('jquery'));
wp_enqueue_script('form-validation-additional', get_stylesheet_directory_uri() . '/assets/js/additional-methods.min.js', array('jquery'));

wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'));

wp_enqueue_script('rsclean-request-script', get_stylesheet_directory_uri() . '/assets/js/theme-script.js', array('jquery'));

wp_enqueue_script('paginathing.min', get_stylesheet_directory_uri() . '/assets/js/paginathing.min.js', array('jquery'));


wp_localize_script('rsclean-request-script', 'theme_ajax', array(
    'url' => admin_url('admin-ajax.php'),
    'site_url' => get_bloginfo('url'),
    'theme_url' => get_bloginfo('template_directory'),
));

add_action('wp_ajax_nopriv_fetch_post_sapienum', 'rs_fetch_post_sapienum');
add_action('wp_ajax_fetch_post_sapienum', 'rs_fetch_post_sapienum');

/*category post fetch by ajax request*/
function rs_fetch_post_sapienum()
{
    session_start();
    //print_r($_SESSION);
    $order = $_POST['order'];

     $page = (isset($_POST['page_num'])) ? $_POST['page_num'] : 1;

    if ($order == 'd') {
        
         $orderby = "DESC";
        session_start();
        $_SESSION['POST_ORDER'] = $orderby;
        $args=array(
        'post_type' => 'post',        
        'orderby' => array('comment_count' => $_SESSION['POST_ORDER']),        
        'paged' => $page,
        'posts_per_page'=> '20',
        );
        //$session_val=
    } else if ($order == 'a') {       
        $last_commentID=get_option('recent_post_order');
        $args=array(
        'post_type' => 'post',                     
        'paged' => $page,
        'orderby' => 'post__in',
        'posts_per_page'=> '20',
        'post__in' => $last_commentID,

        );
    }
    else{
        $last_commentID=get_option('recent_post_order');
        $args=array(
        'post_type' => 'post',                     
        'paged' => $page,
        'orderby' => 'post__in',
        'posts_per_page'=> '20',
        'post__in' => $last_commentID,

        );

    }


     //$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 0;
    $data=query_posts($args);
    //echo "<pre>";
    //print_r($data);


    ?>
            <?php while (have_posts()): the_post();?>                                                                                                                                                                   <li class="wow rotateInDownRight lt-post list-group-item">                                                                   <a href="<?php the_permalink()?>">                                                          <span><?php the_title();?></span>                                                                   </a> <sub><?php $comments_count = wp_count_comments(get_the_ID());
        echo $comments_count->total_comments;
        ?></sub>  </li>                                                                         <?php endwhile;
    wp_reset_query();?>
<?php
die(0);
}

function add_comment($post_id, $comment)
{
    global $current_user;
    get_currentuserinfo();

    $time = current_time('mysql');
    $user_id = get_current_user_id();

    $args = array(
        'comment_post_ID' => $post_id,
        'comment_author' => $current_user->user_login,
        'comment_author_email' => $current_user->user_email,
        'comment_content' => $comment,
        'comment_type' => '',
        'comment_parent' => 0,
        'user_id' => $user_id,
        'comment_date' => $time,
        'comment_approved' => 1,
    );
    $result = wp_insert_comment($args);
    //update_option( 'last_comment_postID', $post_id );
    update_recent_post_comment();

    update_comment_meta( $result, 'cld_like_count', '0' );

    return $result;
}

/**
 * @kaleshwar delete post created by login user
 */
add_action('wp_ajax_custom_delete_action', 'custom_delete_action');
add_action('wp_ajax_nopriv_custom_delete_action', 'custom_delete_action');
function custom_delete_action()
{

    if (!empty($_POST['DeleteID'])) {
        wp_delete_post($_POST['DeleteID']);
    }

    die();
}

/**
 * @kaleshwar delete comment
 */
add_action('wp_ajax_comment_delete_action', 'comment_delete_action');
add_action('wp_ajax_nopriv_comment_delete_action', 'comment_delete_action');
function comment_delete_action()
{

    if (!empty($_POST['DeleteID'])) {
        wp_delete_comment($_POST['DeleteID']);
    }

    die();
}

/*send message to user*/
add_action('wp_ajax_send_private_message_action', 'send_private_message_action');
add_action('wp_ajax_nopriv_send_private_message_action', 'send_private_message_action');
function send_private_message_action()
{

    $to_email_address = $_POST['to_email_hidden'];
    $to_userid = $_POST['to_email_ID'];
    $subject = $_POST['subject'];
    $messagecontent = $_POST['comment_value'];

    global $wpdb;
    $table_private_message = $wpdb->prefix . 'private_message_custom';

    $current_user = wp_get_current_user();
    $senderid = $current_user->ID;
    $senderemail = $current_user->user_email;
    //print_r($current_user);

    $create_date = date("Y-m-d h:i:s");
    $sql2 = "INSERT INTO $table_private_message ( sender_ID, sender_email_ID, recipient_ID, recipient_email_ID, message_subject, message_content, created_date, status) VALUES ('$senderid', '$senderemail', '$to_userid', '$to_email_address', '$subject', '$messagecontent', '$create_date', '1')";
    $result = $wpdb->query($sql2);
    echo "Message Sent Successfully.";
    die(0);
}

/*
 *@kaleshwar yadav
 * update comment data
 */
function update_comment_postData($content, $comment_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "comments";
    $updateSql = "UPDATE " . $table_name . " SET comment_content='" . $content . "' WHERE comment_ID = '" . $comment_id . "'";
    $wpdb->query($updateSql);
    return $updateSql;
}

function sendMail($email, $subject, $body)
{
    $confirmUrl = get_permalink(242) . '?id=314d873788804d008a8afa637eafdfbe';
    $mailcontent = '<!DOCTYPE html>
                        <html>
                        <head></head>
                        <body>
                            <h3>Hello there,</h3>
                            <p>Dictionary control your message to be sent to sour you have to click on the link below. </p>
                            <p><a href="' . $confirmUrl . '">' . $confirmUrl . '</a></p>
                            <table>
                                <tr>
                                    <td>We would like to indicate that the message you send to us or persons hidden in the provision of private correspondence. If you wish sour Dictionary these messages -sends main name for name, surname and e-mail address, including the subject of the following units, on the subject if you can convey to the author and required by the other person or judicial authorities. If the dictionary sour deems it necessary, the text of the message reached him partially or fully, indicating the surname of the senders name on the page can publish it deems relevant.</td>
                                </tr>
                                <tr>
                                    <td>If you do not want your complaint to be subject to the above process, you can add a note to your complaint. a text or title to include the text of your message is not mandatory for the complaint. Complaints are also received in the same way without any text in the review. The messaging studies there is no option other than to complain that we can give guarantee of privacy. </td>
                                    <td>
                                    </tr>
                                    <tr>
                                    <td>answers that you wrote this e-mail does not reach us.
                                    our respect</td>
                                </tr>
                            </table>
                        </body>
                        </html>';
    add_filter('wp_mail_content_type', 'set_html_content_type');
    $admin_email = get_option('admin_email');
    $email = $email;
    $headers = 'From:Sapienum <' . $admin_email . '>' . "\r\n";

    $mailsucess = wp_mail($email, 'Confirm contact form', $mailcontent, $headers);
}
function set_html_content_type($content_type)
{
    return 'text/html';
}

function mycustom_comment_pagination()
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag;
    comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID()?>"><?php
if ('div' != $args['style']) {?>
        <div id="div-comment-<?php comment_ID()?>" class="comment-body"><?php
}?>
        <?php
if ($comment->comment_approved == '0') {
        ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.');?></em><br/><?php
}?>

        <?php
global $comment;
global $post;
//print_r($comment);
    $title = urlencode(get_the_title());
    $url = urlencode(get_the_permalink());
    $summary = urlencode($comment->comment_content);
    $image = urlencode('');
    $authorUrl = get_author_posts_url($comment->user_id, $comment->$author_nicename);
    $like_count = get_comment_meta($comment->comment_ID, 'cld_like_count', true);
    $comment_id = $comment->comment_ID;
    $current_user = wp_get_current_user();
    $postid = $post->ID;
    ?>
    <div class="commentBox">
       <p><?php echo $comment->comment_content; ?></p>

        <div class="listDetail cld-like-wrap  cld-common-wrap">
               <ul class="socialLike">
                <li>
                 <a onClick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://www.twitter.com/share?url=<?php echo $url; ?>" target="_blank" data-toggle="tooltip" ><i class="fa fa-twitter"></i></a>
                            </li>
                            <?php if (is_user_logged_in()) {?>
                            <li>
                                <a href="javascript:void(0);" data-comment-id="<?php echo $comment->comment_ID; ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset($_COOKIE['cld_' . $comment_id])) ? 'cld-prevent' : ''; ?> " data-restriction="ip" data-trigger-type="like" data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-up"></i></a>
                                <a href="javascript:void(0);" data-trigger-type="dislike" data-restriction="ip"  data-comment-id="<?php echo $comment->comment_ID; ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset($_COOKIE['cld_' . $comment_id])) ? 'cld-prevent' : ''; ?> "  data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-down"></i></a>

                             <span class="cld-like-count-wrap cld-count-wrap"><?php echo (empty($like_count)) ? 0 : number_format($like_count); ?></span>
                            </li>
                        <?php }?>
                        </ul>
                        <ul class="dateTime">
                            <li><?php printf(
        __('%1$s at %2$s'),
        get_comment_date(),
        get_comment_time()
    );?></li>
                            <li><a href="<?php echo $authorUrl; ?>"><?php echo $comment->comment_author; ?></a></li>
                            <li>
                               <figure>
                                <div class="dropdown">
                                  <button class="dropbtn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png"  alt="dot" ></button>
                                  <div class="dropdown-content">
                                  <?php if ($comment->user_id == $current_user->ID): ?>
                                    <a href="<?php echo get_permalink(222); ?>?topicid=<?php echo $comment_id; ?>&id=<?php echo $postid; ?>">Correct</a>
                                   <?php endif?>
                                   <?php if ($comment->user_id != $current_user->ID): ?>
                                    <a href="<?php echo get_permalink(217); ?>?complaintID=<?php echo $comment_id; ?>">Complaint</a>
                                    <?php endif?>
                                    <?php if ($comment->user_id == $current_user->ID): ?>
                                    <a href="javascript:void(0)" onclick="return ConfirmDelete('<?php echo $comment_id; ?>');">Delete</a>
                                    <?php endif?>
                                  </div>
                                </div>
                                </figure>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <?php
}
?>

<?php
function update_recent_post_comment()
{
global $wpdb;
$query = "SELECT * from $wpdb->comments WHERE comment_approved= '1'
ORDER BY comment_date DESC LIMIT 0 , 1000";    // This shows top 10 comments     
$comments = $wpdb->get_results($query);
if ($comments) {
    foreach ($comments as $comment) {
    $comment_post_ID[]=$comment->comment_post_ID;
    }
}
$comment_post_array=array_unique($comment_post_ID);
foreach($comment_post_array as $post){
    $post_array[]=$post;
}
update_option('recent_post_order', $post_array);
}
?>