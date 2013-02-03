<?php
function reverie_setup() {
	// Add language supports. Please note that Reverie Framework does not include language files.
	load_theme_textdomain('reverie', get_template_directory() . '/lang');
	
	// Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(150, 150, true); // 150 pixels wide by 150 pixels tall, crop mode
	
	// Add post formats supports. http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
	// Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
	add_theme_support('menus');
	register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'reverie'),
		'utility_navigation' => __('Utility Navigation', 'reverie')
	));	
}
add_action('after_setup_theme', 'reverie_setup');

add_image_size( 'page-header', 705, 225, true ); // 705 pixels wide by 225 pixels tall, hard crop mode

// Breadcrumbs function
function get_breadcrumbs(){
	global $post;

	$separator = ' » '; // what to place between the pages

	if ( is_page() ){
		// bread crumb structure only logical on pages
		$trail = array($post); // initially $trail only contains the current page
		$parent = $post; // initially set to current post
		$show_on_front = get_option( 'show_on_front'); // does the front page display the latest posts or a static page
		$page_on_front = get_option( 'page_on_front' ); // if it shows a page, what page
		// while the current page isn't the home page and it has a parent
		while ( $parent->post_parent && !($parent->ID == $page_on_front && 'page') == $show_on_front ){
			$parent = get_post( $parent->post_parent ); // get the current page's parent
			array_unshift( $trail, $parent ); // add the parent object to beginning of array
		}
		if ( 'posts' == $show_on_front ) // if the front page shows latest posts, simply display a home link
			echo "<li class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Ullerup Sogn</a></li>\n"; // home page link
		else{ // if the front page displays a static page, display a link to it
			$home_page = get_post( $page_on_front ); // get the front page object
			echo "<li class='breadcrumb-item' id='breadcrumb-{$home_page->ID}'><a href='" . get_bloginfo('home') . "'>$home_page->post_title</a></li>\n"; // home page link
			if($trail[0]->ID == $page_on_front) // if the home page is an ancestor of this page
				array_shift( $trail ); // remove the home page from the $trail because we've already printed it
		}
		foreach ( $trail as $page){
			// print the link to the current page in the foreach
			echo "<li class='breadcrumb-item' id='breadcrumb-{$page->ID}' >$separator<a href='" . get_page_link( $page->ID ) . "'>{$page->post_title}</a></li>\n";
		}
	}else{
		// if what we're looking at isn't a page, simply display a home link
		echo "<li class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Ullerup Sogn</a></li>\n"; // home page link
	}
}

// Enqueue for header and footer, thanks to flickapix on Github.
// Enqueue css files
function reverie_css() {
  if ( !is_admin() ) {
  
     wp_register_style( 'foundation',get_template_directory_uri() . '/css/foundation.css', false );
     wp_enqueue_style( 'foundation' );
    
     wp_register_style( 'app',get_template_directory_uri() . '/css/app.css', false );
     wp_enqueue_style( 'app' );
     
     wp_register_style( 'offcanvas',get_template_directory_uri() . '/css/offcanvas.css', false );
     wp_enqueue_style( 'offcanvas' );
     
     // Load style.css to allow contents overwrite foundation & app css
     wp_register_style( 'style',get_template_directory_uri() . '/style.css', false );
     wp_enqueue_style( 'style' );
     
     wp_register_style( 'google_font',"http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300", false );
     wp_enqueue_style( 'google_font' );
     
  }
}  
add_action( 'init', 'reverie_css' );

function reverie_ie_css () {
    echo '<!--[if lt IE 9]>';
    echo '<link rel="stylesheet" href="'. get_template_directory_uri().'/css/ie.css">';
    echo '<![endif]-->';
}
add_action( 'wp_head', 'reverie_ie_css' );

