<?php 
  $section_query = new WP_Query('post_type=ptype_whatsnearby&orderby=menu_order&order=ASC&posts_per_page=-1');

  while ($section_query->have_posts()) : $section_query->the_post();   	
      
      $whereToShopHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_heading_h2', true);
      $whereToShopHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_heading_h3', true);
      $whereToShopHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_paragraph_html', true);
      $whereToShopLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link_text', true);
      $whereToShopLink = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link', true);
      $whereToShopLink = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link', true);
      $whereToShopImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_img', true), 'full');

      $exploreAttractionHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_heading_h2', true);
      $exploreAttractionHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_heading_h3', true);
      $exploreAttractionHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_paragraph_html', true);
      $exploreAttractionLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link_text', true);
      $exploreAttractionLink = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link', true);
      $exploreAttractionLink = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link', true);
      $exploreAttractionBgStamp = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_bg_stamp', true), 'full');
      $exploreAttractionImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_img', true), 'full');

      $eatDrinkHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_heading_h2', true);
      $eatDrinkHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_heading_h3', true);
      $eatDrinkHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_paragraph_html', true);
      $eatDrinkLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link_text', true);
      $eatDrinkLink = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link', true);
      $eatDrinkLink = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link', true);
      $eatDrinkImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_img', true), 'full');

      $neighborhoodHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_heading_h2', true);
      $neighborhoodHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_heading_h3', true);
      $neighborhoodParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_paragraph_HTML', true);

      $shoppingPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_heading_h4', true);
      $shoppingPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_heading_h5', true);
      $shoppingPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_link_text', true);
      $shoppingPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_link', true);
      $shoppingPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_icon', true), 'full');

      $attractionPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_heading_h4', true);
      $attractionPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_heading_h5', true);
      $attractionPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_link_text', true);
      $attractionPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_link', true);
      $attractionPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_icon', true), 'full');

      $eateryPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_heading_h4', true);
      $eateryPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_heading_h5', true);
      $eateryPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_link_text', true);
      $eateryPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_link', true);
      $eateryPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_icon', true), 'full');

  endwhile; 
?>

<style>
  .text-content:after { background: url('<?php echo $exploreAttractionBgStamp[0]; ?>')!important; }
</style>

<div class="first-content">
  <div class="container">

    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h3><?php echo $whereToShopHeadingH3; ?></h3>
            <h2><?php echo $whereToShopHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $whereToShopHeadingParagraphHTML; ?>
            <a href="<?php echo $whereToShopLink; ?>" class="discover-more"><?php echo $whereToShopLinkText; ?></a>             
          </div>
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$whereToShopImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $whereToShopHeadingH3; ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$exploreAttractionImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $exploreAttractionHeadingH3; ?>">
          </div>
          <div class="text-content">
            <h3><?php echo $exploreAttractionHeadingH3; ?></h3>
            <h2><?php echo $exploreAttractionHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $exploreAttractionHeadingParagraphHTML; ?>
            <a href="<?php echo $exploreAttractionLink; ?>" class="discover-more"><?php echo $exploreAttractionLinkText; ?></a>             
          </div>            
        </div>
      </div>
    </div>

    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h3><?php echo $eatDrinkHeadingH3; ?></h3>
            <h2><?php echo $eatDrinkHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $eatDrinkHeadingParagraphHTML ?>
            <a href="<?php echo $eatDrinkLink; ?>" class="discover-more"><?php echo $eatDrinkLinkText; ?></a>             
          </div>
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$eatDrinkImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $eatDrinkHeadingH3; ?>">
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="neighborhood">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="heading">
              <h3><?php echo $neighborhoodHeadingH3; ?></h3>
              <h2><?php echo $neighborhoodHeadingH2; ?></h2>
              <hr class="small">
              <?php echo $neighborhoodParagraphHTML; ?>
            </div>    

            <div id="google-map-canvas" class="map"></div>                          

            <div class="places">
              <div class="each-place">
                <h4><?php echo $shoppingPlaceHeadingH4; ?></h4>
                <h5><?php echo $shoppingPlaceHeadingH5; ?></h5>
                <img src="<?php echo $shoppingPlaceIcon[0]; ?>" alt="<?php echo $shoppingPlaceHeadingH4; ?>">
                <ul>
                  <li><a href="#google-map-canvas" id="theCathay" class="show-place">The Cathay</a></li>
                  <li><a href="#google-map-canvas" id="plazaSingapura" class="show-place">Plaza Singapura</a></li>
                  <li><a href="#google-map-canvas" id="bugisJunction" class="show-place">Bugis Junction</a></li>
                  <li><a href="#google-map-canvas" id="bugisVillage" class="show-place">Bugis Village</a></li>
                  <li><a href="#google-map-canvas" id="hajiLane" class="show-place">Haji Lane</a></li>
                  <li><a href="#google-map-canvas" id="rafflesCity" class="show-place">Raffles City</a></li>
                </ul>
                <a href="<?php echo $shoppingPlaceLink; ?>" class="learn-more"><?php echo $shoppingPlaceLinkText; ?></a>
              </div>
              <div class="each-place">
                <h4><?php echo $attractionPlaceHeadingH4; ?></h4>
                <h5><?php echo $attractionPlaceHeadingH5; ?></h5>
                <img src="<?php echo $attractionPlaceIcon[0]; ?>" alt="<?php echo $attractionPlaceHeadingH4; ?>">
                <ul>
                  <li><a href="#google-map-canvas" id="artMuseum" class="show-place">Singapore Art Museum</a></li>
                  <li><a href="#google-map-canvas" id="historyMuseum" class="show-place">Singapore History Museum</a></li>
                  <li><a href="#google-map-canvas" id="peranakanMuseum" class="show-place">Peranakan Museum</a></li>
                  <li><a href="#google-map-canvas" id="philatelicMuseum" class="show-place">Singapore Philatelic Museum</a></li>
                  <li><a href="#google-map-canvas" id="amenianChurch" class="show-place">Amenian Church</a></li>
                  <li><a href="#google-map-canvas" id="stAndrewCathedral" class="show-place">St Andrew Cathedral</a></li>
                </ul>
                <a href="<?php echo $attractionPlaceLink; ?>" class="learn-more"><?php echo $attractionPlaceLinkText; ?></a>
              </div>
              <div class="each-place">
                <h4><?php echo $eateryPlaceHeadingH4; ?></h4>
                <h5><?php echo $eateryPlaceHeadingH5; ?></h5>
                <img src="<?php echo $eateryPlaceIcon[0]; ?>" alt="<?php echo $eateryPlaceHeadingH4; ?>">
                <ul>
                  <li><a href="#google-map-canvas" id="strictlyPancakes" class="show-place">Strictly Pancakes</a></li>
                  <li><a href="#google-map-canvas" id="mackenzieRexChickenRice" class="show-place">Mackenzie Rex Chicken Rice</a></li>
                  <li><a href="#google-map-canvas" id="artichokeCafeBar" class="show-place">Artichoke Cafe & Bar</a></li>
                  <li><a href="#google-map-canvas" id="piedraNegra" class="show-place">Piedra Negra</a></li>
                  <li><a href="#google-map-canvas" id="kithCafe" class="show-place">Kith Cafe</a></li>
                  <li><a href="#google-map-canvas" id="chijmes" class="show-place">Chijmes</a></li>
                </ul>
                <a href="<?php echo $eateryPlaceLink; ?>" class="learn-more"><?php echo $eateryPlaceLinkText; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>