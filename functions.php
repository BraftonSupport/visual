<?php
/*
Author: Yvonne Tse
URL: http://yvonnetse.com/
Version: Diving Bell 1.0
*/
define("divingbell", dirname(__FILE__));
include divingbell.'/inc/themesettings.php';
include divingbell.'/inc/themewidgets.php';
include divingbell.'/inc/template-tags.php';

/**
 * Diving Bell only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'yttheme_setup' ) ) :


function yttheme_setup() {

	load_theme_textdomain( 'yttheme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'yttheme' ),
		'social'  => __( 'Social Links Menu', 'yttheme' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	add_editor_style( array( 'css/editor-style.css', yttheme_fonts_url() ) );
}
endif; // yttheme_setup
add_action( 'after_setup_theme', 'yttheme_setup' );

function yttheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yttheme_content_width', 840 );
}
add_action( 'after_setup_theme', 'yttheme_content_width', 0 );

/**
 * Register widget areas.
 */
function yttheme_widgets_init() {

	register_sidebar( array(
		'name'		  => __( 'Blog Sidebar', 'yttheme' ),
		'id'			=> 'blog-sidebar',
		'description'   => __( 'Appears on blog and blog posts in the sidebar.' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'		  => __( 'Header', 'yttheme' ),
		'id'			=> 'header',
		'description'   => 'This is located in the header area. Only 1 widget pls.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'		  => __( 'Footer', 'yttheme' ),
		'id'			=> 'footer',
		'description'   => 'This is located in the footer. Use up to 4 widgets.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'yttheme_widgets_init' );


/**
 * How many widget? This many!
 */
function get_widgets_count( $sidebar_id ) {
	$sidebars_widgets = wp_get_sidebars_widgets();
	return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
}

/**
 * HOH custom excerpt
 */
function excerpt($limit) {
	return wp_trim_words(get_the_excerpt(), $limit, custom_read_more());
}


if ( ! function_exists( 'yttheme_fonts_url' ) ) :
/**
 * Register Google fonts for Diving Bell.
 *
 * Create your own yttheme_fonts_url() function to override in a child theme.
 *
 * @since Diving Bell 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function yttheme_fonts_url() {
	$fonts_url = '';
	$fonts	 = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'yttheme' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'yttheme' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'yttheme' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function yttheme_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'yttheme_javascript_detection', 0 );


/**
 * Enqueue all the things!
 */
function yttheme_enqueuingallthethings() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'yttheme-fonts', yttheme_fonts_url(), array(), null );

	// Add Genericons and fontawesome, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	wp_enqueue_style( 'font-awesome.min', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');

	// Theme stylesheet.
	wp_enqueue_style( 'yttheme-style', get_template_directory_uri() . '/style.css' );

	// Sass stylesheet.
	wp_enqueue_style( 'yttheme-sass', get_template_directory_uri() . '/css/styles.css', array( 'yttheme-style' ), '20150930' );

	// Featherlight
	wp_enqueue_style( 'featherlight', get_template_directory_uri() . '/js/featherlight.css' );
	wp_enqueue_script( 'featherlight.js', get_template_directory_uri() . '/js/featherlight.js');

	// BxSlider
	wp_enqueue_script( 'bxslider.js', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '20151204', true );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'yttheme-ie', get_template_directory_uri() . '/css/ie.css', array( 'yttheme-style' ), '20150930' );
	wp_style_add_data( 'yttheme-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'yttheme-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'yttheme-style' ), '20151230' );
	wp_style_add_data( 'yttheme-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'yttheme-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'yttheme-style' ), '20150930' );
	wp_style_add_data( 'yttheme-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'yttheme-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'yttheme-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'yttheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true );

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'yttheme-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
	}

	wp_enqueue_script( 'yttheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151204', true );

	wp_localize_script( 'yttheme-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'yttheme' ),
		'collapse' => __( 'collapse child menu', 'yttheme' ),
	) );
	
	$options = get_option( 'yttheme_options' );
	if ( $options['stickynav'] ) {
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky.js', array(), '1.0.0', true );
	}

	wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'yttheme_enqueuingallthethings' );


/**
 * Adds custom classes to the array of body classes.
 */
function yttheme_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'yttheme_body_classes' );

/**
 * Converts a HEX value to RGB.
 */
function yttheme_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 */
function yttheme_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'yttheme_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 */
function yttheme_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'yttheme_post_thumbnail_sizes_attr', 10 , 3 );

function yttheme_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'full' ); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 */
function yttheme_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'yttheme_widget_tag_cloud_args' );



/**
 * What it says on the tin.
 */
