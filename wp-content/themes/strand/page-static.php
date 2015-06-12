<?php 
/*
Template Name: Static Template
*/
get_header(); 

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
?>

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