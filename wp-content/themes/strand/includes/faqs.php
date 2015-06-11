<?php 
  global $post;

  $pageOtherPlaceHeadlineH3 = get_post_meta($post->ID, 'page_other_place_headline_H3', true);
  $pageOtherPlaceHeadlineH2 = get_post_meta($post->ID, 'page_other_place_headline_H2', true);

  $section_query = new WP_Query('post_type=ptype_faqs&orderby=menu_order&order=ASC&posts_per_page=-1');    
?>
<div class="first-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h3><?php echo $pageOtherPlaceHeadlineH3; ?></h3>
					<h2><?php echo $pageOtherPlaceHeadlineH2; ?></h2>
					<hr class="small">							
				</div>

				<div class="questions">				
					<?php 
			      	$i=1;
			      	while ($section_query->have_posts()) : $section_query->the_post();
				        $terms = wp_get_post_terms( $post->ID, 'questiontype' );
				        $question_type = ucfirst($terms[0]->name); 				   
				        
				        if(!isset($current_question_type) || $current_question_type==$question_type):
				        	$current_question_type = $question_type;
    				        $question = get_post_meta($post->ID, 'ptype_faqs_question', true);
    				        $answer = get_post_meta($post->ID, 'ptype_faqs_answer', true);
    				        $link = get_permalink(get_page_by_title( 'Faqs' )) . $terms[0]->slug;
				        	if($i==1): ?>
							<div class="each-question">
								<h5><?php echo $current_question_type; ?></h5>
								<hr class="small">								
								<ul>
				    <?php
				        	endif;
				        	
    				?>			    						
									<li><?php echo $question; ?></li>																			
				  	<?php
			  				$i++;
				  		else:				  			
				  			$current_question_type = $question_type;
				  			$question = get_post_meta($post->ID, 'ptype_faqs_question', true);
    				        $answer = get_post_meta($post->ID, 'ptype_faqs_answer', true);
				  	?>				  					
				  				</ul>
				  				<a href="<?php echo $link; ?>" class="see-more-questions">SEE MORE QUESTIONS <i class="fa fa-chevron-circle-right"></i></a>
							</div>
							<div class="each-question">
								<h5><?php echo $current_question_type; ?></h5>
								<hr class="small">
								<ul>					
									<li><?php echo $question; ?></li>	
					<?php
				  		endif;
				  	endwhile; ?>
				  	<a href="<?php echo $link; ?>" class="see-more-questions">SEE MORE QUESTIONS <i class="fa fa-chevron-circle-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>