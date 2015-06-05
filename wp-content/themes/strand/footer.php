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
                            'order'                  => 'ASC',
                            'orderby'                => 'menu_order',
                            'post_type'              => 'nav_menu_item',
                            'post_status'            => 'publish',
                            'output'                 => ARRAY_A,
                            'output_key'             => 'menu_order',
                            'nopaging'               => true,
                            'update_post_term_cache' => false );
                            $menu_items = wp_get_nav_menu_items( 'Footer Menu', $args );
                        ?>
						
						<div class="links">	
							<ul>
                                <?php 
                                foreach ( (array) $menu_items as $key => $menu_item ) {
                                    if ( $menu_item->menu_item_parent == 217 ) :
                                        $title = $menu_item->title;
                                        $url = $menu_item->url; 
                                ?>
                                    <li>                          
                                      <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                                    </li>
                                <?php
                                    endif;
                                }
                                ?>
								<!-- <li><a href="#">About Us</a></li>
								<li><a href="#">Deals</a></li>
								<li><a href="#">Rooms</a></li>
								<li><a href="#">Amenties</a></li> -->
							</ul>
							<ul>
                                <?php 
                                foreach ( (array) $menu_items as $key => $menu_item ) {
                                    if ( $menu_item->menu_item_parent == 218 ) :
                                        $title = $menu_item->title;
                                        $url = $menu_item->url; 
                                ?>
                                    <li>                          
                                      <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                                    </li>
                                <?php
                                    endif;
                                }
                                ?>
								<!-- <li><a href="#">What's Nearby</a></li>
								<li><a href="#">Location</a></li> -->
							</ul>
							<ul>
                                <?php 
                                foreach ( (array) $menu_items as $key => $menu_item ) {
                                    if ( $menu_item->menu_item_parent == 220 ) :
                                        $title = $menu_item->title;
                                        $url = $menu_item->url; 
                                ?>
                                    <li>                          
                                      <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                                    </li>
                                <?php
                                    endif;
                                }
                                ?>
								<!-- <li><a href="#">FAQs</a></li>
								<li><a href="#">Contact Us</a></li> -->
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

	<script id="qikresjs" src="http://210.1.224.42/wbe/js/qikres.js" type="text/javascript"></script> 
	<script type="text/javascript" src="<?php echo JS; ?>/xd.js"></script>
	<script>
	/////////
    /////////
    /////////

    var test = true;
    function checkAvailability(module) {

        var checkInDateArr = jQuery( "#checkInDate" ).val().split('/');
        var formatted_checkInDate = checkInDateArr[2] + '-' + checkInDateArr[1] + '-' + checkInDateArr[0];

        var checkOutDateArr = jQuery( "#checkOutDate" ).val().split('/');
        var formatted_checkOutDate = checkOutDateArr[2] + '-' + checkOutDateArr[1] + '-' + checkOutDateArr[0];

        // console.log(formatted_checkInDate)
        // console.log(formatted_checkOutDate)

        // return false;
        
        var requireSafariFix = Qikres.fixForSafari({
            checkInDate: formatted_checkInDate,
            checkOutDate: formatted_checkOutDate,
            url:"http://210.1.224.42/wbe/jsp/safarifix_loading.jsp"
        }); 
        
        if(requireSafariFix ==1)
            return;
            
        Qikres.render({
            propertyCode: 'BHS',
            checkInDate: formatted_checkInDate,
            checkOutDate: formatted_checkOutDate,
            adult: jQuery( "#adults" ).val(),
            children: jQuery( "#children" ).val(),
            customerID: '0064152669',   
            window: 'embedded', // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded,
            // style: "http://192.168.0.88:8080/wbe/crossroads.css",
            // printStyle: 'http://192.168.0.201/hoteldemo/crossroads/css/print.css',
            popupDraggable : true,
            module : module,
            external : 1,
            popupFullScreen : true,
        });

        $('#templatemo_content').prepend('<span class="close">Close X</span>');
        
        $('#content_left').hide();

        $(document).on('click', '.close', function(){
        	console.log('closing');
        	$(this).parent().html('');
        });
    };

    function showPromotion() {
        
        Qikres.listPromotions({
            propertyCode: 'BHS',
            checkInDate: jQuery( "#checkInDate" ).val(),
            checkOutDate: jQuery( "#checkOutDate" ).val(),
            adult: jQuery('#adults').val(),
            children: jQuery('#children').val(),
            customerID: '0064152669',   
            window: 'embedded', // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded,
            //style: "http://192.168.0.88:8080/wbe/crossroads.css",
            //printStyle: 'http://192.168.0.201/hoteldemo/crossroads/css/print.css',
            popupDraggable : true,
            popupFullScreen : true
        });
        $('#content_left').hide();
    };

    function reviewResv() {
        Qikres.render({
            propertyCode: 'BHS',
            checkInDate: jQuery( "#checkInDate" ).val(),
            checkOutDate: jQuery( "#checkOutDate" ).val(),
            adult: jQuery('#adults').val(),
            children: jQuery('#children').val(),
            title: "Web Booking Engine",
            window: "embedded", // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded
            height: 500,
            customerID: '0064152669',   
            reviewConfNumber : '89ef81e885',
            reviewLastName : 'Mah',
            reviewFirstName : 'Jason',
            reviewEmail : 'jason@mah.com',
            reviewPhone : '234324234',
            module : 'REVIEW',
            popupDraggable : true,
            popupFullScreen: true
        });
    };

    var firsSetCookie = 0;
    function setCookie() {
        if (navigator.userAgent.indexOf('Safari') != -1 
         && navigator.userAgent.indexOf('Chrome') == -1 )
        {
            var w = window.open('http://192.168.0.88:8080/wbe/jsp/safarifix.jsp','','width=2,height=1');
            firsSetCookie = 1; 
            //setTimeout( function(){w.close()},1000 );
        }
    }

    function proceedCheckAvail() {
        if (navigator.userAgent.indexOf('Safari') != -1 
         && navigator.userAgent.indexOf('Chrome') == -1 ) 
        {
            var n = Qikres.getQueryString('fromQikRes');
            var checkInDate = Qikres.getQueryString('checkInDate');
            var checkOutDate = Qikres.getQueryString('checkOutDate');
            if(checkInDate != null)
                jQuery( "#checkInDate" ).val(checkInDate);
            if(checkOutDate != null)
                jQuery( "#checkOutDate" ).val(checkOutDate);
                
            var adult = Qikres.getQueryString('adult');
            var children = Qikres.getQueryString('children');
            
            if(adult != null)
                jQuery( "#adult" ).val(adult);
            if(children != null)
                jQuery( "#children" ).val(children);
                
            if(n == 1) {
                checkAvailability();
                
            }
        }
    }
        


    var parent_url = decodeURIComponent(document.location.hash.replace(/^#/, ''));
    function send() {
        console.log("send from index.html");
        XD.postMessage(jQuery("#templatemo_content").height() + ";" + jQuery("#templatemo_content").width() , parent_url, parent);
        return false;
    }
        
    var parent_url = decodeURIComponent(document.location.hash.replace(/^#/, ''));
    </script>
</body>
</html>