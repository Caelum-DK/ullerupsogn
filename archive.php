<?php get_header(); ?>

		<!-- Row for main content area -->
		<div class="page-title">
			<h1>
				<?php if (is_day()) : ?>
					<?php printf(__('Arkiv for %s', 'reverie'), get_the_date()); ?>
				<?php elseif (is_month()) : ?>
					<?php printf(__('Arkiv for %s', 'reverie'), get_the_date('F Y')); ?>
				<?php elseif (is_year()) : ?>
					<?php printf(__('Arkiv for %s', 'reverie'), get_the_date('Y')); ?>
				<?php else : ?>
					<?php single_cat_title(); ?>
				<?php endif; ?>
			</h1>
			<div id="breadcrumbs">
				<ul>
					<li class="breadcrumb-item"><a href="<?php bloginfo('home'); ?>">Ullerup Sogn</a></li>
					<li class="breadcrumb-item spacer"><?php the_category('') ?></li>
				</ul>
			</div>
			
		</div>
		<div id="content" class="nine columns">
	
			<div class="post-box">				
				<?php get_template_part('loop', 'category'); ?>
			</div>

		</div><!-- End Content row -->
		
		<aside id="sidebar" class="three columns">
			<div class="sidebar-box">
				<?php dynamic_sidebar("Blog-sidebar"); ?>
			</div>
		</aside><!-- /#sidebar -->
		
<?php get_footer(); ?>