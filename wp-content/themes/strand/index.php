<?php get_header(); ?>

	<?php get_template_part( 'content', 'slider' ); ?>

	<?php $section_query = new WP_Query('post_type=ptype_sections&orderby=menu_order&order=ASC&posts_per_page=-1'); ?>												
	 <?php while ($section_query->have_posts()) : $section_query->the_post(); 							
		$sectionID = get_post_meta($post->ID, 'ptype_sections_section_id', true);	
		if($sectionID==1) {
			$headingH2 = get_post_meta($post->ID, 'ptype_sections_heading_h2', true);
			$listItemHeadingH3 = get_post_meta($post->ID, 'ptype_sections_list_item_heading_h3', true);
			$listItemParagraphP = get_post_meta($post->ID, 'ptype_sections_list_item_paragraph_p', true);
			$listItem2HeadingH3 = get_post_meta($post->ID, 'ptype_sections_list_item_2_heading_h3', true);
			$listItem2ParagraphP = get_post_meta($post->ID, 'ptype_sections_list_item_2_paragraph_p', true);
			$listItem3HeadingH3 = get_post_meta($post->ID, 'ptype_sections_list_item_3_heading_h3', true);
			$listItem3ParagraphP = get_post_meta($post->ID, 'ptype_sections_list_item_3_paragraph_p', true);						
			$images = rwmb_meta( 'ptype_sections_discover_us_img_1', 'type=image' );
			$discoverUsImgHtml = get_post_meta($post->ID, 'ptype_sections_discover_us_img_html', true);
			$discoverUsImgHtml2 = get_post_meta($post->ID, 'ptype_sections_discover_us_img_html_2', true);
		
			$nearByHeadingH2 = get_post_meta($post->ID, 'ptype_sections_whats_nearby_heading_h2', true);
			$nearByHeadingH3 = get_post_meta($post->ID, 'ptype_sections_whats_nearby_heading_h3', true);
			$event_images = rwmb_meta( 'ptype_sections_whats_nearby_img', 'type=image' );	
			$whatsNearByImgHtml = get_post_meta($post->ID, 'ptype_sections_whats_nearby_img_html', true);
			$whatsNearByImgHtml2 = get_post_meta($post->ID, 'ptype_sections_whats_nearby_img_html_2', true);
			$eventHeadingH4 = get_post_meta($post->ID, 'ptype_sections_event_heading_h4', true);
			$eventHeadingH3 = get_post_meta($post->ID, 'ptype_sections_event_heading_h3', true);
			$listItem1EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_1_event_title', true);								
			$listItem1EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_1_event_date', true);
			$listItem2EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_2_event_title', true);								
			$listItem2EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_2_event_date', true);
			$listItem3EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_3_event_title', true);								
			$listItem3EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_3_event_date', true);
			$listItem4EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_4_event_title', true);								
			$listItem4EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_4_event_date', true);
			$listItem5EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_5_event_title', true);								
			$listItem5EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_5_event_date', true);
			$listItem6EventTitle = get_post_meta($post->ID, 'ptype_sections_list_item_6_event_title', true);								
			$listItem6EventDate= get_post_meta($post->ID, 'ptype_sections_list_item_6_event_date', true);
			$linkText= get_post_meta($post->ID, 'ptype_sections_link_text', true);
			$link= get_post_meta($post->ID, 'ptype_sections_link', true);
		
			$featuredOffersHeadingH2 = get_post_meta($post->ID, 'ptype_sections_featured_offers_heading_h2', true);
			$featuredOffersHeadingH3 = get_post_meta($post->ID, 'ptype_sections_featured_offers_heading_h3', true);
			$deal1Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_sections_deal_1_img', true), 'full');
			$deal1ImgHtml = get_post_meta($post->ID, 'ptype_sections_deal_1_img_html', true);
			$deal2Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_sections_deal_2_img', true), 'full');
			$deal2ImgHtml = get_post_meta($post->ID, 'ptype_sections_deal_2_img_html', true);
			$deal3Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_sections_deal_3_img', true), 'full');
			$deal3ImgHtml = get_post_meta($post->ID, 'ptype_sections_deal_3_img_html', true);
		
			$classicHotelHeadingH2 = get_post_meta($post->ID, 'ptype_sections_classic_hotel_heading_h2', true);
			$classicHotelHeadingH3 = get_post_meta($post->ID, 'ptype_sections_classic_hotel_heading_h3', true);
			$classicHotelParagraphP = get_post_meta($post->ID, 'ptype_sections_classic_hotel_paragraph_p', true);
			$classicHotelLinkText = get_post_meta($post->ID, 'ptype_sections_classic_hotel_link_text', true);
			$classicHotelLink = get_post_meta($post->ID, 'ptype_sections_classic_hotel_link', true);
			$classicHotelBg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_sections_classic_hotel_bg', true), 'full');			
		}
	?>
	<?php endwhile; ?>

	<div id="content-wrapper" class="home">

		<div class="discover-us">
			<div class="container">
				<div class="row">
					<div class="col-md-12">						
						<div class="text-content">
							
							<h3>DISCOVER US</h3>
							<h2><?php echo $headingH2; ?></h2>
							<hr class="small">
							<ul>
								<li>
									<span class="circle">01</span>
									<div class="text">
										<h3><?php echo $listItemHeadingH3; ?></h3>
										<p><?php echo $listItemParagraphP; ?></p>
									</div>
								</li>
								<li>
									<span class="circle">02</span>
									<div class="text">
										<h3><?php echo $listItem2HeadingH3; ?></h3>
										<p><?php echo $listItem2ParagraphP; ?></p>
									</div>
								</li>
								<li>
									<span class="circle">03</span>
									<div class="text">
										<h3><?php echo $listItem3HeadingH3; ?></h3>
										<p><?php echo $listItem3ParagraphP; ?></p>
									</div>
								</li>
							</ul>
						</div>
						<div class="img-content">
							<div id='masonry'>
								<?php
									$i = 0;
									foreach ( $images as $image )
									{
										if($i==0) echo "<div class='mansonry-item'>
															{$discoverUsImgHtml}
														</div>";

										else if($i==2) echo "<div class='mansonry-item large'><img src='".get_home_url().'/timthumb.php?src='.$image['full_url']."&h=325&w=215&zc=0'></div>";	
										else if($i==3) echo "<div class='mansonry-item medium'><img src='".get_home_url().'/timthumb.php?src='.$image['full_url']."&h=160&w=435&zc=0'></div>";	
										else if($i==6) echo "<div class='mansonry-item'>
																{$discoverUsImgHtml2}
															</div>";	
										else echo "<div class='mansonry-item'><img src='".get_home_url().'/timthumb.php?src='.$image['full_url']."&h=160&w=215&zc=0'></div>";
										$i++;
									}
								?>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="whats-new">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="heading">
							<h3><?php echo $nearByHeadingH3; ?></h3>
							<h2><?php echo $nearByHeadingH2; ?></h2>
							<hr class="small">
						</div>
						
						<div id="masonry-2" class="img-content">
							<div class='mansonry-2-item thumb'><?php echo $whatsNearByImgHtml; ?></div>
							<?php
								$i = 0;
								foreach ( $event_images as $event_image )
								{

									if($i==0) echo "<div class='mansonry-2-item x-large'><img src='".get_home_url().'/timthumb.php?src='.$event_image['full_url']."&h=460&w=290&zc=0'></div>";	
									elseif($i==1) echo "<div class='mansonry-2-item medium'><img src='".get_home_url().'/timthumb.php?src='.$event_image['full_url']."&h=190&w=285&zc=0'></div>";
									elseif($i==2) echo "<div class='mansonry-2-item small'><img src='".get_home_url().'/timthumb.php?src='.$event_image['full_url']."&h=190&w=190&zc=0'></div>";	
									else echo "<div class='mansonry-2-item large'>
													{$whatsNearByImgHtml2}
												</div>
												<div class='mansonry-2-item'><img src='".get_home_url().'/timthumb.php?src='.$event_image['full_url']."&h=140&w=190&zc=0'></div>";
									$i++;
								}
							?>									 						
						</div>

						<div class="whats-on">
							<h4><?php echo $eventHeadingH4; ?></h4>
							<h3><?php echo $eventHeadingH3; ?></h3>
							<hr class="small"></hr>

							<?php get_template_part( 'content', 'event' ); ?>

							<div class="clearfix"></div>

							<a href="<?php echo $link; ?>" class="learn-more"><?php echo $linkText; ?> <i class="fa fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="featured-offers">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="heading">
							<h3><?php echo $featuredOffersHeadingH3; ?></h3>
							<h2><?php echo $featuredOffersHeadingH2; ?></h2>
							<hr class="small">
						</div>

						<div class="deals">							
							<div class="each-deal">
								<img src="<?php echo get_home_url().'/timthumb.php?src='.$deal1Img[0].'&h=280&w=370&zc=0'; ?>">
								<div class="deal-info">
									<?php echo $deal1ImgHtml; ?>
								</div>
							</div>
							<div class="each-deal">
								<img src="<?php echo get_home_url().'/timthumb.php?src='.$deal2Img[0].'&h=280&w=370&zc=0'; ?>">
								<div class="deal-info">
									<?php echo $deal2ImgHtml; ?>
								</div>
							</div>
							<div class="each-deal">
								<img src="<?php echo get_home_url().'/timthumb.php?src='.$deal3Img[0].'&h=280&w=370&zc=0'; ?>">
								<div class="deal-info">
									<?php echo $deal3ImgHtml; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="classic-hotel" style="background-image:url('<?php echo $classicHotelBg[0]; ?>');">
			<div class="caption">
				<div class="caption-text">					
					<h3><?php echo $classicHotelHeadingH3; ?></h3>
					<h2><?php echo $classicHotelHeadingH2; ?></h2>
					<hr class="small"></hr>
					<p><?php echo $classicHotelParagraphP; ?></p>
					<a href="<?php echo $classicHotelLink; ?>"><?php echo $classicHotelLinkText; ?> <i class="fa fa-chevron-circle-right"></i></a>
				</div>
			</div>
		</div>

		<div class="trip-advisor">
			<a href="http://www.tripadvisor.com.sg/Hotel_Review-g294265-d338340-Reviews-Strand_Hotel-Singapore.html" target="_blank"><img src="<?php echo IMG; ?>/logo/tripadvisor.png"></a>
		</div>

	</div>

<?php get_footer(); ?>