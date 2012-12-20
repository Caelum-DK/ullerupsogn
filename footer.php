		</section><!-- End Main Section -->

		<section id="sidebar-off" role="complementary">
			<nav id="sideMenu" role="navigation">
		    	<?php
		    		if ( has_nav_menu( 'primary_navigation' ) ):
		    	    	wp_nav_menu( array(
		    				'theme_location' => 'primary_navigation',
		    				'container' =>false,
		    				'menu_class' => '',
		    				'echo' => true,
		    				'before' => '',
		    				'after' => '',
		    				'link_before' => '',
		    				'link_after' => '',
		    				'depth' => 0,
		    				'items_wrap' => '<ul class="nav-bar">%3$s</ul>',
		    				'walker' => new reverie_walker())
		    			);
		    		endif;
		    		?>											
		   	</nav>
		</section>
		
		</div><!-- End Off-Canvas Row -->
		
		<footer id="contact_info" role="contentinfo">
			<div class="row">
				<?php dynamic_sidebar("Footer"); ?>
			</div>
			
		</footer>
			
	</div><!-- Container End -->
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	     chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	
	<?php wp_footer(); ?>
</body>
</html>