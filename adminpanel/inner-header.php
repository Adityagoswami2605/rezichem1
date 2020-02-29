	<?php 
$dash_tab_active = strpos($_SERVER['REQUEST_URI'],'index.php') > 0 ? 'class="current"' : '';
$about_tab_active = strpos($_SERVER['REQUEST_URI'],'about-us') > 0 ? 'class="current"' : '';
$advertise_tab_active = (strpos($_SERVER['REQUEST_URI'],'advertise-with-us') > 0 || strpos($_SERVER['REQUEST_URI'],'banner-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'banner-edit.php') > 0) ? 'class="current"' : '';
$testimonial_tab_active = (strpos($_SERVER['REQUEST_URI'],'our-testimonial') > 0 || strpos($_SERVER['REQUEST_URI'],'page-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'page-edit.php') > 0) ? 'class="current"' : '';


$contact_tab_active = (strpos($_SERVER['REQUEST_URI'],'contact-us') > 0 || strpos($_SERVER['REQUEST_URI'],'products-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'products-edit.php') > 0) ? 'class="current"' : '';



$terms_tab_active = (strpos($_SERVER['REQUEST_URI'],'terms-and-condition') > 0 || strpos($_SERVER['REQUEST_URI'],'category-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'category-edit.php') > 0) ? 'class="current"' : '';




$blog_tab_active = (strpos($_SERVER['REQUEST_URI'],'my-blog') > 0 || strpos($_SERVER['REQUEST_URI'],'blogcategory-') > 0 || strpos($_SERVER['REQUEST_URI'],'clients-edit.php') > 0) ? 'class="current"' : '';



$business_tab_active = (strpos($_SERVER['REQUEST_URI'],'business') > 0 || strpos($_SERVER['REQUEST_URI'],'gallery-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'gallery-edit.php') > 0) ? 'class="current"' : '';





$registration_tab_active = (strpos($_SERVER['REQUEST_URI'],'user') > 0 || strpos($_SERVER['REQUEST_URI'],'news-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'news-edit.php') > 0) ? 'class="current"' : '';



$login_tab_active = (strpos($_SERVER['REQUEST_URI'],'login') > 0 || strpos($_SERVER['REQUEST_URI'],'banner-add.php') > 0 || strpos($_SERVER['REQUEST_URI'],'banner-edit.php') > 0) ? 'class="current"' : '';





?>




<header class="ListingHeader">

         <div class="top-header">
             <div class="wrap">
                <div class="left-head">24/7 Call Us : +91 9898099515</div>
                <div class="center-head">
                    
                  
                     <!--     <select id="city" class="city1 city" name="location"  size="1" style="float:left;background:#fff;  position: absolute; width:120px !important; height: 27px !important; margin-bottom:4px; border:1px solid #fff;" onclick="window.location.href='location.php?location_slug='+this.value"> -->
      
   <!--   <select id="city" class="city1 city" name="location"  size="1" style="float:left;background:#fff;  position: absolute; width:120px !important; height: 27px !important; margin-bottom:4px; border:1px solid #fff;" onselect="selectlocation(this.value)">

              <option value=""> Select City </option> -->
           <?php
		/*   foreach($get_alllocation as $location )
		   {
				$location_id10 = $location['LOCATION_ID'];
				$location_name10 = $location['LOCATION_NAME'];
				$location_slug10 	= $location['LOCATION_SLUG'];
			?>	   
            <?php
			if($location_id10 == $get_location_slug_id)
			{
			?>
				<option value="<?=$location_slug10?>" selected="selected"><?=$location_name10?></option>
			<?php
            }
			else
			{
			?>
            
			    <option value="<?=$location_slug10?>"><?=$location_name10?></option>
		<?php	   
		   }
		   }  */
		   ?>
      <!--      </select>
          -->
          
      <!--    <select id="city" class="city1 city" name="location"  size="1" style="float:left;background:#fff;  position: absolute; width:120px !important; height: 27px !important; margin-bottom:4px; border:1px solid #fff;" onselect="selectlocation(this.value)">

              <option value=""> Select City </option>
          	<option value="Ahmedabad" selected="selected">Ahmedabad</option>
			</select> -->
            
              <form name="location" action="<?=SITEURL?>index.php" class="serch-form" method="post">
            <select id="" class="" name="location_slug"  size="1" onchange="submit();" >

              <option value=""> Select City </option>
                     <!--   <option value="Ahmedabad" selected="selected">Ahmedabad</option> -->

 <?php
                       foreach($get_alllocation as $location )
                       {
                            $location_id10 = $location['LOCATION_ID'];
                            $location_name10 = $location['LOCATION_NAME'];
                            $location_slug10 	= $location['LOCATION_SLUG'];
                        ?>	   
                        <?php
                        if($location_slug10 == $location_slug)
                        {
                        ?>
                            <option value="<?=$location_slug10?>" selected="selected"><?=$location_name10?></option>
                        <?php
                        }
                        else
                        {
                        ?>
                        
                            <option value="<?=$location_slug10?>"><?=$location_name10?></option>
                    <?php	   
                       }
                       }  
                       ?>

			</select>  
                    </form>
                   
					<form name="searchForm" class="serch-form"  method="post"  action="<?=SITEURL?>Wedding-Service">
         <!--           <input type="text" name="" value="" placeholder="What are you looking for?"/> -->
                     <input type="text" id="subcat_name" name="subcat_name"  value="" placeholder="What are you looking for?" onKeyUp="document.getElementById('txterror').innerHTML='';"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" />
                    
                    <input type="submit"  value="Search" />
                    
                   <!-- <button type="button" value="Search">Search</button> -->
                    </form>
                </div>
                <div class="right-head"><p><a href="#" class="need-help">Need Help?</a></p>
                     <div class="help-form">
                      <span class="help-i"><img src="images/help-i.png" /></span>  
                       <div class="h-form"> 
                            <h2>Find Everything you Need!</h2>
                             <form name="form21" method="post" action="need-help-mail.php">
                             <input type="text" name="name" value="<?=$_SESSION['USER_SHADI_USERNAME'];?>" placeholder="Name" required />
                             <input type="email" name="email" value="<?=$_SESSION['USER_SHADI_EMAIL'];?>" placeholder="Email" required />
                             <input type="text" name="contact" value="<?=$_SESSION['USER_SHADI_PHONE'];?>"  placeholder="Contact No." pattern="[789][0-9]{9}" required />
                             <input type="submit" name="submit" value="Submit" />
                             
                             <!-- <button type="button" name="">Submit</button> -->
                         <!--     <div class="quick-i">
                                  <span class="quick-c">
                                     <img src="images/list-page-logo.png" />
                                     <p>+91 99999 99999</p>
                                  </span>
                                  <span class="quick-chat">
                                     <img src="images/list-page-logo.png" />
                                     <p><a href="#">Live Chat</a></p>
                                  </span>
                                  <div class="clear"></div>
                              </div> -->
                             </form>
                        </div> 
                     </div>
                  
                </div> 
                <div class="clear"></div>    
             </div>
         </div>  

 <div class="nav-bg">
    <div class="wrap">  
        <div class="logo"><a href="<?=SITEURL?>index.php"><img src="<?=IMAGEURL?>list-page-logo.png" /></a></div>  
                          
        <ul>

        <li><a href="<?=SITEURL?>index.php"   style=" ">
             <img src="<?=IMAGEURL?>home.png" alt="home" />
             <span <?=$dash_tab_active?>>Home</span> 
        </a></li>

        <li><a href="<?=SITEURL?>about-us">
             <img src="<?=IMAGEURL?>aboutus.png" alt="about-us" />
             <span <?=$about_tab_active?> >About Us</span></a></li>

        <li><a href="<?=SITEURL?>advertise-with-us" >
             <img src="<?=IMAGEURL?>advertise.png" />
             <span <?=$advertise_tab_active?>>Advertise With Us</span></a></li>

    <!--    <li><a href="our-testimonial" <?=$testimonial_tab_active?>>Testimonials</a></li> -->

<!--        <li><a href="contact-us" <?=$contact_tab_active?>>Contact Us </a></li> -->

   <!--     <li><a href="terms-and-condition" <?=$terms_tab_active?>>Terms &amp; Conditions </a></li> -->

   <!--     <li><a href="my-blog" <?=$blog_tab_active?> >Blog </a></li> -->

       <!-- <li><a href="merchant-registration" class="link1">Merchant Registration </a></li> -->

<?php 

if($_SESSION['USER_SHADI_ID'] == '' || $_SESSION['USER_SHADI_ID'] != true ) { ?>  

      <li><a href="<?=SITEURL?>business" >
           <img src="<?=IMAGEURL?>business.png" />
           <span <?=$business_tab_active?> > Business Registration </span></a></li>

     <li><a href="<?=SITEURL?>user"  style="border:0px solid;">
           <img src="<?=IMAGEURL?>user.png" />
           <span <?=$registration_tab_active?>>User Registration</span></a></li>
        
     <li><a href="<?=SITEURL?>login"  style="border:0px solid;">
           <img src="<?=IMAGEURL?>login.png" />
           <span <?=$login_tab_active?> >Login</span></a>	</li>

      <?php

	  }

	  else

	  {

	  ?>

	  <li><a href="<?=SITEURL?>business" style="border:0px solid;">
         <img src="<?=IMAGEURL?>business.png" />
         <span <?=$business_tab_active?> >Business Registration </span></a></li>

	  <?php

	  }

      ?>

  <?php

      if($_SESSION['USER_SHADI_ID'] != '' || $_SESSION['USER_SHADI_ID'] == true ) { ?>  
      
      <li><a href="<?=SITEURL?>logout.php"  style="border:0px solid;">
           <img src="<?=IMAGEURL?>login.png" />
           <span <?=$login_tab_active?> >Logout</span></a>	</li>

        <li style="color:#74c5e0"> <b> Welcome <i><?=$_SESSION['USER_SHADI_USERNAME'];?> </i> </b> </li> 

<?php

}

?>

            

</ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
 </div>
 


      </header>

  <div class="clearall"></div>
