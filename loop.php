<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
	<div class="notice">
		<p class="bottom"><?php _e('Sorry, no results were found.', 'reverie'); ?></p>
	</div>
	<?php get_search_form(); ?>	
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		 <?php if ( has_post_thumbnail()) : ?>
			   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			   <?php the_post_thumbnail('thumbnail', array('class' => 'front_thumbnail')); ?>
			   </a>
		 <?php endif; ?>
		<header>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="post_meta_info"><?php reverie_entry_meta(); ?></div>
		</header>
		<div class="entry-content">			
	<?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
		<?php the_excerpt(); ?>
	<?php else : ?>
		<?php the_excerpt(); ?>
		<p><a href="<?php the_permalink(); ?>">Læs hele indlæget »</a></p>
	<?php endif; ?>
		</div>
		<footer>
			<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
		</footer>
		
	</article>	
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } else if ( is_paged() ) { ?>
<nav id="post-nav">
	<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'reverie' ) ); ?></div>
	<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'reverie' ) ); ?></div>
</nav>
<?php } ?>