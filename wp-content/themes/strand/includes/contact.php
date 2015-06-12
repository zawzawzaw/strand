<?php 
  $section_query = new WP_Query('post_type=ptype_contacts&orderby=menu_order&order=ASC&posts_per_page=-1');

  while ($section_query->have_posts()) : $section_query->the_post();   	
      
      $firstContentHeadingH2 = get_post_meta($post->ID, 'ptype_contacts_heading_h2', true);
      $firstContentHeadingH3 = get_post_meta($post->ID, 'ptype_contacts_heading_h3', true);
      $firstContentParagraphHTML = get_post_meta($post->ID, 'ptype_contacts_heading_paragraph_html', true);
      
      $firstContentHeading1h5 = get_post_meta($post->ID, 'ptype_contacts_heading_1_h5', true);
      $firstContentHeading1HTML = get_post_meta($post->ID, 'ptype_contacts_heading_1_paragraph_html', true);

      $firstContentHeading2h5 = get_post_meta($post->ID, 'ptype_contacts_heading_2_h5', true);
      $firstContentHeading2HTML = get_post_meta($post->ID, 'ptype_contacts_heading_2_paragraph_html', true);

      $firstContentHeading3h5 = get_post_meta($post->ID, 'ptype_contacts_heading_3_h5', true);
      $firstContentHeading3HTML = get_post_meta($post->ID, 'ptype_contacts_heading_3_paragraph_html', true);

      $firstContentHeading4h5 = get_post_meta($post->ID, 'ptype_contacts_heading_4_h5', true);
      $firstContentHeading4HTML = get_post_meta($post->ID, 'ptype_contacts_heading_4_paragraph_html', true);

      $firstContentHeading5h5 = get_post_meta($post->ID, 'ptype_contacts_heading_5_h5', true);
      $firstContentHeading5HTML = get_post_meta($post->ID, 'ptype_contacts_heading_5_paragraph_html', true);

      $firstContentHeading6h5 = get_post_meta($post->ID, 'ptype_contacts_heading_6_h5', true);
      $firstContentHeading6HTML = get_post_meta($post->ID, 'ptype_contacts_heading_6_paragraph_html', true);

  endwhile; 
?>

<div class="first-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h3><?php echo $firstContentHeadingH3; ?></h3>
					<h2><?php echo $firstContentHeadingH2; ?></h2>
					<hr class="small">
					<?php echo $firstContentParagraphHTML; ?>
				</div>		

				<div id="google-map-canvas" class="map"></div>	
			</div>
		</div>
	</div>
</div>

<div class="last-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="center-content">
					<div class="heading">
						<h2>Get in Touch</h2>
						<hr class="small">
					</div>
					
					<div class="contact-form">
						<?php echo do_shortcode( '[contact-form-7 id="211" title="Contact form 1"]' ) ?>						
					</div>
					
					<div class="contact-info">
						<div class="each-info">
							<h5><?php echo $firstContentHeading1h5; ?></h5>
							<?php echo $firstContentHeading1HTML; ?>
						</div>
						
						<div class="each-info">
							<h5><?php echo $firstContentHeading2h5; ?></h5>
							<?php echo $firstContentHeading2HTML; ?>
						</div>
						
						<div class="each-info">
							<h5><?php echo $firstContentHeading3h5; ?></h5>
							<?php echo $firstContentHeading3HTML; ?>
						</div>
						
						<div class="each-info">
							<h5><?php echo $firstContentHeading4h5; ?></h5>
							<?php echo $firstContentHeading4HTML; ?>
						</div>
						
						<div class="each-info">
							<h5><?php echo $firstContentHeading5h5; ?></h5>
							<?php echo $firstContentHeading5HTML; ?>
						</div>

						<div class="each-info">
							<h5><?php echo $firstContentHeading6h5; ?></h5>
							<?php echo $firstContentHeading6HTML; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>