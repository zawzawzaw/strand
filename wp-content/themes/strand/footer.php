<?php 
	$page_info = get_page_by_title( 'Offices' );
?>
		<div id="footer-wrapper" class="fixed-footer"><!-- container-fluid -->
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h4><?php bloginfo("name"); ?></h4>
						<?php
						$args = array(
							'post_type' => 'page',
							'post_parent' => $page_info->ID,
							'orderby' => 'ID',
							'order' => 'ASC'
						);
						$child_page_query = new WP_Query( $args );
						?>
						<?php if ( $child_page_query->have_posts() ) while ( $child_page_query->have_posts() ) : $child_page_query->the_post(); ?>
							<!-- <div class="span3">
								<p><strong><?php the_title(); ?></strong><br>
								<?php the_excerpt(); ?>
							</div> -->
						<?php endwhile; ?>
						<div class="links">	
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Deals</a></li>
								<li><a href="#">Rooms</a></li>
								<li><a href="#">Amenties</a></li>
							</ul>
							<ul>
								<li><a href="#">What's Nearby</a></li>
								<li><a href="#">Location</a></li>
							</ul>
							<ul>
								<li><a href="#">FAQs</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
						</div>
						<div class="mailing-list">
							<h5>JOIN OUR MAILING LIST</h5>

							<div class="form-group has-feedback">
								<input type="text" name="email" placeholder="Your Email Address" />
								<i class="fa fa-envelope-o form-control-feedback"></i>
							</div>

							<h5>CONNECT WITH US</h5>
							<ul>
								<li><a class="social facebook" href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a class="social twitter" href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a class="social instagram" href="#"><i class="fa fa-instagram"></i></a></li>
								<li><a class="social pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
								<li><a class="social googleplus" href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="copyright-wrapper" class="fixed-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<hr class="big"></hr>

						<p>&copy; <?php echo date('Y'); ?> The Strand Hotel Singapore. All Rights Reserved.</p>		

						<ul>
							<li><a href="<?php $this_page_info = get_page_by_title('Terms of use'); echo get_permalink($this_page_info->ID); ?>">TERMS & CONDITIONS</a></li>
							<li><a href="<?php $this_page_info = get_page_by_title('Privacy Policy'); echo get_permalink($this_page_info->ID); ?>">PRIVACY POLICY</a></li>
						</ul>
						<div class="clearfix"></div>	
					</div>
				</div>
			</div>
		</div>
	</div><!-- page wrapper end -->

	<?php wp_footer(); ?>
</body>
</html>