<?php 
  global $post;
  $current_place_title = get_the_title();

  $pageOtherPlaceHeadlineH3 = get_post_meta($post->ID, 'page_other_place_headline_H3', true);
  $pageOtherPlaceHeadlineH2 = get_post_meta($post->ID, 'page_other_place_headline_H2', true);

  $section_query = new WP_Query('post_type=ptype_places&orderby=menu_order&order=ASC&posts_per_page=-1');    
?>
  <div class="first-content">
    <div class="container">      
      <?php 
      $i=1;
      while ($section_query->have_posts()) : $section_query->the_post(); 
        $terms = wp_get_post_terms( $post->ID, 'placetype' );
        $place_type = ucfirst($terms[0]->name); 
        
        if($current_place_title==$place_type):
          $post_id = $post->ID;
          $headingH2 = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);
          $featurePlace = get_post_meta($post->ID, 'ptype_places_feature_place', true);
          $paragraphP = get_post_meta($post->ID, 'ptype_places_place_paragraph_html', true);          
          $locationLinkText = get_post_meta($post->ID, 'ptype_places_place_location_link_text', true);
          $locationLink = get_post_meta($post->ID, 'ptype_places_place_location_link', true);

          $extraContentImages = rwmb_meta( 'ptype_places_extra_content_image', 'type=image' );
          $extraContentParagraphP = get_post_meta($post->ID, 'ptype_places_extra_content_paragraph_html', true);

          $placeImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_places_place_image', true), 'full');

          if($featurePlace==1):
            $featureTitleHeadingH3 = get_post_meta($post->ID, 'ptype_places_feature_title_heading_h3', true);
      ?>      
              <div class="content-section">
                <div class="row actual-content" <?php if(empty($extraContentParagraphP)){ ?>style="padding-bottom:0px;"<?php } ?>>
                  <div class="col-md-12">
                    <?php if(!empty($extraContentParagraphP) || $i % 2 !== 0): ?>             
                      <div class="text-content">
                        <h3><?php echo $featureTitleHeadingH3; ?></h3>
                        <h2><?php echo $headingH2; ?></h2>
                        <hr class="small">
                        <?php echo $paragraphP; ?>
                        <a href="<?php echo $locationLink; ?>" target="_blank" class="see-location"><i class="fa fa-map-marker"></i> <?php echo $locationLinkText; ?></a>
                      </div>
                      <div class="img-content">
                        <?php $edited_placeImg = get_home_url()."/timthumb.php?src=".$placeImg[0].'&w=640&zc=0'; ?>
                        <img src="<?php echo $edited_placeImg; ?>" alt="<?php echo $headingH2; ?>">
                      </div>
                    <?php elseif($i % 2 === 0): ?>
                      <div class="img-content img-content-2">
                        <?php $edited_placeImg = get_home_url()."/timthumb.php?src=".$placeImg[0].'&w=640&zc=0'; ?>
                        <img src="<?php echo $edited_placeImg; ?>" alt="<?php echo $headingH2; ?>">
                      </div>
                      <div class="text-content text-content-2">
                        <h3><?php echo $featureTitleHeadingH3; ?></h3>
                        <h2><?php echo $headingH2; ?></h2>
                        <hr class="small">
                        <?php echo $paragraphP; ?>
                        <a href="<?php echo $locationLink; ?>" target="_blank" class="see-location"><i class="fa fa-map-marker"></i> <?php echo $locationLinkText; ?></a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php if(!empty($extraContentParagraphP)): ?>
                <div class="row extra-content">
                  <div class="col-md-12">
                    <div class="img-content">
                      <?php 
                      foreach ( $extraContentImages as $extraContentImage ):
                      ?>
                        <img src="<?php echo $extraContentImage['full_url']; ?>" alt="<?php echo $headingH2; ?>">
                      <?php
                      endforeach;
                      ?>
                    </div>
                    <div class="text-content">
                      <?php echo $extraContentParagraphP; ?>
                    </div>
                  </div>
                </div>   
                <?php endif; ?>
              </div>           
            <?php
            $i++;
          endif;
        endif;        
      endwhile; 
      wp_reset_query(); 
      ?>      
    </div>
  </div>

  <div class="where-to-shop">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="heading">
            <h3><?php echo $pageOtherPlaceHeadlineH3; ?></h3>
            <h2><?php echo $pageOtherPlaceHeadlineH2; ?></h2>
            <hr class="small">
          </div>

          <div class="shopping-spots">
          <?php   
            $i=1;          
            while ($section_query->have_posts()) : $section_query->the_post(); 
              $terms = wp_get_post_terms( $post->ID, 'placetype' );
              $place_type = ucfirst($terms[0]->name); 
              
              if($current_place_title==$place_type):
                $post_id = $post->ID;
                $headingH2 = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);
                $featurePlace = get_post_meta($post->ID, 'ptype_places_feature_place', true);
                $paragraphP = get_post_meta($post->ID, 'ptype_places_place_paragraph_html', true);
                $locationLinkText = get_post_meta($post->ID, 'ptype_places_place_location_link_text', true);
                $locationLink = get_post_meta($post->ID, 'ptype_places_place_location_link', true);

                $placeImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_places_place_image', true), 'full');

                if($featurePlace==0):
                  $websiteLinkText = get_post_meta($post->ID, 'ptype_places_place_website_link_text', true);
                  $websiteLink = get_post_meta($post->ID, 'ptype_places_place_website_link', true);  
                  if($i<=3):                
            ?>
                    <div class="each-shopping-spot">
                      <?php $edited_placeImg = get_home_url()."/timthumb.php?src=".$placeImg[0].'&w=370&h=270&zc=0'; ?>
                      <img src="<?php echo $edited_placeImg; ?>">
                      <div class="shopping-spot-info">                  
                        <h3><?php echo $headingH2; ?></h3>
                        <hr class="small">
                        <?php echo $paragraphP; ?>
                        <a href="<?php echo $websiteLink; ?>" target="_blank" class="visit-website"><?php echo $websiteLinkText ?> <i class="fa fa-chevron-circle-right"></i></a>                      
                        <hr class="first">
                        <hr class="second">
                        <div class="center">
                          <div class="v-align">
                            <a href="<?php echo $locationLink; ?>" target="_blank" class="see-on-map"><i class="fa fa-map-marker"></i> <?php echo $locationLinkText ?></a>
                          </div>                    
                        </div>
                      </div>
                      
                    </div>
                  <?php
                  $i++;
                  endif;
                endif;
              endif;        
            endwhile; 
            wp_reset_query(); 
            ?>            
          </div>
        </div>
      </div>
    </div>
  </div>


