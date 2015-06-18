<?php get_header(); ?>

<?php 
$pageParent =  $post->post_parent;
$pageHeadlineH5 = get_post_meta($post->ID, 'page_tagline_H5', true);
$pageHeadlineH1 = get_post_meta($post->ID, 'page_tagline_H1', true);
$pageHeadCaption = get_post_meta($post->ID, 'page_header_caption', true);
$bannerImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'page_header_image', true), 'full');

if($post->post_parent !== 0) {
	$post_data = get_post($post->post_parent);
	$parent_slug = $post_data->post_name;
}
$current_slug = get_post( $post )->post_name;

if($parent_slug=="rooms") {
	$current_slug = "deluxe-room";
}
?>

<?php if($parent_slug=='whats-nearby'): ?>
	<style>
		/*#page-wrapper .slider-wrapper div.item div.carousel-caption {
			width: 800px!important;
		}
		#page-wrapper .slider-wrapper div.item div.carousel-caption div.caption-text p {
			width: 450px!important;
		}*/
	</style>
<?php endif; ?>

<div id="carousel" class="slider-wrapper carousel slide" data-ride="carousel">
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<div class="item bg <?php if(isset($parent_slug)) echo $parent_slug; else echo $current_slug; ?>-bg1 active" style="background-image:url('<?php echo $bannerImg[0]; ?>');">			
			<div class="carousel-caption">
				<div class="caption-text">
					<h5><?php echo $pageHeadlineH5; ?></h5>
					<h1><?php echo $pageHeadlineH1; ?></h1>
					<hr class="small"></hr>
					<p><?php echo $pageHeadCaption; ?></p>
				</div>				
			</div>	
			<div class="item-cta">
				<!-- <img src="<?php echo IMG; ?>/icons/post-icon.png"><a href="#">SHARE AS A POSTCARD</a> -->
			</div>
		</div>
	</div>	
	<a href="#content-wrapper" class="scroll-to-content"><div class="arrow animated infinite fadeInDown" style="display: block;"></div></a>	
</div>

<div id="content-wrapper" class="<?php if(isset($parent_slug) && $parent_slug!='whats-nearby') echo $parent_slug; ?> <?php echo $current_slug; ?>">

	<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
	<?php endif; ?>	

	<div class="trip-advisor">
	  <a href="http://www.tripadvisor.com.sg/Hotel_Review-g294265-d338340-Reviews-Strand_Hotel-Singapore.html" target="_blank"><img src="<?php echo IMG; ?>/logo/tripadvisor.png"></a>
	</div>

</div>

<?php get_footer(); ?>