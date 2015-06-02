<?php
$args = array(
	'post_type' => 'ptype_events',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'ASC'							
);
$query1 = new WP_Query( $args );
$i = 1;		
?>
<ul>
<?php
while ( $query1->have_posts() ) : $query1->the_post(); ?>			
	<li><i class="fa fa-angle-right"></i><h5><?php the_title(); ?></h5><?php the_content(); ?><?php if($i==1) echo '<div class="clearfix"></div>'; ?></li>		
	<?php $i++; ?>	
<?php endwhile; ?>	
</ul>