$options = get_option( 'yttheme_options' );
if ( $options['ssbutton'] ) {
	function social_sharing_buttons($content) {
		// if(is_single()){

			// Get current page URL 
			$ssbURL = get_permalink();

			// Get current page title
			$ssbTitle = str_replace( ' ', '%20', get_the_title());
			
			// Get Post Thumbnail for pinterest
			$ssbThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			// Construct sharing URL without using any script
			$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ssbURL;
			$twitterURL = 'https://twitter.com/intent/tweet?text='.$ssbTitle.'&amp;url='.$ssbURL;
			$googleURL = 'https://plus.google.com/share?url='.$ssbURL;
			$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$ssbURL.'&amp;media='.$ssbThumbnail[0].'&amp;description='.$ssbTitle;
			$linkedURL = 'linkedin.com/shareArticle?mini=true&url='.$ssbURL.'&title='.$ssbTitle;

			// Add sharing button at the end of page/page content
			$variable .= '<div class="ssb-social">';
			$options = get_option( 'yttheme_options' );
			if ( $options['ss_fb'] ) { $variable .= '<a class="ssb-facebook" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>'; }
			if ( $options['ss_tw'] ) { $variable .= '<a class="ssb-twitter" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>'; }
			if ( $options['ss_gp'] ) { $variable .= '<a class="ssb-googleplus" href="'.$googleURL.'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>'; }
			if ( $options['ss_li'] ) { $variable .= '<a class="ssb-linked" href="'.$linkedURL.'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>'; }
			if ( $options['ss_pin'] ) { $variable .= '<a class="ssb-pinterest" href="'.$pinterestURL.'" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>'; }
			if ( $options['ss_email'] ) { $variable .= '<a class="ssb-email" href="mailto:?subject=I wanted you to see this site&amp;body='.$ssbURL.'"><i class="fa fa-envelope" aria-hidden="true"></i></a>'; }
			$variable .= '</div>';

			return $variable.$content;
		// }else{
			// if not a post/page then don't include sharing button
			return $variable.$content;
		// }
	};
	if(is_single()){ add_filter( 'the_content', 'social_sharing_buttons'); }
}


/* Neat background things for home page sections */

function bg_meta_markup($object) {
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	?>
		<div>
			<p>Display featured image as banner?&nbsp;<label class="screen-reader-text" for="banner">Banner</label>
			<?php $banner_value = get_post_meta($object->ID, "banner", true);

			if($banner_value == "") { ?>
				<input name="banner" type="checkbox" value="true">
			<?php } elseif($banner_value == "true") { ?>  
				<input name="banner" type="checkbox" value="true" checked>
			<?php } ?>

			<p>Add Shadow?&nbsp;<label class="screen-reader-text" for="shadow">Add Shadow</label>
			<?php $shadow_value = get_post_meta($object->ID, "shadow", true);

			if($shadow_value == "") { ?>
				<input name="shadow" type="checkbox" value="true">
			<?php } elseif($shadow_value == "true") { ?>  
				<input name="shadow" type="checkbox" value="true" checked>
			<?php } ?>

			<p><label for="bgcolor">Background Color</label><br>
			<input name="bgcolor" type="text" placeholder="Enter hexcode" value="<?php echo get_post_meta($object->ID, "bgcolor", true); ?>" ></p>

			<p><label for="textcolor">Text Color</label><br>
			<input name="textcolor" type="text" placeholder="Enter hexcode" value="<?php echo get_post_meta($object->ID, "textcolor", true); ?>" ></p>

			<?php global $post;
			$frontpage_id = get_option('page_on_front');

			if($post->ID == $frontpage_id) { ?>
			<p><label for="bgvideo">Background Video</label><br>
			<input name="bgvideo" type="text" placeholder="Enter url" value="<?php echo get_post_meta($object->ID, "bgvideo", true); ?>"><br/>
			Hint: upload a webm and/or an mp4 file.</p>
			<?php } ?>

		</div>
	<?php  
}

add_action("add_meta_boxes", "add_bg_meta_box");
function add_bg_meta_box() {
	add_meta_box("bg_meta", "Style", "bg_meta_markup", "page", "side", "low", null);
}

add_action("save_post", "save_bg_meta_box", 10, 3);
function save_bg_meta_box($post_id, $post, $update)
{
	if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
		return $post_id;

	if(!current_user_can("edit_post", $post_id))
		return $post_id;

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
		return $post_id;

	$slug = "page";
	if($slug != $post->post_type)
		return $post_id;

	$banner = "";
	$shadow = "";
	$bg_value = "";
	$color = "";
	$bgvideo_value = "";


	if(isset($_POST["banner"])) {
		$banner = $_POST["banner"];
	}
	update_post_meta($post_id, "banner", $banner);

	if(isset($_POST["shadow"])) {
		$shadow = $_POST["shadow"];
	}   
	update_post_meta($post_id, "shadow", $shadow);

	if(isset($_POST["bgcolor"])) {
		$bg_value = $_POST["bgcolor"];
	}   
	update_post_meta($post_id, "bgcolor", $bg_value);

	if(isset($_POST["textcolor"])) {
		$color = $_POST["textcolor"];
	}   
	update_post_meta($post_id, "textcolor", $color);

	if(isset($_POST["bgvideo"])) {
		$bgvideo_value = esc_url($_POST["bgvideo"]);
	}   
	update_post_meta($post_id, "bgvideo", $bgvideo_value);
}

