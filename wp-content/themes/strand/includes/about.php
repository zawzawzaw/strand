<?php 
  $section_query = new WP_Query('post_type=ptype_about&orderby=menu_order&order=ASC&posts_per_page=-1');

  while ($section_query->have_posts()) : $section_query->the_post();   	
      
      $headingH2 = get_post_meta($post->ID, 'ptype_about_heading_h2', true);
      $headingH3 = get_post_meta($post->ID, 'ptype_about_heading_h3', true);
      $headingH4 = get_post_meta($post->ID, 'ptype_about_heading_h4', true);      
      $headingH5 = get_post_meta($post->ID, 'ptype_about_heading_h5', true);      
      $headingParagraphHTML = get_post_meta($post->ID, 'ptype_about_heading_paragraph_html', true);
      $headingQuoteH4 = get_post_meta($post->ID, 'ptype_about_heading_quote_h4', true);      
      $images = rwmb_meta( 'ptype_about_about_images', 'type=image' );

      $bookYourStayHeadingH2 = get_post_meta($post->ID, 'ptype_about_book_your_stay_heading_h2', true);
      $bookYourStayHeadingH3 = get_post_meta($post->ID, 'ptype_about_book_your_stay_heading_h3', true);
      $bookYourStayParagraphP = get_post_meta($post->ID, 'ptype_about_book_your_stay_paragraph_p', true);
      $bookYourStayLinkText = get_post_meta($post->ID, 'ptype_about_book_your_stay_link_text', true);
      $bookYourStayLink = get_post_meta($post->ID, 'ptype_about_book_your_stay_link', true);
      $bookYourStayBg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_about_book_your_stay_bg', true), 'full');         

  endwhile; 
?>

<div class="discover-us">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h3><?php echo $headingH3; ?></h3>
          <h2><?php echo $headingH2; ?></h2>
          <hr class="small">
          <h4><?php echo $headingH4; ?></h4>

          <?php echo $headingParagraphHTML; ?>

          <h4 class="quote"><?php echo $headingQuoteH4; ?></h4>

          <hr class="x-small">

          <h5><?php echo $headingH5; ?></h5>
        </div>
        <div class="img-content">
          <div id='about-masonry'>
            <?php
              $i = 0;
              foreach ( $images as $image )
              {
                if($i==0) echo "<div class='about-masonry-item large'><img src='{$image['full_url']}'></div>"; 
                elseif($i==1) echo "<div class='about-masonry-item medium'><img src='{$image['full_url']}'></div>";
                else echo "<div class='about-masonry-item'><img src='{$image['full_url']}'></div>";
                $i++;
              }
            ?>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    

<div class="book-your-stay" style="background-image:url('<?php echo $bookYourStayBg[0]; ?>');">
  <div class="caption">
    <div class="caption-text">          
      <h3><?php echo $bookYourStayHeadingH3; ?></h3>
      <h2><?php echo $bookYourStayHeadingH2; ?></h2>
      <hr class="small"></hr>
      <p><?php echo $bookYourStayParagraphP; ?></p>
      <a href="<?php echo $bookYourStayLink; ?>" class="book-a-room"><?php echo $bookYourStayLinkText; ?></a>
    </div>
  </div>
</div>