<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
		$stocks	=	$_POST['product_id'];
	 	$stock_pro	= 	product_stock_options($stocks);	
		
	if(trim($_POST['ALL_STOCK']) >=  $stock_pro )
	{	
			$stock_overflow ='is more than stock Quantity ' ;
	}
	
		
	if(trim($_POST['ALL_STOCK']) == '' or !is_numeric($_POST['ALL_STOCK']))
	{
		$stock_name_error = '<span class="notification-input ni-error">This field should be Numeric.</span>';	
		$error = 1;
	}
	
	
	if(distributer_duplicate(trim($_POST['ALL_PARENT_ID'])) > 0)
	{
		$user_name_error = '<span class="notification-input ni-error">User Already Exists.</span>';	
		$error = 1;
	}
	
	
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
		   	$code	=	$_POST['product_id'];
			$pro_code	= 	product_code($code);
			$_POST['ALL_PRODUCT_CODE'] =  $pro_code;
		
			if($_POST['ALL_USER_TYPE'] == '1')
			{
					 $dealer =  $_POST['ALL_NAME'];
					
				$distri	 =   get_dealer_name($dealer);
			   $dt    =  	$_POST['ALL_USER_NAME'] = $distri;
			}
			
			else
			{
				$dealer1 =  $_POST['ALL_NAME'];
				$distri1	 =   get_vendor_name($dealer1);
			    $dt1    =  	$_POST['ALL_USER_NAME'] = $distri1;
			}
			
			
			
			$_POST['ALL_DATE'] = $current_date;
					
			
			
				$insert_id = insert_data('allotment',$_POST);
			
			if($insert_id)
			{
				header('location:orders.php');
				exit;
			}	
		}	
}

$styles 	 = include_styles('reset.css,grid.css,styles.css,jquery.wysiwyg.css,tablesorter.css,thickbox.css,theme-blue.css');
$javascripts = include_js('jquery-1.3.2.min.js,jquery.wysiwyg.js,jquery.tablesorter.min.js,jquery.tablesorter.pager.js,jquery.pstrength-min.1.2.js,js/thickbox.js,jquery.MultiFile.js');

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Add-Order | Seawind Solution CMS</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--icheck-->
    <link href="assets/iCheck-master/skins/minimal/minimal.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/minimal/red.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/minimal/green.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/minimal/blue.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/minimal/yellow.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/minimal/purple.css" rel="stylesheet">

    <link href="assets/iCheck-master/skins/square/square.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/square/red.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/square/green.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/square/blue.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/square/yellow.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/square/purple.css" rel="stylesheet">

    <link href="assets/iCheck-master/skins/flat/grey.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/flat/red.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/flat/green.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/flat/blue.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/flat/yellow.css" rel="stylesheet">
    <link href="assets/iCheck-master/skins/flat/purple.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
     <link rel="stylesheet" href="assets/bootstrap-switch-master/build/css/bootstrap3/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<?=$styles?>
<?=$javascripts?>

<script language="javascript" type="text/javascript">
$(document).ready(function(){
		var ajax_category_url = 'ajax-sample-dropdown.php';
		$('.ALL_USER_TYPE').change(function(){
				
				var cat_parent = $(this).val(); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:0}, function(data) {
					  if(data != '')
						  $('.ALL_NAME').html(data);
					  
					  
					  $('.ALL_NAME').trigger('change');
				});
		});
		/*$('.product_category_0').change(function(){
				
				var cat_parent = $(this).val(); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:1}, function(data) {
					  if(data != '')
						  $('.product_category_1').html(data);
				});
		});*/
		
		
		
		var characters = 100;
		$("#counter_summary").append("You have <strong>"+  characters+"</strong> characters remaining");
		$("#product_brief").keyup(function(){
			if($(this).val().length > characters){
				$(this).val($(this).val().substr(0, characters));
			}
			var remaining = characters -  $(this).val().length;
			$("#counter_summary").html("You have <strong>"+  remaining+"</strong> characters remaining");
			if(remaining <= 10)
			{
				$("#counter_summary").css("color","red");
			}
			else
			{
				$("#counter_summary").css("color","black");
			}
		});
});
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!--<script type="text/javascript">     
$(document).ready(function() {     
$('#ALL_USER_TYPE').change(function(){     
if($(ALL_USER_TYPE).val() === '1')     
   {     
   $('#ALL_NAME').show();
   $('#ALL_NAME1').hide();   
   }    
else    
   {     
   $('#ALL_NAME').hide();
   $('#ALL_NAME1').show();   
   }     
});     
});     
</script>-->
<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->
<!--META-->
<!--STYLESHEETS-->
<link href="../adminpanel/css/form.css" rel="stylesheet" type="text/css" />
<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->
<script></head>
<script language="Javascript" src="ckeditor/ckeditor.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>
<body>

