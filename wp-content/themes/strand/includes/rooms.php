<?php 
  $section_query = new WP_Query('post_type=ptype_rooms&orderby=menu_order&order=ASC&posts_per_page=-1'); 

  while ($section_query->have_posts()) : $section_query->the_post(); 
  	$featuredImg = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');		
    $sectionID = get_post_meta($post->ID, 'ptype_rooms_section_id', true); 
    
    if($sectionID==1) {
      $headingH2 = get_post_meta($post->ID, 'ptype_rooms_heading_h2', true);
      $headingH3 = get_post_meta($post->ID, 'ptype_rooms_heading_h3', true);
      $headingParagraphHTML = get_post_meta($post->ID, 'ptype_rooms_heading_paragraph_html', true);
      $ultimateExperienceIcons = rwmb_meta( 'ptype_rooms_ultimate_experience_icon', 'type=image' );  
      $ultimateExperienceHTML = get_post_meta($post->ID, 'ptype_rooms_ultimate_experience_img_html', true);
      $images = rwmb_meta( 'ptype_rooms_ultimate_experience_img', 'type=image' );  
      $ultimateExperienceH3 = get_post_meta($post->ID, 'ptype_rooms_ultimate_experience_heading_h3', true);
      $ultimateExperienceH4 = get_post_meta($post->ID, 'ptype_rooms_ultimate_experience_heading_h4', true);
      $ultimateExperienceP = get_post_meta($post->ID, 'ptype_rooms_ultimate_experience_paragraph_p', true);
    
      $room1Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_rooms_room_1_img', true), 'full');
      $room1ImgHtml = get_post_meta($post->ID, 'ptype_rooms_room_1_img_html', true);
      $room1LinkText = get_post_meta($post->ID, 'ptype_rooms_room_1_link_text', true);
      $room1Link = get_post_meta($post->ID, 'ptype_rooms_room_1_link', true);
      $room2Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_rooms_room_2_img', true), 'full');
      $room2ImgHtml = get_post_meta($post->ID, 'ptype_rooms_room_2_img_html', true);
      $room2LinkText = get_post_meta($post->ID, 'ptype_rooms_room_1_link_text', true);
      $room2Link = get_post_meta($post->ID, 'ptype_rooms_room_2_link', true);
      $room3Img = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_rooms_room_3_img', true), 'full');
      $room3ImgHtml = get_post_meta($post->ID, 'ptype_rooms_room_3_img_html', true);    
      $room3LinkText = get_post_meta($post->ID, 'ptype_rooms_room_3_link_text', true);  
      $room3Link = get_post_meta($post->ID, 'ptype_rooms_room_3_link', true);          
    }  
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

        <?php get_template_part( 'content', 'room-slider' ); ?>

        <div class="second-content">
          <div id="rooms-masonry" class="img-content">
            <div class="rooms-masonry-item">
              <div class="inner">
                <?php foreach ( $ultimateExperienceIcons as $ultimateExperienceIcon ): ?>
                  <img src="<?php echo $ultimateExperienceIcon['full_url']; ?>  " class="case" />                
                <?php endforeach; ?>
                <?php echo $ultimateExperienceHTML; ?>  
              </div>
              
            </div>
            <?php
              $i = 0;
              foreach ( $images as $image )
              {
                if($i==0) echo "<div class='rooms-masonry-item'><img src='{$image['full_url']}'></div>"; 
                elseif($i==1) echo "<div class='rooms-masonry-item large'><img src='{$image['full_url']}'></div>"; 
                elseif($i==2) echo "<div class='rooms-masonry-item medium'><img src='{$image['full_url']}'></div>";
                elseif($i==3) echo "<div class='rooms-masonry-item small-2'><img src='{$image['full_url']}'></div>"; 
                elseif($i==4) echo "<div class='rooms-masonry-item'><img src='{$image['full_url']}'></div>"; 
                elseif($i==5) echo "<div class='rooms-masonry-item small'><img src='{$image['full_url']}'></div>"; 
                else echo "<div class='rooms-masonry-item'><img src='{$image['full_url']}'></div>";                     
                $i++;
              }
            ?>                        
          </div>

          <div class="ultimate-experience">
            <h3><?php echo $ultimateExperienceH3; ?></h3>
            <hr class="small"></hr>
            <h4><?php echo $ultimateExperienceH4; ?></h4>
            <p><?php echo $ultimateExperienceP; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="available-rooms">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="rooms-list">
          <div class="each-room">
            <img src="<?php echo $room1Img[0]; ?>">
            <div class="room-info">
              <?php echo $room1ImgHtml; ?>
              <a href="<?php echo $room1Link; ?>" class="learn-more">LEARN MORE</a>
            </div>
          </div>
          <div class="each-room">
            <img src="<?php echo $room2Img[0]; ?>">
            <div class="room-info">
              <?php echo $room2ImgHtml; ?>               
              <a href="<?php echo $room2Link; ?>" class="learn-more">LEARN MORE</a>
            </div>
          </div>
          <div class="each-room">
            <img src="<?php echo $room3Img[0]; ?>">
            <div class="room-info">
              <?php echo $room3ImgHtml; ?>
              <a href="<?php echo $room3Link; ?>" class="learn-more">LEARN MORE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>