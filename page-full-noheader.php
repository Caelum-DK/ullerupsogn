<?php
/*
Template Name: Fuld bredde uden billede
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

		<div id="content" class="twelve columns">
			
			<div class="post-box">
				<?php get_template_part('loop', 'page'); ?>
			</div>

		</div><!-- End Content row -->
		
		
<?php get_footer(); ?>