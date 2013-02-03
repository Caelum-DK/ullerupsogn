<?php
/*
Template Name: Standard u. billede
*/
get_header(); ?>

		<!-- Row for main content area -->
		<div class="page-title">
			<h1><?php the_title(); ?></h1>
			<div id="breadcrumbs">
				<ul>
					<?php get_breadcrumbs(); ?>
				</ul>
			</div>
			
		</div>

		<div id="content" class="nine columns">
			
			<div class="post-box">
				<?php get_template_part('loop', 'page'); ?>
			</div>

		</div><!-- End Content row -->
		
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>