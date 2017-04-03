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
 
  //response generation function

  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";


  if (!empty($_POST['prop-submit'])) {

	  //user posted variables
	  //Prop Form Fields
	  $naics = 			$_POST['message_naics'];
	  $naics_other = 	$_POST['message_other'];
	  $revenue = 		$_POST['message_revenue'];
	  $country = 		$_POST['message_country'];
	  $years = 			$_POST['message_years'];
	  $name = 			$_POST['message_name'];
	  $email = 			$_POST['message_email'];
	  $attachments = 	$_FILES['upload_file'];
	  $human = 			$_POST['message_human'];

	  //php mailer variables
	  $to = "gregory.rich@brafton.com";
	  $subject = "Property/Casualty Form Submission from ".get_bloginfo('name');

	  $message = "<h1>Here's a successful email submission.</h1>";
	  $message .= "<ul>";
	  $message .= "<li>NAICS Type:" . $naics . "</li>";
	  $message .= "<li>Other NAICS Type?:" . $naics_other . "</li>";
	  $message .= "<li>Revenue:" . $revenue . "</li>";
	  $message .= "<li>Country:" . $country . "</li>";
	  $message .= "<li>Years in Business:" . $years . "</li>";
	  $message .= "<li>Name: " . $name . "</li>";
	  $message .= "<li>Email: " . $email . "</li>";
	  $message .= "</ul>";

	  //header
      $headers = "MIME-Version: 1.0\r\n"; 
	  $header = "From:gregory.rich@brafton.com \r\n";
      $headers .= "Reply-To: ".$sender_email."" . "\r\n";
      $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 

	  $mailResult = mail( $to, $subject, $message, $header );

	  if ( $mailResult == true ) {
	    echo "Message sent successfully";
	  } else {
	    echo "Message failed to send";
	  }

  }

  else if (!empty($_POST['group-submit'])) {
	  //user posted variables
	  //Prop Form Fields
	  $naics = 			$_POST['message_naics'];
	  $naics_other = 	$_POST['message_other'];
	  $employees = 		$_POST['message_employees'];
	  $country = 		$_POST['message_country'];
	  $years = 			$_POST['message_years'];
	  $name = 			$_POST['message_name'];
	  $email = 			$_POST['message_email'];
	  // Uploads
	  // Uploads
	  $human = 			$_POST['message_human'];

	  //php mailer variables
	  $to = "gregory.rich@brafton.com";
	  $subject = "Group Form Submission from ".get_bloginfo('name');

	  $message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
				  <head><title>Email Sig</title></head><body>';
	  $message = "<h1>Here's a successful email submission.</h1>";
	  $message .= "<ul>";
	  $message .= "<li>NAICS Type:" . $naics . "</li>";
	  $message .= "<li>Other NAICS Type?:" . $naics_other . "</li>";
	  $message .= "<li># of Employees:" . $employees . "</li>";
	  $message .= "<li>Country:" . $country . "</li>";
	  $message .= "<li>Years in Business:" . $years . "</li>";
	  $message .= "<li>Name: " . $name . "</li>";
	  $message .= "<li>Email: " . $email . "</li>";
	  $message .= "</ul>";
	  $message .= "</ul>";
	  $message .= "</body></html>";

	  $header = "From:gregory.rich@brafton.com \r\n";
	  $header .= "MIME-Version: 1.0\r\n";
	  $header .= "Content-type: text/html\r\n";

	  // add attachments
	  $attachment = addAttachment( file_get_contents( $_POST['upload_file'] ), $_POST['multi_file_upload'] );

	  $mailResult = mail( $to, $subject, $message, $header, $attachment );

	  if ( $mailResult == true ) {
	    echo "Message sent successfully";
	  } else {
	    echo "Message failed to send";
	  }

  }

  else if (!empty($_POST['ret-submit'])) {
	  //user posted variables
	  //Prop Form Fields
	  $naics = 			$_POST['message_naics'];
	  $naics_other = 	$_POST['message_other'];
	  $employees = 		$_POST['message_employees'];
	  $assets = 		$_POST['message_assets'];
	  $country = 		$_POST['message_country'];
	  $years = 			$_POST['message_years'];
	  $name = 			$_POST['message_name'];
	  $email = 			$_POST['message_email'];
	  // Uploads
	  // Uploads
	  $human = 			$_POST['message_human'];

	  //php mailer variables
	  $to = "gregory.rich@brafton.com";
	  $subject = "Retirement Form Submission from ".get_bloginfo('name');

	  $message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
				  <head><title>Email Sig</title></head><body>';
	  $message = "<h1>Here's a successful email submission.</h1>";
	  $message .= "<ul>";
	  $message .= "<li>NAICS Type:" . $naics . "</li>";
	  $message .= "<li>Other NAICS Type?:" . $naics_other . "</li>";
	  $message .= "<li># of Employees:" . $employees . "</li>";
	  $message .= "<li>Retirement Plan Assets:" . $assets . "</li>";
	  $message .= "<li>Country:" . $country . "</li>";
	  $message .= "<li>Years in Business:" . $years . "</li>";
	  $message .= "<li>Name: " . $name . "</li>";
	  $message .= "<li>Email: " . $email . "</li>";
	  $message .= "</ul>";
	  $message .= "</body></html>";
	  $message -> isHTML(true);

	  $header = "From:gregory.rich@brafton.com \r\n";
	  $header .= "MIME-Version: 1.0\r\n";
	  $header .= "Content-type: text/html\r\n";

	  $mailResult = mail( $to, $subject, $message, $header );

	  if ( $mailResult == true ) {
	    echo "Message sent successfully";
	  } else {
	    echo "Message failed to send";
	  }

  }

  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name
        //if(empty($name)){
          //my_contact_form_generate_response("error", $missing_content);
        //}
        //else //ready to go!
        //{
          $sent = wp_mail($to, $subject, $message, $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        //}
      }
    }
  }
  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);

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

			<div class="options">
				<div class="text">
					<h2>Get your complimentary and confidential benchmark<br /> report today.Click an icon to get started!</h2>
				</div>

				<div class="option property">
					<div class="inner">
						<div class="thumb" style="background-image: url('<?php echo get_site_url(); ?>/wp-content/uploads/2017/02/Icons_PropertyCasualty2_PropertyCasualty.jpg');"></div>
						<h3>Property/Casualty</h3>
					</div>
				</div>
				<div class="option group">
					<div class="inner">
						<div class="thumb" style="background-image: url('<?php echo get_site_url(); ?>/wp-content/uploads/2017/02/Icons_Group-Benefits.jpg');"></div>
						<h3>Group Benefits</h3>
					</div>
				</div>
				<div class="option retirement">
					<div class="inner">
						<div class="thumb" style="background-image: url('<?php echo get_site_url(); ?>/wp-content/uploads/2017/02/Icons_Retirement.jpg');"></div>
						<h3>Retirement Services</h3>
					</div>
				</div>
			</div>

			<?php include("inc/home-forms.php"); ?>

		</div></div></div><?php if ( $shadow ) { echo '<hr class="shadow"/>'; } ?></section>

		<div class="intro">
			<div class="site-inner">
				<h2>Working Around Your Schedule</h2>
				<p>By outsourcing your procurement process to CMR, CFOs, procurement officers and business owners can access our vast repository of industry information and engage with leading industry thinkers.
				The CMR Database®. By connecting to this new, easy-to-navigate digital platform, you will have the benefit of its continually updated content. This information includes data from thousands of broker/vendor specialists representing 120 countries. Millions of client program features are aggregated and compared in all industry sectors.
				Despite a world of dealing with complex terminology, government protocols, high costs, broker/vendor solicitations,  there is a new and proven alternative option. You now can quickly attain new global benchmarking metrics, expanded market access, more inclusive market intelligence and even insurance for general liability for business. Long term relationships can also be strengthened and enhanced.</p>

				<div class="row">
					<div class="one-third">
					 	<span class="large">Thousands</span><br />
						Brokers & Vendors
					</div>

					<div class="one-third">
						<span class="large">$120,000,000</span><br />
						Savings in Industry Overcharges
					</div>

					<div class="one-third">
						<span class="large">95%</span><br />
						Client Success Rate
					</div>
				</div>

				<p>The largest brokers/vendors only have a fraction of the overall available market. With CMR + PolicySmart®, your market entry points are expanded exponentially beyond the traditional localized effort.</p>
				<p>So far our clients have enjoyed over $120 Million savings in industry overcharges through new and improved plan designs.  This was achieved with an impressive 95 percent success rate.
				What are you waiting for? See how your company could save with our free, no-obligation platform.</p>
				<p class="center"><a class="button" href="#">Start Now</a></p>
			</div>
		</div>

		<?php // queue the services

			$service_array = array('post_type' => 'services', 'posts_per_page' => -1);
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