// Enqueue js files
function reverie_scripts() {

global $is_IE;

  if ( !is_admin() ) {
  
  // Enqueue to header
     wp_deregister_script( 'jquery' );
     wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js' );
     wp_enqueue_script( 'jquery' );
     
     wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.foundation.js', array( 'jquery' ) );
     wp_enqueue_script( 'modernizr' );
 
  // Enqueue to footer
     wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), false, true );
     wp_enqueue_script( 'foundation' );
     
     wp_register_script( 'offcanvas', get_template_directory_uri() . '/js/jquery.offcanvas.js', array( 'jquery' ), false, true );
     wp_enqueue_script( 'offcanvas' );
     
     wp_register_script( 'app', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), false, true );
     wp_enqueue_script( 'app' );
     
    
     if ($is_IE) {
        wp_register_script ( 'html5shiv', "http://html5shiv.googlecode.com/svn/trunk/html5.js" , false, true);
        wp_enqueue_script ( 'html5shiv' );
     } 
     
     // Enable threaded comments 
     if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
		wp_enqueue_script('comment-reply');
  }
}
add_action( 'init', 'reverie_scripts' );

// Control exerpt length etc.
function custom_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
       global $post;
	return ' <a href="'. get_permalink($post->ID) . '">...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// create widget areas: sidebar, footer
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="sidebar-section">',
		'after_widget' => '</div></article>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}
$sidebars = array('Blog-sidebar');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="sidebar-section">',
		'after_widget' => '</div></article>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="three columns widget %2$s"><div class="footer-section">',
		'after_widget' => '</div></article>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));
}

// return entry meta information for posts, used by multiple loops.
function reverie_entry_meta() {
	echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Skrevet %s', 'reverie'), get_the_time('l, j F, Y'), get_the_time()) . '</time>';
	echo ''. __(' af ', 'reverie') . get_the_author() .' i ';
	echo the_category("");
}

/* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );

function cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';

	/* Open the caption <div>. */
	$output = '<figure' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

	/* Close the caption </div>. */
	$output .= '</figure>';

	/* Return the formatted, clean caption. */
	return $output;
}

// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function image_tag_class($class, $id, $align, $size) {
	$align = 'align' . esc_attr($align);
	return $align;
}
add_filter('get_image_tag_class', 'image_tag_class', 0, 4);
function image_tag($html, $id, $alt, $title) {
	return preg_replace(array(
			'/\s+width="\d+"/i',
			'/\s+height="\d+"/i',
			'/alt=""/i'
		),
		array(
			'',
			'',
			'',
			'alt="' . $title . '"'
		),
		$html);
}
add_filter('get_image_tag', 'image_tag', 0, 4);

// Customize output for menu
class reverie_walker extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout\">\n";
  }
}

// Add Foundation 'active' class for the current menu item 
function reverie_active_nav_class( $classes, $item )
{
    if($item->current == 1)
    {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'reverie_active_nav_class', 10, 2 );

// img unautop, Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
function img_unautop($pee) {
    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
    return $pee;
}
add_filter( 'the_content', 'img_unautop', 30 );

// Pagination
function reverie_pagination() {
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => True,
	    'prev_text' => __('&laquo;'),
	    'next_text' => __('&raquo;'),
		'type' => 'list'
	) );
 
	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="reverie-pagination">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}

// Presstrends
function presstrends() {

// Add your PressTrends and Theme API Keys
$api_key = 'xc11x4vpf17icuwver0bhgbzz4uewlu5ql38';
$auth = 'kw1f8yr8eo1op9c859qcqkm2jjseuj7zp';

// NO NEED TO EDIT BELOW
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
$url = $api_base . $auth . '/api/' . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$count_pages = wp_count_posts('page');
$comments_count = wp_count_comments();
$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
$plugin_count = count(get_option('active_plugins'));
$all_plugins = get_plugins();
foreach($all_plugins as $plugin_file => $plugin_data) {
$plugin_name .= $plugin_data['Name'];
$plugin_name .= '&';
}
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['pages'] = $count_pages->publish;
$data['comments'] = $comments_count->total_comments;
$data['approved'] = $comments_count->approved;
$data['spam'] = $comments_count->spam;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = $theme_data['Name'];
$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['plugin'] = urlencode($plugin_name);
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';
}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);
}}
add_action('admin_init', 'presstrends');

// support for custom header
$defaults = array(
	'default-image'          => '%s/images/headers/default.jpg',
	'random-default'         => true,
	'width'                  => 960,
	'height'                 => 300,
	'flex-height'            => true,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
?>