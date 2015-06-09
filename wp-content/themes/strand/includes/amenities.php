<?php 
  $section_query = new WP_Query('post_type=ptype_amenities&orderby=menu_order&order=ASC&posts_per_page=-1');

  while ($section_query->have_posts()) : $section_query->the_post();   	
      
      $firstContentHeadingH2 = get_post_meta($post->ID, 'ptype_amenities_dinning_heading_h2', true);
      $firstContentHeadingH3 = get_post_meta($post->ID, 'ptype_amenities_dinning_heading_h3', true);
      $firstContentHeadingH5 = get_post_meta($post->ID, 'ptype_amenities_dinning_heading_h5', true);
      $firstContentParagraphHTML = get_post_meta($post->ID, 'ptype_amenities_dinning_paragraph_html', true);
      $firstContentImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_amenities_dinning_img', true), 'full');

      $firstContentExtraImages = rwmb_meta( 'ptype_amenities_dinning_extra_img', 'type=image' );
      $firstContentExtra1Headingh5 = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_1_heading_h5', true);
      $firstContentExtra1HTML = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_1_html', true);

      $firstContentExtra2Headingh5 = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_2_heading_h5', true);
      $firstContentExtra2HTML = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_2_html', true);

      $firstContentExtra3Headingh5 = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_3_heading_h5', true);
      $firstContentExtra3HTML = get_post_meta($post->ID, 'ptype_amenities_dinning_extra_3_html', true);

      $secondContentImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_amenities_second_section_img', true), 'full');      
      $secondContentHeadingH2 = get_post_meta($post->ID, 'ptype_amenities_second_section_heading_h2', true);
      $secondContentHeadingH3 = get_post_meta($post->ID, 'ptype_amenities_second_section_heading_h3', true);
      $secondContentHeadingH5 = get_post_meta($post->ID, 'ptype_amenities_second_section_heading_h5', true);
      $secondContentParagraphHTML = get_post_meta($post->ID, 'ptype_amenities_second_section_paragraph_HTML', true);

      $thirdContentHeadingH2 = get_post_meta($post->ID, 'ptype_amenities_third_content_heading_h2', true);
      $thirdContentHeadingH3 = get_post_meta($post->ID, 'ptype_amenities_third_content_heading_h3', true);
      $thirdContentHeadingH5 = get_post_meta($post->ID, 'ptype_amenities_third_content_heading_h5', true);
      $thirdContentParagraphHTML = get_post_meta($post->ID, 'ptype_amenities_third_content_paragraph_html', true);
      $thirdContentImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_amenities_third_content_img', true), 'full');

      $thirdContentExtraImages = rwmb_meta( 'ptype_amenities_third_content_extra_img', 'type=image' );
      $thirdContentExtraHeadingh5 = get_post_meta($post->ID, 'ptype_amenities_third_content_extra_heading_h5', true);
      $thirdContentExtraHTML = get_post_meta($post->ID, 'ptype_amenities_third_content_extra_html', true);
      $thirdContentExtraImgHTML = get_post_meta($post->ID, 'ptype_amenities_third_content_extra_img_html', true);

  endwhile; 
?>
<div class="first-content">
      <div class="container">
            <div class="content-section">
                  <div class="row actual-content">
                        <div class="col-md-12">                                     
                              <div class="text-content">
                                    <h3><?php echo $firstContentHeadingH3; ?></h3>
                                    <h2><?php echo $firstContentHeadingH2; ?></h2>
                                    <hr class="small">
                                    <h5><?php echo $firstContentHeadingH5; ?></h5>
                                    <?php echo $firstContentParagraphHTML; ?>
                              </div>
                              <div class="img-content">
                                    <img src="<?php echo get_home_url().'/timthumb.php?src='.$firstContentImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $firstContentHeadingH3; ?>">
                              </div>
                        </div>
                  </div>
                  <div class="row extra-content">
                        <div class="col-md-12">
                              <div class="img-content">
                                    <?php 
                                    foreach ($firstContentExtraImages as $key => $firstContentExtraImage):
                                    ?>
                                          <img src="<?php echo get_home_url().'/timthumb.php?src='.$firstContentExtraImage['full_url'].'&h=280&w=310&zc=0'; ?>" alt="<?php echo $firstContentHeadingH3; ?>">
                                    <?php                                          
                                    endforeach;
                                    ?>
                              </div>
                              <div class="text-content">
                                    <div class="child-text-content">
                                          <h5><?php echo $firstContentExtra1Headingh5; ?></h5>
                                          <hr class="small">
                                          <?php echo $firstContentExtra1HTML; ?>
                                    </div>
                                    
                                    <div class="child-text-content">
                                          <h5><?php echo $firstContentExtra2Headingh5; ?></h5>
                                          <hr class="small">
                                          <?php echo $firstContentExtra2HTML; ?>
                                    </div>
                                    
                                    <div class="child-text-content">
                                          <h5><?php echo $firstContentExtra3Headingh5; ?></h5>
                                          <hr class="small">
                                          <?php echo $firstContentExtra3HTML; ?>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>

<div class="accomodation">
      <div class="container">
            <div class="row">
                  <div class="col-md-12">
                        <div class="img-content">
                              <img src="<?php echo get_home_url().'/timthumb.php?src='.$secondContentImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $secondContentHeadingH3; ?>">
                        </div>
                        <div class="text-content">
                              <h3><?php echo $secondContentHeadingH3; ?></h3>
                              <h2><?php echo $secondContentHeadingH2; ?></h2>
                              <hr class="small">
                              <h5><?php echo $secondContentHeadingH5; ?></h5>
                              <?php echo $secondContentParagraphHTML; ?>
                        </div>                                    
                  </div>
            </div>
      </div>
</div>

<div class="last-content">
      <div class="container">
            <div class="content-section">
                  <div class="row actual-content">
                        <div class="col-md-12">                                     
                              <div class="text-content">
                                    <h3><?php echo $thirdContentHeadingH3; ?></h3>
                                    <h2><?php echo $thirdContentHeadingH2; ?></h2>
                                    <hr class="small">
                                    <h5><?php echo $thirdContentHeadingH5; ?></h5>
                                    <?php echo $thirdContentParagraphHTML; ?>                                    
                              </div>
                              <div class="img-content">
                                    <img src="<?php echo get_home_url().'/timthumb.php?src='.$thirdContentImg[0].'&h=420&w=680&zc=0'; ?>" alt="<?php echo $thirdContentHeadingH3; ?>">
                              </div>
                        </div>
                  </div>
                  <div class="row extra-content">
                        <div class="col-md-12">
                              <div class="img-content">
                                    <?php 
                                    foreach ($thirdContentExtraImages as $key => $thirdContentExtraImage):
                                    ?>
                                          <img src="<?php echo get_home_url().'/timthumb.php?src='.$thirdContentExtraImage['full_url'].'&h=272&zc=0'; ?>" alt="<?php echo $thirdContentHeadingH3; ?>">
                                    <?php                                          
                                    endforeach;
                                    ?>
                              </div>
                              <div class="text-content">
                                    <div class="child-text-content">
                                          <h5><?php echo $thirdContentExtraHeadingh5; ?></h5>
                                          <hr class="small">
                                          <?php echo $thirdContentExtraHTML; ?>
                                    </div>      
                                    <div class="inner-2">
                                          <?php echo $thirdContentExtraImgHTML; ?>
                                    </div>      
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>