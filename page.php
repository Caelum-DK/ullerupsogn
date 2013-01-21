<?php get_header(); ?>

		<!-- Row for main content area -->
		<div class="page-title">
			<h1><?php the_title(); ?></h1>
			<h2><?php get_breadcrumbs(); ?></h2>
		</div>

		<div id="content" class="nine columns">
			
			<div class="page_thumbnail">

				<?php
					// The header image
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
							$image[1] >= $header_image_width ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'full' );
					else :
						// Compatibility with versions of WordPress prior to 3.4.
						if ( function_exists( 'get_custom_header' ) ) {
							$header_image_width  = get_custom_header()->width;
							$header_image_height = get_custom_header()->height;
						} else {
							$header_image_width  = HEADER_IMAGE_WIDTH;
							$header_image_height = HEADER_IMAGE_HEIGHT;
						}
						?>
					<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
				<?php endif; // end check for featured image or standard header ?>


			</div>
			<div class="post-box">
				<?php get_template_part('loop', 'page'); ?>
			</div>

		</div><!-- End Content row -->
		
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>