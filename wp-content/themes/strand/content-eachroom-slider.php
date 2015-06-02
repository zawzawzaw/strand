<?php 
$args = array(
	'post_type' => 'eachroomslider',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'date', 
	'order' => 'ASC'								
);
$query1 = new WP_Query( $args );
$i = 1;	
?>
<div id="rooms-carousel" class="rooms-img-slider carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		<?php
			while ( $query1->have_posts() ) : $query1->the_post(); ?>
				<?php 
					$slider_terms = wp_get_post_terms( $post->ID, 'type' ); 
					$slider_room_type = mb_strtolower($slider_terms[0]->name);
				?>				
				<?php if($slider_room_type==$current_room_type): ?>
					<?php if(has_post_thumbnail()) : ?>
						<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>						
						<div class="item <?php echo ($i==1) ? 'active' : ''; ?>">
							<img src="<?php echo $url; ?>" alt="Deluxe Room Slider <?php echo $i; ?>">
							<div class="carousel-caption">
								<?php the_content(); ?>
							</div>
						</div>
						<?php $i++; ?>		
					<?php endif; ?>	
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