<?php 
	$page_info = get_page_by_title( 'Offices' );
?>
		<div class="push"></div>
  </div><!-- end wrap div -->
  <footer class="footer">
		<div class="container">
			<div class="row">
				<div class="span3">
					<p>Copyright &copy; <?php echo date('Y'); ?> <?php echo bloginfo('name'); ?>. <br>
						All Rights Reserved.</p>
					<ul>
						<li><a href="<?php $this_page_info = get_page_by_title('Terms of use'); echo get_permalink($this_page_info->ID); ?>">Terms of use</a></li>
						<li><a href="<?php $this_page_info = get_page_by_title('Privacy Policy'); echo get_permalink($this_page_info->ID); ?>">Privacy Policy</a></li>
					</ul>
				</div>

				<?php
				$args = array(
					'post_type' => 'page',
					'post_parent' => $page_info->ID,
					'orderby' => 'ID',
					'order' => 'ASC'
				);
				$child_page_query = new WP_Query( $args );
				?>
				<?php if ( $child_page_query->have_posts() ) while ( $child_page_query->have_posts() ) : $child_page_query->the_post(); ?>
					<div class="span3">
						<p><strong><?php the_title(); ?></strong><br>
						<?php the_excerpt(); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>