<?php 
  global $post;
  $current_room_title = get_the_title();

  $section_query = new WP_Query('post_type=ptype_room_types&orderby=menu_order&order=ASC&posts_per_page=-1');
  $i=1;

  while ($section_query->have_posts()) : $section_query->the_post(); 
	$this_room_type_title = get_the_title();
	
	if($current_room_title==$this_room_type_title):

		$post_id = $post->ID;

		$terms = wp_get_post_terms( $post->ID, 'roomtype' );
		$current_room_type = mb_strtolower($terms[0]->name); 

		$headingH2 = get_post_meta($post->ID, 'ptype_room_types_heading_h2', true);
		$headingH3 = get_post_meta($post->ID, 'ptype_room_types_heading_h3', true);
		$headingParagraphHTML = get_post_meta($post->ID, 'ptype_room_types_heading_paragraph_html', true);

		$checkAvailabilityH4 = get_post_meta($post->ID, 'ptype_room_types_check_availability_h4', true);	
		$checkAvailabilityH3 = get_post_meta($post->ID, 'ptype_room_types_check_availability_h3', true);	
		$checkAvailabilityP = get_post_meta($post->ID, 'ptype_room_types_room_rate_p', true);	

		$roomInfoHeadingH3 = get_post_meta($post->ID, 'ptype_room_types_room_info_heading_h3', true);	
		$roomInfoContentHTML = get_post_meta($post->ID, 'ptype_room_types_room_info_content_HTML', true);	

		$roomFeatureHeadingH3 = get_post_meta($post->ID, 'ptype_room_types_room_feature_heading_h3', true);	
		$roomFeatureImages = rwmb_meta( 'ptype_room_types_room_feature_images', 'type=image' );  
		$roomFeatureImagesCaption = get_post_meta($post->ID, 'ptype_room_types_room_feature_images_caption', true);	

		$roomFeatureDetailHeadingH3 = get_post_meta($post->ID, 'ptype_room_types_room_feature_detail_heading_h3', true);	

	endif;

	$i++;
  endwhile; 
?>
<div class="rooms-suites">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h3><?php echo $headingH3; ?></h3>
					<h2><?php echo $headingH2; ?></h2>
					<hr class="small">
					<p><?php echo $headingParagraphHTML; ?></p>
				</div>

				<?php include(locate_template('content-eachroom-slider.php')); ?>

				<div class="second-content">
					<div class="check-availability-container">
						<h4><?php echo $checkAvailabilityH4; ?></h4>
						<h3><?php echo $checkAvailabilityH3; ?></h3>
						<hr class="small"></hr>
						<fieldset class="arrival">
						    <legend class="arrival">ARRIVAL</legend>
						    <input type="text" id="arrival-datepicker">
						    <a href="#" class="select-date">Select a date</a>
						    <div class="selected-date">
							    <span class="month">April</span>
							    <span class="day">21</span>
						    </div>
						</fieldset>
						<fieldset class="departure">
						    <legend class="departure">DEPARTURE</legend>
						    <input type="text" id="departure-datepicker">
						    <a href="#" class="select-date">Select a date</a>
						    <div class="selected-date">
							    <span class="month">April</span>
							    <span class="day">23</span>
						    </div>
						</fieldset>

						<p><?php echo $checkAvailabilityP; ?></p>

						<a href="#" class="room-page-check-availability">CHECK AVAILABILITY</a>
					</div>

					<div class="deluxe-room-info">
						<h3><?php echo $roomInfoHeadingH3; ?></h3>
						<hr class="small"></hr>

						<?php echo $roomInfoContentHTML; ?>

						<div class="clearfix"></div>
					</div>
				</div>

				<div class="third-content">
					<h3><?php echo $roomFeatureHeadingH3; ?></h3>
					<hr class="small"></hr>

					<div class="deluxe-features">
						<div class="img-content">
							<div id="rooms-masonry" class="img-content">
								<?php
				                  $i = 0;
				                  foreach ( $roomFeatureImages as $roomFeatureImage )
				                  {				                  	
				                    if($i==0) echo "<div class='rooms-masonry-item large'><img src='".get_home_url().'/timthumb.php?src='.$roomFeatureImage['full_url']."&h=350&w=240&zc=0'></div>"; 					                    
				                    else echo "<div class='rooms-masonry-item'><img src='".get_home_url().'/timthumb.php?src='.$roomFeatureImage['full_url']."&h=170&w=250&zc=0'></div>";                     
				                    $i++;
				                  }
				                ?>									
							</div>
							<p><?php echo $roomFeatureImagesCaption; ?></p>
						</div>
						<div class="feature-details">
							<h3><?php echo $roomFeatureDetailHeadingH3; ?></h3>
							
							<?php include(locate_template('content-feature.php')); ?>								
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>