<?php get_header(); ?>
		
		<div id="header_img">
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
		</div>
		<hr />
		<!-- Row for main content area -->
		<div id="content" class="nine columns">
			<h2>Seneste nyt fra Ullerup Sogn</h2>
			<div class="post-box">
				<?php get_template_part('loop', 'index'); ?>
			</div>

		</div><!-- End Content row -->
		
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>