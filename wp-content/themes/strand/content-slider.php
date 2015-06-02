<div id="carousel" class="slider-wrapper carousel slide" data-ride="carousel">
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php
		$args = array(
			'post_type' => 'homeslider',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'date', 
			'order' => 'ASC'								
		);
		$query1 = new WP_Query( $args );
		$i = 1;		

		while ( $query1->have_posts() ) : $query1->the_post(); ?>
				<?php if(has_post_thumbnail()) : ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<div class="item bg <?php echo "bg".$i; ?> <?php echo ($i==1) ? 'active' : ''; ?>" style="background-image:url('<?php echo $url; ?>');">			
						<div class="carousel-caption">
							<div class="caption-text">								
								<?php the_content(); ?>
							</div>				
						</div>	
						<div class="item-cta">
							<img src="<?php echo IMG; ?>/icons/post-icon.png"><a href="#">SHARE AS A POSTCARD</a>
						</div>
					</div>
					<?php $i++; ?>		
				<?php endif; ?>	
		<?php endwhile; ?>		
	</div>

	<!-- Indicators -->
	  <ol class="carousel-indicators">
		  	<?php $i = 0;
			if ( $query1->have_posts() ) while ( $query1->have_posts() ) : $query1->the_post(); ?>
				<?php if(has_post_thumbnail()) : ?>
					<li data-target="#carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0) ? 'active' : ''; ?>"></li>
					<?php $i++; ?>		
				<?php endif; ?>	
			<?php endwhile; ?>	    
	  </ol>
</div>