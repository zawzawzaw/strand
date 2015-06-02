<div id="rooms-carousel" class="rooms-img-slider carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
	<?php
		$args = array(
			'post_type' => 'roomslider',
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
				<div class="item <?php echo ($i==1) ? 'active' : ''; ?>">
					<img src="<?php echo $url; ?>" alt="Rooms Slider 1">
					<div class="carousel-caption">
						<?php the_content(); ?>
					</div>
				</div>
				<?php $i++; ?>		
			<?php endif; ?>	
		<?php endwhile; ?>	
	</div>
	<!-- Controls -->
	<a class="left carousel-control" href="#rooms-carousel" role="button" data-slide="prev">
		<span class="left-slider-arrow" aria-hidden="true"></span>
	</a>
	<a class="right carousel-control" href="#rooms-carousel" role="button" data-slide="next">
		<span class="right-slider-arrow" aria-hidden="true"></span>
	</a>
</div>