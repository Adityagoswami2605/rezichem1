<?php 

include('configure/configure.php');

include('auth.php');


$get_pages_count = get_pages_count();
$get_banner_count = get_banner_count();
$get_category_count = get_category_count();
$get_product_count = get_product_count();
$get_gallery_count = get_gallery_count();
$get_clients_count = get_clients_count();
$get_news_count = get_news_count();
$get_certificate_count = get_certificate_count();
$get_brochure_count = get_brochure_count();



$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,jquery.gritter.css');
$javascripts = include_js('lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,easypiechart/jquery.easypiechart.js,jQuery-slimScroll-1.3.0/jquery.slimscroll.js,jquery.gritter.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,gritter/gritter.js,scripts.js');

?>

<?=DOCTYPE;?>

<?=XMLNS;?>

<head>

<?=CONTENTTYPE;?>

<title>Administrator Panel</title>

<?=$styles?>
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/style-responsive.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/bs3/css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/bootstrap-reset.css" media="all" />
<?=$javascripts?>

<?=$assets?>

</head>

<body>

<section id="container">

    <!--header start-->

<?php  	include('header.php');?>

    <!--header end-->

    <!--sidebar start-->

<?php include('sidebar.php');?>

    <!--sidebar end-->

    <!--main content start-->

    <section id="main-content">

     <section class="wrapper">
        	<div class="row">
            <!--Box-->
            <div class="col-sm-12">
                <!-- Store manager-->
                <section class="panel">
                    <header class="panel-heading">
                        <div align="center">Welcome to <b><font size="+2"> Seawindsolution Pvt. Ltd. </font></b></div>
                        
                    </header>
                </section>
                <div class="row">
			<div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                          <?php
						/* 	$get_order_statuscount = get_order_statuscount(1);*/
			
						 ?>
                            <span><a href="pages.php"><?=$get_pages_count?></a>   </span>
                           Page
                           
                           
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                          <?php
						 /*	$get_order_statuscount = get_order_statuscount(1); */
			
						 ?>
                            <span><a href="banner.php"><?=$get_banner_count?></a> <a href="banner-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a></span>
                          Banner
                        </div>
                    </div>
                </div>
 	<div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="categories.php">
						<?=$get_category_count?>
                            </a>
                            
                            <a href="category-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          
                           Category
                         
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="products.php">
						<?=$get_product_count?>
                            </a>
                            
                            <a href="product-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          
                           Products
                         
                        </div>
                    </div>
                </div>
      
                <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="clients.php">
						<?=$get_clients_count?>
                            </a>
                            
                            <a href="clients-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          
                           Clients
                         
                        </div>
                    </div>
                </div> 
                
                   
                
               
                <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="news.php">
						<?=$get_news_count?>
                            </a>
                            
                            <a href="news-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          Events & Updates
                         
                        </div>
                    </div>
                </div> 
					
					 <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="certificate.php">
						<?=$get_news_count?>
                            </a>
                            
                            <a href="certificate-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          Award & Certificates
                         
                        </div>
                    </div>
                </div> 
					
					 <div class="col-md-3">
                    <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                         <?php
						
			?>
							<span><a href="brochure.php">
						<?=$get_news_count?>
                            </a>
                            
                            <a href="brochure-add.php">  <img src="images/plus.png" width="30" style="margin-left:20px;"> </a>
                            </span>
                          Download Brochure
                         
                        </div>
                    </div>
                </div> 
                
                
                <section class="panel">
                	<div class="panel-body">
                        <div class="col-sm-6">
                           <?=$notifications?>
                        </div>
                   </div>
                    
                </section>
                
            </div>
            <!--Box-->
            
            <div class="col-sm-12">
            
            
            
          <!--          <div class="col-md-6">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon pink"><i class="fa fa-eye"></i></span>
                            <div class="mini-stat-info">
                                <a href="products.php"><span>View</span>
                                Products</a>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon orange"><i class="fa fa-plus-circle"></i></span>
                            <div class="mini-stat-info">
                            <a href="product-add.php">
                                <span>Add Products</span>
                                 Products
                             </a>
                            </div>
                        </div>
                    </div>
              -->      
                    
                    
                    
                        <div class="col-md-6">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon tar"><i class="fa fa-cogs"></i></span>
                            <div class="mini-stat-info">
                            <a href="settings.php">
                                <span>Change Password</span>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                   
                
        
                     
                    <div class="modal fade" id="manageCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    	<div class="modal-header text-center">
                                            <h4 class="modal-title"><a href="<?=ADMINURL?>users.php">All Customers</a></h4>
                                        </div>
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title"><a href="<?=ADMINURL?>user-add.php">Add Customers</a></h4>
                                        </div>
                                        <!--<div class="modal-header text-center">
                                            <h4 class="modal-title"><a href="<?=ADMINURL?>">Comming Soon</a></h4>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            
        </section>

    </section>

    <!--main content end-->

	<!--right sidebar start-->

	<div class="right-sidebar">

		<div class="search-row">

			<input type="text" placeholder="Search" class="form-control">

		</div>

	</div>

	<!--right sidebar end-->

</section>

</body>

</html>