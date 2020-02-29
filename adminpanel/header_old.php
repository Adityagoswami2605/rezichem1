      <div class="sunray-update">    
               <ul>    
                 <li> 
                   <div class="image-b" style="float:left;">
                     <img src="images/customer-up.png" />
                   </div>
                    
                        <div id="slider1" style="float:right;">
                            
                            <div class="viewport">
                                <ul style="width: 1820px; left: -520px;" class="overview">
                              <?php
							   $get_updates = get_updates(); 
                                
								foreach($get_updates as $updates_detail)
								{
									$updates_id 		= $updates_detail['updates_id'];
									$updates_name 		= $updates_detail['updates_name'];
									$updates_desc 	= $updates_detail['updates_desc'];
									
                              ?>  
                                <li>
                                <h3><?=$updates_name?></h3>
                                <p><?=$updates_desc?></p>
                                 
                                </li>
                                <?php
								}
								
								?>
                                
                                
                                </ul>
                          </div>
                            <a class="buttons prev" href="#">&lt;</a><a class="buttons next" href="#">&gt;</a>                        </div>     
                                             
                   </li>  
               </ul>
            </div> 
             
        
			<!--start-top-header--->
			<!--start-wrap--->
			<div class="top-hader">
					<div class="wrap">
				<div class="top-header-left">
					<p><span><img src="images/phone-icon.png" style="float:left;margin:1px 3px 0px 0px;width:20px;height:18px;" />Customer Care No : <img src="images/coustomercare-animation.gif" /></span></p>
				</div>
                <div class="top-header-middle">
					<ul>
                     
                      <li>
                    <form method="get" id="searchform" action="">				
		<input class="field" name="s" id="s" onBlur="if (this.value == '') this.value = 'Site Search';" onFocus="if (this.value == 'Site Search') this.value = '';" value="Site Search" type="text">
		<input class="submit" name="submit" id="searchsubmit" value="Search" type="submit">
	</form></li>
                     </ul>  
                    <div class="clear"></div>
				</div>
				
                <div class="top-header-contact">
					 <ul>
                     <li><a href="">Contact <img src="images/contact-arrow.png" alt=""/></a>
                         <ul>
                           <span class="contact-title"><strong>Kosol Hiramrut Energies Pvt. Ltd.</strong></span>
                            
                           <p>193, "Kalthia House",<br/>Satyagrah Chhavni,<br/> Opp. Iscon Mall, S.G. Highway,<br/> Ahmedabad-380015,<br/> Gujarat, INDIA. </p>
                            <p>Tel No. : +91-79-2686 1339</p>
                            <p>Email :<a href="mailto:info@sunray.co.in" target="_blank">info@sunray.co.in</a></p>
                          </ul>
                     </li>
                     </ul>
				</div>
                <div class="top-header-right">
					<p><img src="images/email-icon.png" />Email us : <a href="mailto:info@sunray.co.in">info@sunray.co.in</a></p>
				</div>
				<div class="clear"> </div>
			</div>
			<!--end-top-header--->
		</div>
		<!--end-wrap--->
		
		<div class="main-header"> 
			<div class="wrap">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" title="logo" /></a>
			</div>
				<div class="top-nav">
					<ul class="menu">
						<li><a href="index.php" class=""><img src="images/home_logo.png" width="25px" style="margin-top:-5px;" title="homo-logo" /></a></li>
						<li><a href="#">Company</a>
                           <ul class="submenu">
                                 <li><a href="company.php#1b">Nurturing Sustainable Development</a></li>
						         <li><a href="company.php#2b">Vision</a></li>
                                 <li><a href="company.php#3b">Mission</a></li>
                                 <li><a href="company.php#4b">Endorsing Infrastructure Functionality</a></li>
						         <li><a href="company.php#5b">Our Products</a></li>
                                  
                            </ul>
                        </li>
                        
                    <!--  <li><a href="#">Product</a>
                            <ul class="submenu">
                                 <li><a href="#">Solar Water Heating System</a>
                                        <ul class="sub-submenu">
                                             <li><a href="#">Solar Water Heating System</a>
                                               <ul class="third-sub-submenu">
                                                     <li><a href="#">Solar Water Heating System</a></li>
                                                     <li><a href="#">Solar Lighting System</a></li>
                                                     <li><a href="#">Solar Cooking System</a></li>    
                                                </ul>                                             
                                             </li>
                                             <li><a href="#">Solar Lighting System</a></li>
                                             <li><a href="#">Solar Cooking System</a></li>    
                                        </ul>
                                 </li>
						         <li><a href="#">Solar Lighting System</a></li>
                                 <li><a href="#">Solar Cooking System</a></li>    
                            </ul>
                      </li>   -->
              <?php  /* ?>          
				<li><a href="#">Product</a>
                            <ul class="submenu">
                            <?php 
                            $get_categories = get_cat_options(); ?>
                            <?php 
								foreach($get_categories as $category_detail)
								{
									$category_id 			= $category_detail['category_id'];
									$category_parent		= $category_detail['category_parent_id'];
									$category_parent     	= $category_parent != '0' ? get_cat_name($category_parent) : '-';  
									$category_name 			= $category_detail['category_name'];
								?>
                      <li><a href="#"><?=$category_name?></a>
                      <ul class="sub-submenu">
                        <?php
                            $get_categories1 = get_multicat_options($category_id); ?>
                       
                            <?php 
							  //  pre($get_categories1);
								foreach($get_categories1 as $category_details)
								{
									$category_id1 			= $category_details['category_id'];
									$category_parent		= $category_details['category_parent_id'];
									$category_parent     	= $category_parent != '0' ? get_cat_name($category_parent) : '-';  
									$category_name1 		= $category_details['category_name'];
								?>
                      
                      
                      
                     <li><a href=""><?=$category_name1?>sds</a></li>
                      
                      <?php
					  
					  }
					  
					  ?>
                      </ul>
                       </li>
                      
                      <?php
                      } 
                      ?>
                     </ul>
                      
                      
                      
						       <!--  <li><a href="#">Solar Lighting System</a></li>
                                 <li><a href="#">Solar Cooking System</a></li>    -->
                         
                     </li>   
                     <?php  
					 */
					 ?>
                    <!-- 
                     <li><a href="#">Product</a>
                            <ul class="submenu">
                            <?php /*
                            $get_categories = get_cat_options(); ?>
                            <?php 
								foreach($get_categories as $category_detail)
								{
									$category_id 		= $category_detail['category_id'];
									$category_parent	= $category_detail['category_parent_id'];
									$category_parent    = $category_parent != '0' ? get_cat_name($category_parent) : '-';  
									$category_name 		= $category_detail['category_name'];
								?>
                      <li><a href="#"><?=$category_name?></a>
                      <ul class="sub-submenu">
                        <?php
                            $get_product = get_products_catdetail($category_id); ?>
                       
                            <?php 
							  //  pre($get_categories1);
								foreach($get_product as $product_details)
								{
									$product_id 			= $product_details['product_id'];
									$product_name		= $product_details['product_name'];
								?>
                      
                      
                      
                     <li><a href="product.php?product_id=<?=$product_id?>"><?=$product_name?></a></li>
                      
                      <?php
					  
					  }
					  
					  ?>
                      </ul>
                       </li>
                      
                      <?php
                      } */
                      ?>
                     </ul>
                      
                     </li>  -->
                     
             
                          <li><a href="#">Product</a>
                            <ul class="submenu">
                          <?php
                        /*    $get_product = get_product();
							
							
								foreach($get_product as $product_details)
								{
									$product_id 			= $product_details['product_id'];
									$product_name		= $product_details['product_name'];
									$product_category		= $product_details['product_category'];
									$product_category_0		= $product_details['product_category_0'];
								}
							
							if($product_category !=0 )
								{
						 */			
							 ?>
                       
                            <?php 
							     $get_product = get_products_group();
								foreach($get_product as $product_details)
								{
									$product_id 			= $product_details['product_id'];
									$product_name		= $product_details['product_name'];
									$product_category		= $product_details['product_category'];
									$product_category_0		= $product_details['product_category_0'];
								if($product_category !=0 )
								{
								
						 		$get_cat_name =  get_cat_name($product_category);
								?>
                      				<li><a href="#"><?=$get_cat_name?></a>
                               	 <?php
                               		 if($product_category_0 != 0)
									{ 
                               		 	?>
                                		<ul class="sub-submenu">
                        				<?php
										$get_cat_name1 =  get_cat_name($product_category_0);
							
										?>	<li><a href="#"><?=$get_cat_name1?></a>
                                
                      						<ul class="third-sub-submenu">
                        					<?php
									
                        			   			 $get_product = get_products_catdetail($product_category); ?>
                      	 
                      		     			 <?php 
								  			//  pre($get_categories1);
											foreach($get_product as $product_details)
											{
												$product_id 			= $product_details['product_id'];
												$product_name		= $product_details['product_name'];
											?>
                      	
                      	
                      	
                     			<li><a href="product.php?product_id=<?=$product_id?>"><?=$product_name?></a></li>
                      	
                      	<?php
					  
					  	}
					  
					  ?>
                      </ul>
                       </li>
                       </ul>
                       
                       <?php
                      }
					   else
					   {
					   ?>
					   	<ul class="sub-submenu">
                        
                        <?php
                        $get_product = get_products_catdetail($product_category); ?>
                       
                       
                      	 <?php
						//  pre($get_categories1);
						foreach($get_product as $product_details)
						{
								$product_id 			= $product_details['product_id'];
											$product_name		= $product_details['product_name'];
									?>
                      
                      
                      
                     	<li><a href="product.php?product_id=<?=$product_id?>"><?=$product_name?></a></li>
                      	
                        
                  		   	  <?php
					   		}
                       	
                      			 ?>
                           </ul>
                           <?php
						   } 
						   ?>
                       </li>
                     <?php
                      } 
					  else
					  {
					  ?>

					 <li><a href="product.php?product_id=<?=$product_id?>"><?=$product_name?></a> </li>
					 <?php 
					  }
					  }
                      ?>
                     </ul>
                      
                     </li>                       
                     
                     
                     
                     
                     
					    <li><a href="industrial.php">Industrial Solution</a></li>
                        <li><a href="bussiness.php">Business Opportunities</a></li>
						<li><a href="#">Media</a>
                             <ul class="submenu">
                                 <li><a href="download.php">Download</a></li>
						         <li><a href="gallery.php">Photo Galllery</a></li>
                                 <li><a href="event.php">Events</a></li>    
                                 <li><a href="certificate.php">Certification</a></li>    
                            </ul>
                        </li> 
                        <li><a href="career.php">Career</a></li>
						<li><a href="inquiry.php" class="highlight">Inquiry</a></li>
						<li><a href="#">Contact Us</a>
                            <ul class="submenu">
                                 <li><a href="contactus.php">Contact Us</a></li>
						         <li><a href="complain.php">Complain</a></li>
                                 <li><a href="feedback.php">Feedback</a></li>    
                            </ul>
                        </li>
                        
					</ul>
				</div>
             <div class="kosol-logo">
				<a href="index.php"><img src="images/kosol-logo.png" title="logo" /></a>
			</div>
				<div class="clear"> </div>
			</div>
	</div>
				<div class="clear"> </div>
                
                <!-- -->
            <div class="banner_logo">
            <div class="wrap1">
                <img src="images/banner-logo.png" width="50" height="50" />
             </div> 
                </div>
                <div id="sliderFrame">
                
               
                
                    <div id="slider">
                    <?php 
					$get_banner		= get_banner();
					
					
					foreach($get_banner as $banner_detail)
					{
						$banner_id 			= $banner_detail['banner_id'];
						$banner_name 		= $banner_detail['banner_name'];
						$banner_image 		= $banner_detail['banner_image'];
					?>
                        
                     <?php 
						$images = explode(',',$banner_image);
						for($i = 0; $i < count($images) ; $i++)
						{
						?>
						<img width="1209" height="350" src="<?=BANNERURL.$images[$i]?>">
						<?php 
							} 
							}
						?>   
                        
                     <!--  <img src="images/banner8.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner4.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner9.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner10.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner5.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner6.jpg" alt="Lorem ipsum dolor sit" />
                        <img src="images/banner7.jpg" alt="Lorem ipsum dolor sit" />    -->
                    </div>  
                </div>  
                <!-- -->
                
					<!--start-image-slider---->
					<!--<div class="image-slider">
						 
					    <ul class="rslides" id="slider1">
					      <li><img src="images/banner8.jpg" alt=""></li>
                          <li><img src="images/banner4.jpg" alt=""></li>
                          <li><img src="images/banner9.jpg" alt=""></li>
                          <li><img src="images/banner10.jpg" alt=""></li>
                          <li><img src="images/banner5.jpg" alt=""></li>
					      <li><img src="images/banner6.jpg" alt=""></li>
					      <li><img src="images/banner7.jpg" alt=""></li>
					    </ul>
						 
					</div>-->
					<!--End-image-slider---->
					<div class="clear"> </div>
                    