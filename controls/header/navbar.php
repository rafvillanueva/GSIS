<div class="header_top_bar" style="background-color:#ed1f24">
	<div class="container">
		<div class="clearfix">
			<div class="pull-right">
				<div class="header_top_bar_socs">
					<ul class="clearfix">									
						<li><a href="<?php echo $content_top_row_fb['Link']; ?>"><i class='fa fa-facebook'></i></a></li>
						<li><a href="<?php echo $content_top_row_tw['Link']; ?>"><i class='fa fa-twitter'></i></a></li>
						<li><a href="<?php echo $content_top_row_in['Link']; ?>"><i class='fa fa-instagram'></i></a></li>
						<li><a href="<?php echo $content_top_row_skype['Link']; ?>"><i class='fa fa-skype'></i></a></li>
						<li><a href="<?php echo $content_top_row_yt['Link']; ?>"><i class='fa fa-youtube'></i></a></li>
						<li style="letter-spacing: 2px;"><a href="login"> LOG-IN <i class='fa fa-key'></i><i class='fa fa-lock'></i></a></li>
					</ul>
				</div>
			</div>
			<div class="pull-right xs-pull-left">
				<ul class="top_bar_info clearfix">
					<?php 
						while($content_top_row = mysqli_fetch_array($content_top_info)){
							echo '<li ><i class="fa '.$content_top_row['Icon'].'"></i> '.$content_top_row['Details'].'</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>	
<div class="sticky_header_holder"></div>						
	<div class="header_default">
		<div class="container">
		    <div class="row">
			    <div class="col-md-3 col-sm-12 col-xs-12">
				    <div class="logo-unit">
				        <a href="http://www.vipc.edu.ph/">
							<img class="img-responsive logo_transparent_static visible" src="images/site-content/<?php echo $content_logo_top_row['Image'] ?>" style="width: 270px;" alt="Vineyard College"/>
						</a>
					</div>		    
			        <!-- Navbar toggle MOBILE -->
				    <button type="button" class="navbar-toggle collapsed hidden-lg hidden-md" data-toggle="collapse" data-target="#header_menu_toggler">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
			    </div> 
			    <!-- md-3 -->
			    <!-- MObile menu -->
			    <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
				    <div class="collapse navbar-collapse header-menu-mobile" id="header_menu_toggler">
					    <ul class="header-menu clearfix">
						    <li id="menu-item-1732" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1732">
						    	<a href="vineyard">Home</a>
						    </li>
							<li class="active" id="menu-item-1818" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1739 current_page_item menu-item-1818">
								<a  href="about-us">About Us</a>
								<div class="magic_line line_visible" style="max-width: 77px;"></div>
							</li>
							<li id="menu-item-1923" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1923"><a href="program">Programs</a>
								<ul class="sub-menu">
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20188"><a href="view-program?id=1">Bachelor`s Degree Programs</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20288"><a href="view-program?id=2">Associate Programs <br>(2 Years)</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20838"><a href="view-program?id=3">Certificate Programs <br>(TESDA Registered Programs)</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2088"><a href="royal-ace-gaming-institute.php">Royal Ace Gaming Institute</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2164"><a href="vineyard-culinary-institute.php">Vineyard Culinary Institute</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2143"><a href="senior-high-school.php">Senior High School</a></li>
								</ul>
							</li>
							<li id="menu-item-1728" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1728">
								<a href="our-edge.php">Our Edge</a>
							</li>
							<li id="menu-item-1843" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1843">
								<a href="partners">Partners</a>
							</li>
							<li id="menu-item-1734" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1734">
								<a href="news-and-events">News</a>
							</li>
							<li id="menu-item-1875" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1875">
								<a href="contact-us">Contact Us</a>
							</li>						
		                    <li id="menu-item-17314" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1734">
								<a href="Login">Login</a>
							</li>
					    </ul>
				    </div>
			    </div>	    
			    <!-- Desktop menu -->
			    <div class="col-md-8 col-md-offset-1 col-sm-9 col-sm-offset-0 hidden-xs hidden-sm">	    		    
				    <div class="header_main_menu_wrapper clearfix" style="margin-top:24px;">
					    
					    
					    <div class="collapse navbar-collapse pull-right">
						    <ul class="header-menu clearfix">
							    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1732">
							    	<a href="vineyard">Home</a>
							    </li>
							    <!-- current-menu-item -->
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-1739 current_page_item menu-item-1818"><a href="about-us">About Us</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-1739 current_page_item menu-item-1818"><a href="weather-status">Weahter</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1923"><a href="program">Programs</a>
								<ul class="sub-menu">
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2088"><a href="view-program?id=1">Bachelor`s Degree Programs</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2088"><a href="view-program?id=2">Associate Programs <br>(2 Years)</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2088"><a href="view-program?id=3">Certificate Programs <br>(TESDA Registered Programs)</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2088"><a href="royal-ace-gaming-institute.php">Royal Ace Gaming Institute</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2164"><a href="vineyard-culinary-institute.php">Vineyard Culinary Institute</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2143"><a href="senior-high-school.php">Senior High School</a></li>
								</ul>
								</li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1728"><a href="our-edge">Our Edge</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1843"><a href="partners">Partners</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1734"><a href="news-and-events">News</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1875"><a href="contact-us">Contact Us</a></li>
						    </ul>
					    </div>			    
				    </div>
			    </div><!-- md-8 desk menu -->	    
		    </div> <!-- row -->
		</div> <!-- container -->	
	</div>
</div>