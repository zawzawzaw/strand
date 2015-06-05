<div id="page-wrapper">
	<div id="header-wrapper" class="">
		<header id="main-header" class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="logo-wrapper hidden-xs hidden-sm visible-md visible-lg">
						<a href="index.html" class="site-logo">
							<img src="images/logo/main-logo.png" alt="logo">
							<span>STRAND HOTEL SINGAPORE</span>
						</a>
					</div>
					<div id="menu-wrapper">
						<nav id="nav-main">
							<ul class="main-menu hidden-xs hidden-sm">
								<li>
									<a href="about.html">ABOUT</a>	
								</li>
								<li>
									<a href="room.html">ROOM</a>
								</li>
								<li>
									<a href="amenities.html">AMENITIES</a>
								</li>
								<li>
									<a href="whatsnearby.html">WHAT'S NEARBY</a>
								</li>
								<li>
									<a href="location.html">LOCATION</a>
								</li>
								<li>
									<a href="deals.html">DEALS</a>
								</li>
								<li>
									<a href="faq.html">FAQ</a>
								</li>
								<li>
									<a href="contact.html">CONTACT</a>
								</li>
								<li>
									<a href="reservation.html" class="reservation">RESERVATIONS</a>
								</li>
							</ul>
							<!-- <i class="fa fa-bars icon-font mobile-menu-btn hidden-md hidden-lg"></i>
							<ul class="mobile-menu hidden-md hidden-lg">
								<li>
									<a href="about.html">ABOUT</a>	
								</li>
								<li>
									<a href="room.html">ROOM</a>
								</li>
								<li>
									<a href="amenities.html">AMENITIES</a>
								</li>
								<li>
									<a href="whatsnearby.html">WHAT'S NEARBY</a>
								</li>
								<li>
									<a href="location.html">LOCATION</a>
								</li>
								<li>
									<a href="deals.html">DEALS</a>
								</li>
								<li>
									<a href="faq.html">FAQ</a>
								</li>
								<li>
									<a href="contact.html">CONTACT</a>
								</li>
								<li>
									<a href="reservation.html">RESERVATIONS</a>
								</li>
							</ul> -->
						</nav>
					</div>					
				</div>
			</div>
		</header>
	</div>
	<div class="reservation-widget">		
		<form id="reservation-form" action="" method="POST" role="form" >
			<div class="form-group form-border has-feedback">
				<label for="check-in">CHECK IN:</label>
				<input type="text" name="check-in" id="checkInDate" class="check-in-input" placeholder="DD/MM/YYYY">
				<i class="form-control-feedback"></i>
			</div>
			<div class="form-group form-border has-feedback">
				<label for="check-out">CHECK OUT:</label>
				<input type="text" name="check-out" id="checkOutDate" class="check-out-input" placeholder="DD/MM/YYYY">
				<i class="form-control-feedback"></i>
			</div>
			<div class="form-group">
				<div class="dropdown">
				    <select class="room-type" name="room-type">
				    	<option value="">Select room type</option>
				    	<option value="Deluxe Room">Deluxe Room</option>
						<option value="Standard Room">Standard Room</option>
						<option value="Family Room">Family Room</option>
				    </select>
				</div>
			</div>
			<div class="form-group">
				<div class="small-input">
					<label for="rooms">ROOMS</label>
					<input type="text" name="rooms">
				</div>

				<div class="small-input">
					<label for="adults">ADULTS</label>
					<input type="text" name="adults" id="adults">
				</div>

				<div class="small-input">
					<label for="children">CHILDREN</label>
					<input type="text" name="children" id="children">
				</div>
			</div>

			<button type="submit" class="btn btn-default check-availability">CHECK AVAILABILITY</button>
			<a href="#" class="modify-cancel">Modify / Cancel reservation</a>
		</form>
	</div>
	<div id="templatemo_content"></div>