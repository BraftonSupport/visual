<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Yvonne's Theme 1.0
 */

$video = get_post_meta( get_queried_object_id(), 'bgvideo', true );
$color = get_post_meta( get_queried_object_id(), 'textcolor', true );
if ( !$video ) {
	$featured = has_post_thumbnail();
	$bg = get_post_meta( get_queried_object_id(), 'bgcolor', true );
	$shadow = get_post_meta( get_queried_object_id(), 'shadow', true );
}
get_header(); ?>
</header><!-- .site-header -->

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section><div style="<?php
			if ( $bg ) { echo 'background-color: ' . $bg . ';'; }
			if ( $color ) { echo 'color: ' . $color . ';'; }
			if ( $featured ) {
				echo 'background-image: url(';
				the_post_thumbnail_url();
				echo ');';
			} 
		?>" class="background<?php
			if ( $video ) { echo ' video'; }
		?>">

		<?php if ( $video ) {

			if (strpos($video, '.webm') == false && strpos($video, '.mp4') == false) {
				echo '<h5 class="warning">Use webm or mp4 files please.</h5>';
			} else {
				$vidstring = chop($video, '.webm');
				$vidstring = chop($vidstring, '.mp4'); ?>
				<button id="vidpause"><i class="fa fa-pause" aria-hidden="true"></i></button>
				<video playsinline autoplay muted loop id="bgvid">
					<?php if (strpos($video, '.webm') == true ) { ?>
						<source src="<?php echo $vidstring; ?>.webm" type="video/webm">
					<?php } else if (strpos($video, '.mp4') == true ) { ?>
						<source src="<?php echo $vidstring; ?>.mp4" type="video/mp4">
					<?php } ?>
				</video>
			<?php }

		} ?>

		<div class="overlay"><div class="site-inner"><?php
			//while ( have_posts() ) : the_post();
				//get_template_part( 'template-parts/content', 'page' );
			//endwhile;
		?>
			<?php // Define custom fields
				$headline = get_field('headline');
				$tagline = get_field('tagline');
				$btntxt = get_field('go_to_button_txt');
				$btnurl = get_field('go_to_button_url'); ?>

				<?php // headline
					if ($headline) {
						// Create container around static section if the headline field has content
						echo '<section class="static">';
						echo "<h2>";
						echo $headline;
						echo "</h2>";
					} ?>

				<?php // tagline
					if ($tagline) {
						echo "<p class='tagline'>";
						echo $tagline;
						echo "</p>";
					} ?>

				<?php // button
					if ($btntxt) {
						echo "<a class='button' href=";
						echo $btnurl;
						echo ">";
						echo $btntxt;
						echo "</a>";
					} ?>

				<?php if ($headline) {
					// Close the container around the static section
					echo '</section>';
				} ?>

		</div></div></div><?php if ( $shadow ) { echo '<hr class="shadow"/>'; } ?></section>

		<!--<?php
		// Set up the objects needed
		//$my_wp_query = new WP_Query();
		//$all_wp_pages = $my_wp_query->query(array('post_type' => 'page','order' => 'ASC','orderby' => 'menu_order'));

		// Get the page as an Object
		//$home = get_option('page_on_front');
		//$home_children = get_page_children( $home, $all_wp_pages );

		//foreach ($home_children as $home_child) {
			//$id = $home_child->ID;
			//$slug = $home_child->post_name;
			//$url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "full" )[0];
			//$bg = get_post_meta( $id, 'bgcolor', true );
			//$color = get_post_meta( $id, 'textcolor', true );
			//$shadow = get_post_meta( $id, 'shadow', true );
			//?>
			<section><div id="<?php echo $slug; ?>" class="background"
			<?php// if ( $url || $bg ) {
				//echo 'style="';
					//if ( $url ) { echo 'background-image: url('. $url .');'; }
					//if ( $bg ) { echo ' background-color:'. $bg .';'; }
					//if ( $color ) { echo ' color:'. $color .';'; }
				//echo '"';
			//} ?>><div class="site-inner">
				<?php //echo apply_filters('the_content', $home_child->post_content); ?>
			</div><?php //if ( $shadow ) { echo '<div class="shadow"></div>'; } ?></div></section>
		<?php //} ?>-->

		<?php // queue the services

			$service_array = array('post_type' => 'services', 'posts_per_page' => '3');
			$loop = new WP_QUERY ($service_array);

			if ($loop->have_posts() ) :

				echo '<div class="services"><div class="site-inner">';

			while ($loop->have_posts() ) : $loop->the_post(); 

			// call custom services fields
			$description = get_field('description');
			$sbtntxt = get_field('button_text');
			$sbtnurl = get_field('button_url');
			$sthumb = '';
				if (function_exists('has_post_thumbnail')) {
					if ( has_post_thumbnail() ) {
						$post_image_id = get_post_thumbnail_id($post_to_use->ID);
							if ($post_image_id) {
								$sthumb = wp_get_attachment_image_src( $post_image_id, 'large', false);
								if ($sthumb) (string)$sthumb = $sthumb[0];
							}
					}
				} 
			?>

			<div class="service">
				<a href="<?php the_permalink(); ?>">
					<div class="thumb" style="background-image: url('<?php echo $sthumb; ?>');"></div>
				</a>
				<h3><?php the_title(); ?></h3>
				<?php if ($description) { echo $description; } ?>
				<?php // button
					if ($sbtntxt) {
						echo "<div class='bottom'><a class='button' href=";
						echo $sbtnurl;
						echo ">";
						echo $sbtntxt;
						echo "</a></div>";
					} ?>
			</div>

			<?php

			endwhile;
			else :
			endif;
			echo '</div></div>'; 
			wp_reset_query(); ?>

		<?php // queue the testimonials 

			$test_array = array('post_type' => 'testimonials', 'posts_per_page' => -1);
			$loop2 = new WP_QUERY ($test_array);

			if ($loop2->have_posts() ) :

				echo '<div class="testimonials"><div class="site-inner"><ul class="testimonials-slider">';
			?>

			<script>
				$ = jQuery.noConflict(); 
				$(document).ready(function(){
				  $('.testimonials-slider').bxSlider({
				  	pager: false,
				  	auto: true,
				  	pause: 8000,
				  	speed: 1500,
				  	autoHover: true,
				  	nextSelector: '#slider-next',
				  	nextText: '<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>',
				  	prevSelector: '#slider-prev',
				  	prevText: '<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>',
			  		mode: 'horizontal',
			  		randomStart: true
				  });
				});
			</script>
		
		<?php

			while ($loop2->have_posts() ) : $loop2->the_post(); 

			// call custom services fields
			$quote = get_field('quote');
			$author = get_field('author');

			$tthumb = '';
				if (function_exists('has_post_thumbnail')) {
					if ( has_post_thumbnail() ) {
						$post_image_id = get_post_thumbnail_id($post_to_use->ID);
							if ($post_image_id) {
								$tthumb = wp_get_attachment_image_src( $post_image_id, 'large', false);
								if ($tthumb) (string)$tthumb = $tthumb[0];
							}
					}
				} 
			?>

			<li>
				<?php if ($quote) { ?>
					<span class="open-quote">
						<i class="fa fa-quote-left" aria-hidden="true"></i>
					</span>
					<span class="close-quote">
						<i class="fa fa-quote-right" aria-hidden="true"></i>
					</span>
					<div class="quote">
					<?php if ($tthumb) { ?>
						<div class="thumb" style="background-image: url('<?php echo $tthumb; ?>');"></div>
					<?php } ?>
					<?php echo $quote; ?>
					<div class="clear"></div>
					<?php if ($author) { ?>
						<span class="author">
							- <?php echo $author; ?>
						</span>
					<?php } ?></div>
				<?php } ?>
			</li>

			<?php

			endwhile;
			else :
			endif;
			echo '</ul><div class="controls"><div id="slider-prev"></div><div id="slider-next"></div></div></div></div>'; 
			wp_reset_query(); ?>

		<?php // queue the 3  most recent awards 

			$award_array = array('post_type' => 'awards', 'posts_per_page' => 3);
			$loop3 = new WP_QUERY ($award_array);

			if ($loop3->have_posts() ) :

				echo '<div class="awards"><div class="site-inner"><h2>Certifications/Awards</h2>';

			while ($loop3->have_posts() ) : $loop3->the_post(); 

			$athumb = '';
				if (function_exists('has_post_thumbnail')) {
					if ( has_post_thumbnail() ) {
						$post_image_id = get_post_thumbnail_id($post_to_use->ID);
							if ($post_image_id) {
								$athumb = wp_get_attachment_image_src( $post_image_id, 'large', false);
								if ($athumb) (string)$athumb = $athumb[0];
							}
					}
				} 
			?>

			<div class="award">
				<?php if ($athumb) { ?>
					<a href="<?php the_permalink(); ?>">
						<div class="thumb" style="background-image: url('<?php echo $athumb; ?>');">
							<div class="overlay">
								<h3><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
							</div>
						</div>
					</a>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
					<?php the_excerpt(); ?>
				<?php } ?>
			</div>

			<?php

			endwhile;
			else :
			endif;
			echo '</div></div>';
			wp_reset_query(); ?>

		<?php // queue the 3  most recent webinars 

			$webinar_array = array('post_type' => 'webinars', 'posts_per_page' => 3);
			query_posts($webinar_array);

			if (have_posts() ) :

				echo '<div class="webinars"><div class="site-inner"><h2>Webinars/Events</h2>';

			while (have_posts() ) : the_post(); 

			$wthumb = '';
				if (function_exists('has_post_thumbnail')) {
					if ( has_post_thumbnail() ) {
						$post_image_id = get_post_thumbnail_id($post_to_use->ID);
							if ($post_image_id) {
								$wthumb = wp_get_attachment_image_src( $post_image_id, 'large', false);
								if ($wthumb) (string)$wthumb = $wthumb[0];
							}
					}
				} 
			?>

			<div class="webinar">
				<?php if ($wthumb) { ?>
					<a href="<?php the_permalink(); ?>">
						<div class="thumb" style="background-image: url('<?php echo $wthumb; ?>');">
							<div class="overlay">
								<h3><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
							</div>
						</div>
					</a>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
					<?php the_excerpt(); ?>
				<?php } ?>
			</div>

			<?php

			endwhile;
			else :
			endif;
		echo '</div></div>'; ?>
	</main><!-- .site-main -->

</div><!-- .content-area -->
<?php if ( $video ) { ?>
	<script>
var vid = document.getElementById("bgvid"),
pauseButton = document.getElementById("vidpause");
function vidFade() {
    vid.classList.add("stopfade");
}
vid.addEventListener('ended', function() {
    // only functional if "loop" is removed 
     vid.pause();
	// to capture IE10
	vidFade();
});
pauseButton.addEventListener("click", function() {
    vid.classList.toggle("stopfade");
	if (vid.paused) {
vid.play();
		pauseButton.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
	} else {
        vid.pause();
        pauseButton.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
	}
})
</script>
<?php }
get_footer(); ?>