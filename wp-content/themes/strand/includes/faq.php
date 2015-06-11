<?php 
	global $post;
  	$current_question_type = get_the_title();
  	$current_slug = basename(get_permalink(get_page_by_title($current_question_type)));

	$section_query = new WP_Query('post_type=ptype_faqs&orderby=menu_order&order=ASC&posts_per_page=-1');
  	$i=1;
?>
<div class="first-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="side-menu">
				<?php
					$args         = array(				      
				      'orderby'  => 'count',
				      'order'    => 'DESC'
				  	);
					$terms = get_terms('questiontype', $args);

				  	foreach($terms as $term):
				?>
					<ul>
						<li><a href="<?php echo get_permalink(get_page_by_title( 'Faqs' )) . $term->slug; ?>" <?php if($term->slug==$current_slug): ?>class="active"<?php endif; ?>><?php echo $term->name; ?></a></li>						
					</ul>
				<?php 
					endforeach;
				?>
				</div>
				<div class="info-content">
					<h5><?php echo $current_question_type; ?></h5>
					<hr class="small">	
					<?php
					  	while ($section_query->have_posts()) : $section_query->the_post();
					        $terms = wp_get_post_terms( $post->ID, 'questiontype' );
					        $question_type_slug = $terms[0]->slug;

					        if($current_slug===$question_type_slug):
					        	$question = get_post_meta($post->ID, 'ptype_faqs_question', true);
					    		$answer = get_post_meta($post->ID, 'ptype_faqs_answer', true);
					?>
								<ul>
									<li><?php echo $question; ?></li>
									<li><p><?php echo $answer; ?></p></li>
								</ul>
					<?php
					        endif;
					    endwhile;
					?>														
				</div>
			</div>
		</div>
	</div>
</div>


				