/* the boxes on the team part of the front page, idk */

function boxes_markup($object) {
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	?>
		<p><label for="rightbox">Right Box</label><br>
		<textarea name="right_box" id="right_box" rows="4" placeholder="HTML plox"><?php echo get_post_meta($object->ID, "right_box", true); ?></textarea></p>
		<p><label for="leftbox">Left Box</label><br>
		<textarea name="left_box" id="left_box" rows="4" placeholder="HTML plox"><?php echo get_post_meta($object->ID, "left_box", true); ?></textarea></p>
	<?php  
}

function add_more_boxes() {
	add_meta_box("more-boxes", "Front Page Content", "boxes_markup", "team", "normal", "high", null);
}

add_action("save_post", "save_boxes", 10, 3);
function save_boxes($post_id, $post, $update){
	if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
		return $post_id;

	if(!current_user_can("edit_post", $post_id))
		return $post_id;

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
		return $post_id;

	$right = "";
	$left = "";

	if(isset($_POST["right_box"])) {
		$right = $_POST["right_box"];
	}   
	update_post_meta($post_id, "right_box", $right);

	if(isset($_POST["left_box"])) {
		$left = $_POST["left_box"];
	}
	update_post_meta($post_id, "left_box", $left);
}


// Team member post type
add_action( 'init', 'create_team_posttype' );
function create_team_posttype() {
	register_post_type( 'team',
		array(
			'labels' => array(
			'name' => __( 'Instruments' ),
			'singular_name' => __( 'Phenomenon' ),
			'add_new' => __( 'Add New Situation'),
			'add_new_item' => __( 'Add New Concern'),
			'edit_item' => __( 'Edit Everything' ),
			'new_item' => __( 'New Stuff'),
			'view_item' => __( 'View Apparatus'),
			'search_items' => __( 'Search Things'),
			'all_items' => __( 'All Devices')
			),
		'menu_icon' => 'dashicons-groups',
		'hierarchical'  => false,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'team'),
		'supports' => array( 'title', 'revisions', 'thumbnail', 'custom-fields' ),
		'register_meta_box_cb' => 'add_more_boxes'
		)
	);
}

add_action( 'init', 'create_services_posttype' );
function create_services_posttype() {
	register_post_type( 'services',
		array(
			'labels' => array(
			'name' => __( 'Services' ),
			'singular_name' => __( 'Service' ),
			'add_new' => __( 'Add New Service'),
			'add_new_item' => __( 'Add New Service'),
			'edit_item' => __( 'Edit Service' ),
			'new_item' => __( 'New Service'),
			'view_item' => __( 'View Service'),
			'search_items' => __( 'Search Services'),
			'all_items' => __( 'All Services')
			),
		'menu_icon' => 'dashicons-groups',
		'hierarchical'  => false,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'services'),
		'supports' => array( 'title', 'revisions', 'thumbnail', 'custom-fields' ),
		'register_meta_box_cb' => 'add_more_boxes'
		)
	);
}

add_action( 'init', 'create_testimonials_posttype' );
function create_testimonials_posttype() {
	register_post_type( 'testimonials',
		array(
			'labels' => array(
			'name' => __( 'Testimonials' ),
			'singular_name' => __( 'Testimonial' ),
			'add_new' => __( 'Add New Testimonial'),
			'add_new_item' => __( 'Add New Testimonial'),
			'edit_item' => __( 'Edit Testimonial' ),
			'new_item' => __( 'New Testimonial'),
			'view_item' => __( 'View Testimonial'),
			'search_items' => __( 'Search Testimonials'),
			'all_items' => __( 'All Testimonials')
			),
		'menu_icon' => 'dashicons-groups',
		'hierarchical'  => false,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'testimonials'),
		'supports' => array( 'title', 'revisions', 'thumbnail', 'custom-fields' ),
		'register_meta_box_cb' => 'add_more_boxes'
		)
	);
}

/* the team shortcode */

function team_shortcode() {
	echo '<div class="team">';
	$args = array( 'post_type' => 'team', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) :
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<div class="container hide">';
		$post = get_post($_POST['id']);
		$left = get_post_meta( get_the_ID(), 'left_box', true );
		$right = get_post_meta( get_the_ID(), 'right_box', true );

		echo '<div class="teamleft">';
		echo the_title('<h3>', '</h3>');
		if ( ! empty( $left ) ) {
			echo $left;
		}
		echo '</div>';
		echo '<div class="teammiddle"><a class="previous button"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
		if ( has_post_thumbnail() ) {
			echo '<div class="round"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>';
			the_post_thumbnail( 'team' );
			echo '</div>';
		}
		echo '<a class="next button"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>';

		if ( ! empty( $right ) ) {
			echo '<div class="teamright">'.$right.'</div>';
		}
		echo '</div>';
	endwhile;
	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;
	echo '</div>';
}
add_shortcode('team', 'team_shortcode');

add_image_size( 'team', 250, 250, array( 'center', 'center' ) );