<footer id="footer1">
	<div class="footer_wrapper">
		<div id="footer_top">
			<div class="footer_widgets_wrapper">
				<div class="container">
					<div class="widgets cols_4 clearfix">
						<aside id="text-2" class="widget widget_text"><div class="widget_title"><h3 style="color: #fff">About Us</h3></div>			
							<div class="textwidget">
								<p>
									<img class="alignnone size-full wp-image-1633" src="images/site-content/<?php echo $content_logo_footer_row['Image'] ?>" alt="vineyard-footer" width="253" height="87" />
								</p>
								<p><?php echo $content_footer_about_row['Details']; ?></p>
								<p><a href="About-Us" class="btn btn-default">LEARN MORE</a></p>
							</div>
						</aside>

						<aside id="contacts-2" class="widget widget_contacts">
							<div class="widget_title">
								<h3 style="color: #fff">Contact</h3>
							</div>
							<ul>
								<?php 
									while($content_footer_contact_row = mysqli_fetch_array($content_footer_contact)){										
										echo '
										<li>
											<div class="icon">											
													<i class="fa '.$content_footer_contact_row['Icon'].'"></i> 
											</div>';
										echo '<div class="text">'.$content_footer_contact_row['Details'].'</div></li>';
									}
								?>
							</ul>
						</aside>
						<aside id="text-3" class="widget widget_text">
							<div class="widget_title">
								<h3 style="color: #fff">Locations</h3>
							</div>
							<div class="textwidget">
								<iframe src="<?php echo $content_footer_location_row['Details'] ?>" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</aside>
						<aside id="working_hours-2" class="widget widget_working_hours"><div class="widget_title"><h3 style="color: #fff">Working hours</h3></div>        
		        			<table class="table_working_hours">
		        				<?php 
		        					while($content_footer_work_row = mysqli_fetch_array($content_footer_work)){
		        						echo '
		        						<tr class="opened">
											<td class="day_label h6">'.$content_footer_work_row['Details'].'</td>
											<td class="day_value h6">'.$content_footer_work_row['Additional'].'</td>
										</tr>
		        						';
		        					}
		        				?>
							</table>
						</aside>
					</div>
				</div>
			</div>
		</div>
		<div id="footer_copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-8">
						<div class="clearfix">
							<div class="pull-left">
								<img class="footer_logo" src="images/site-content/<?php echo $content_logo_footer2_row['Image'] ?>" alt="Footer logo"/>
							</div>
							<div class="copyright_text"><i class="fa fa-copyright"></i> <?php echo $content_footer_copyright_row['Details'] ?></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-4">
						<div class="clearfix">
							<div class="pull-right xs-pull-left">
								<div class="pull-right">
										<div class="copyright_socials">
											<ul class="clearfix">
												<li><a href="<?php echo $content_top_row_fb['Link']; ?>"><i class='fa fa-facebook'></i></a></li>
												<li><a href="<?php echo $content_top_row_tw['Link']; ?>"><i class='fa fa-twitter'></i></a></li>
												<li><a href="<?php echo $content_top_row_in['Link']; ?>"><i class='fa fa-instagram'></i></a></li>
												<li><a href="<?php echo $content_top_row_skype['Link']; ?>"><i class='fa fa-skype'></i></a></li>
												<li><a href="<?php echo $content_top_row_yt['Link']; ?>"><i class='fa fa-youtube'></i></a></li>
											</ul>
										</div>
									</div>
							</div>
							<div class="pull-right xs-pull-left hidden-sm hidden-xs">
								<ul class="footer_menu heading_font clearfix">
								    <li id="menu-item-1888" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1888"><a href="http://www.vipc.edu.ph/">Home</a></li>
									<li id="menu-item-1889" class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-1739 menu-item-1889">
										<a href="About-Us">About Us</a>
									</li>
									<li id="menu-item-1922" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1922">
										<a href="http://www.vipc.edu.ph/programs/">Programs</a>
									</li>
									<li id="menu-item-1893" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1893">
										<a href="http://www.vipc.edu.ph/our-edge/">Our Edge</a>
									</li>
									<li id="menu-item-1894" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1894">
										<a href="http://www.vipc.edu.ph/partners/">Partners</a>
									</li>
									<li id="menu-item-1892" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1892">
										<a href="http://www.vipc.edu.ph/news-and-events/">News</a>
									</li>
									<li id="menu-item-1890" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1890">
										<a href="http://www.vipc.edu.ph/contact-us/">Contact</a>
									</li>
							    </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		
			<div class="modal-body heading_font">
				<div class="search-title">Search</div>
				<form role="search" method="get" id="searchform" action="http://www.vipc.edu.ph/">
				    <div class="search-wrapper">
				        <input placeholder="Start typing here..." type="text" class="form-control search-input" value="" name="s" id="s" />
				        <button type="submit" class="search-submit" ><i class="fa fa-search"></i></button>
				    </div>
				</form>
			</div>
		
		</div>
	</div>
</div>	