<section id="container" >
<!--header start-->
<?php include("header.php");?>
<!--header end-->
 <?php include("leftmenu.php");?>
<!--sidebar end-->
    <!--main content start-->
    <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
      
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Add-Order
            </header>
            <div class="panel-body">
                            <form role="form" class="form-horizontal" action="add-order.php" method="post"  enctype="multipart/form-data">
                                
								<div class="form-group">
								  <label class="col-lg-3 control-label">User Type</label>
                                  <div class="col-lg-6">
                                     <select class="form-control  ALL_USER_TYPE" name="ALL_USER_TYPE" id="ALL_USER_TYPE">
				<option vualue="0">Select User Type </option>
				<option value="1" <?php if($_POST['ALL_USER_TYPE'] == 1 ) { echo 'selected=selected'; }?>>Distributor</option>
				<option value="2" <?php if($_POST['ALL_USER_TYPE'] == 2 ) { echo 'selected=selected'; }?>>Retailer</option>
        </select>
                                 </div>
								</div> 
								<div class="form-group">
								  <label class="col-lg-3 control-label">User Name</label>
                                  <div class="col-lg-6">
                                    <select class="form-control ALL_NAME" name="ALL_NAME" id="ALL_NAME">
            <option value="0">Select</option>
            </select>
                                 </div>
								</div> 
								<div class="form-group">
								  <label class="col-lg-3 control-label">Product</label>
                                  <div class="col-lg-6">
                                     <select class="form-control product_id" name="product_id" id="product_id">
            <option value="0">Select</option>
            <?php 
            $cat_options = product_allot_options();
            if(count($cat_options) > 0 )
            {
            foreach($cat_options as $cat)
            {
            echo '<option value="'.$cat['product_id'].'">'.$cat['product_name'].'</option>';
			}
		}	
		
        ?> 
       </select>
	                               </div>
								</div> 
			                 <div class="form-group">
								  <label class="col-lg-3 control-label">Order Type</label>
                                  <div class="col-lg-6">
                                     <select class="form-control  ALL_SP_TYPE" name="ALL_SP_TYPE" id="ALL_SP_TYPE">
				<option vualue="0">Select Order Type </option>
				<option value="1" <?php if($_POST['ALL_SP_TYPE'] == 1 ) { echo 'selected=selected'; }?>>Sales Order</option>
				<option value="2" <?php if($_POST['ALL_SP_TYPE'] == 2 ) { echo 'selected=selected'; }?>>Purchase Order</option>
        </select>
                                 </div>
								</div> 				   
								
								<div class="form-group has-success">
                                    <label class="col-lg-3 control-label">Quantity</label>
                                    <div class="col-lg-6">
                                        <input type="text" id="f-name" class="form-control" name="ALL_STOCK" value="<?=$_POST['ALL_STOCK']?>" placeholder=" Only Numeric value"  >
                                   <?php echo $stock_name_error;?>
		 <?php $stock_overflow ?>      
                                    </div>
                                </div> 
								
                                 <div class="form-group">
                                <label class="control-label col-md-3">Default Datepicker</label>
                                <div class="col-md-4 col-xs-11">
                                    <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" value="" />
                                    <span class="help-block">Select date</span>
                                </div>
                            </div>
								
								<div class="form-group has-success">
                                    <label class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-6">
                                         <ul>
        <li><label><input type="radio" name="ALL_STATUS" value="1" checked="checked" /> Pending</label></li>
        <li><label><input type="radio" name="ALL_STATUS" value="2" /> Confirmed</label></li>
                 </ul>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                           
                   
                            </form>
                        </div>
        </section>
   
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
<ul class="right-side-accordion">
<li class="widget-collapsible">
    <a href="#" class="head widget-head red-bg active clearfix">
        <span class="pull-left">work progress (5)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="prog-row side-mini-stat clearfix">
                <div class="side-graph-info">
                    <h4>Target sell</h4>
                    <p>
                        25%, Deadline 12 june 13
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="target-sell">
                    </div>
                </div>
            </div>
            <div class="prog-row side-mini-stat">
                <div class="side-graph-info">
                    <h4>product delivery</h4>
                    <p>
                        55%, Deadline 12 june 13
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="p-delivery">
                        <div class="sparkline" data-type="bar" data-resize="true" data-height="30" data-width="90%" data-bar-color="#39b7ab" data-bar-width="5" data-data="[200,135,667,333,526,996,564,123,890,564,455]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="prog-row side-mini-stat">
                <div class="side-graph-info payment-info">
                    <h4>payment collection</h4>
                    <p>
                        25%, Deadline 12 june 13
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="p-collection">
						<span class="pc-epie-chart" data-percent="45">
						<span class="percent"></span>
						</span>
                    </div>
                </div>
            </div>
            <div class="prog-row side-mini-stat">
                <div class="side-graph-info">
                    <h4>delivery pending</h4>
                    <p>
                        44%, Deadline 12 june 13
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="d-pending">
                    </div>
                </div>
            </div>
            <div class="prog-row side-mini-stat">
                <div class="col-md-12">
                    <h4>total progress</h4>
                    <p>
                        50%, Deadline 12 june 13
                    </p>
                    <div class="progress progress-xs mtop10">
                        <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                            <span class="sr-only">50% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head terques-bg active clearfix">
        <span class="pull-left">contact online (5)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="prog-row">
                <div class="user-thumb">
                    <a href="#"><img src="images/avatar1_small.jpg" alt=""></a>
                </div>
                <div class="user-details">
                    <h4><a href="#">Jonathan Smith</a></h4>
                    <p>
                        Work for fun
                    </p>
                </div>
                <div class="user-status text-danger">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <a href="#"><img src="images/avatar1.jpg" alt=""></a>
                </div>
                <div class="user-details">
                    <h4><a href="#">Anjelina Joe</a></h4>
                    <p>
                        Available
                    </p>
                </div>
                <div class="user-status text-success">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <a href="#"><img src="images/chat-avatar2.jpg" alt=""></a>
                </div>
                <div class="user-details">
                    <h4><a href="#">Jhone Doe</a></h4>
                    <p>
                        Away from Desk
                    </p>
                </div>
                <div class="user-status text-warning">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <a href="#"><img src="images/avatar1_small.jpg" alt=""></a>
                </div>
                <div class="user-details">
                    <h4><a href="#">Mark Henry</a></h4>
                    <p>
                        working
                    </p>
                </div>
                <div class="user-status text-info">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <a href="#"><img src="images/avatar1.jpg" alt=""></a>
                </div>
                <div class="user-details">
                    <h4><a href="#">Shila Jones</a></h4>
                    <p>
                        Work for fun
                    </p>
                </div>
                <div class="user-status text-danger">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <p class="text-center">
                <a href="#" class="view-btn">View all Contacts</a>
            </p>
        </li>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head purple-bg active">
        <span class="pull-left"> recent activity (3)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        just now
                    </p>
                    <p>
                        <a href="#">John Sinna </a>Purchased new equipments for zonal office setup
                    </p>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        2 min ago
                    </p>
                    <p>
                        <a href="#">Sumon </a>Purchased new equipments for zonal office setup
                    </p>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        1 day ago
                    </p>
                    <p>
                        <a href="#">Mosaddek </a>Purchased new equipments for zonal office setup
                    </p>
                </div>
            </div>
        </li>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head yellow-bg active">
        <span class="pull-left"> shipment status</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="col-md-12">
                <div class="prog-row">
                    <p>
                        Full sleeve baby wear (SL: 17665)
                    </p>
                    <div class="progress progress-xs mtop10">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% Complete</span>
                        </div>
                    </div>
                </div>
                <div class="prog-row">
                    <p>
                        Full sleeve baby wear (SL: 17665)
                    </p>
                    <div class="progress progress-xs mtop10">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            <span class="sr-only">70% Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>
</ul>
</div>
<!--right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/lib/jquery.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/accordion-menu/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scrollTo/jquery.scrollTo.min.js"></script>
<script src="js/nicescroll/jquery.nicescroll.js" type="text/javascript"></script>
<!--Easy Pie Chart-->
<script src="assets/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="assets/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="assets/flot-chart/jquery.flot.js"></script>
<script src="assets/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="assets/flot-chart/jquery.flot.resize.js"></script>
<script src="assets/flot-chart/jquery.flot.pie.resize.js"></script>

<script src="assets/iCheck-master/jquery.icheck.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--icheck init -->
<script src="js/icheck/icheck-init.js"></script>

</body>
</html>
