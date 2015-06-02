<?php
$args = array(
	'post_type' => 'feature',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'ASC'							
);
$query1 = new WP_Query( $args );
$i = 1;		
?>
<div class="panel-group <?php echo $current_room_type; ?>" id="accordion" role="tablist" aria-multiselectable="true">
<?php while ( $query1->have_posts() ) : $query1->the_post(); ?>	
	<?php 
		$feature_terms = wp_get_post_terms( $post->ID, 'feature_room_type' );

		foreach ($feature_terms as $key => $feature_term):
			if(mb_strtolower($feature_term->name)==$current_room_type): ?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
				  	<h4 class="panel-title"><?php the_title(); ?></h4>
				  	<a class="view-details" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">VIEW DETAILS <i class="fa fa-angle-right"></i></a>
				</div>
				<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
	<?php 
			endif;
		endforeach;	
	?>	
  <?php $i++; ?>	
<?php endwhile; ?>  
</div>