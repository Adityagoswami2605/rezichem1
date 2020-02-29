<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */


if($_POST > 0){

	if($_POST['txtcommision'] > 0){
	

		foreach($_POST['txtcommision'] as $key => $commision){
	if(hotel_seq_duplicate($key,$commision))
	{
		$hotel_seq_error = '<span class="notification-input ni-error">This Sequence Already Exists.</span>';	
		$error = 1;
	}
	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required information.</label>
                            </div>';
	}
	else
	{

			$update = update_hotel_seq($key,$commision);
			header('location:hotels.php');
				exit;
			
	}		
		}
		
	}
}



$status = '';
$approve_status = '';
$hotel_name   = '';

 if(
	($_REQUEST['hotel_status'] != '' && is_numeric($_REQUEST['hotel_status'])) || 
	($_REQUEST['hotel_admin_status'] != '' && is_numeric($_REQUEST['hotel_admin_status'])) ||
	$_REQUEST['hotel_category'] != '' ||
	$_REQUEST['hotel_category_0'] != '' ||
	$_REQUEST['hotel_store'] != '' || 
	$_REQUEST['hotel_name'] != ''
	)
{
	$params['hotel_status'] 		= $status = $_REQUEST['hotel_status'];
	$params['hotel_admin_status']	= $approve_status = $_REQUEST['hotel_admin_status'];
	$params['hotel_category'] 	= $_REQUEST['hotel_category'];
	$params['hotel_category_0'] 	= $_REQUEST['hotel_category_0'];
	$params['hotel_store'] 		= $_REQUEST['hotel_store'];
	$params['hotel_name'] 		= $hotel_name = $_REQUEST['hotel_name'];
	$get_hotel = search_hotels($params);
	
/*	pre($get_hotel);
	exit;
*/}
else
{
	$get_hotel = get_hotels();
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Hotels</title>
<?=$styles?>
<?=$javascripts?>
<script language="javascript" type="text/javascript">
function apply_actions(action)
{
	if(action == '')
	{
		alert('Please select action');
		return false;
	}
	if(confirm('Do you really want to take this action?'))
	{
			var val = '';
			var total_checked = $('#dynamic-table input[type=checkbox]:checked').length;
			var i = 1;
			if(total_checked > 0 )
			{ 
				$('#dynamic-table input[type=checkbox]:checked').each(function(){
				var str = $(this).val();
					var storecode = '<?php echo PRODID ?>';
					var newval = str.replace(storecode,''); 
				  if(i != total_checked) 
				  { 
						val += newval+',';  
				  }
				  else
				  {
						val += newval;  
				  }
				  i++;
				});
				
				$.post('action.php', {action_type:action,action_module:'hotels',actions_ids:val}, function(data) {
					window.location = location.href;
				});
			}
			else
			{
				alert('Please select atleast one record');
				return false;
			}	
	 }	
	 else
	 {
	 	return false;
	 }
}
</script>
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
            <div class="col-sm-12">
                <section class="panel">
					<?php /* include('search-hotels.php'); */?>
                    <header class="panel-heading btn-primary">
                        Hotels
                    </header>
					
                    <div class="panel-body">
                       <a href="<?=ADMINURL?>hotel-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Hotels</a>
                                       	<form action="" method="post">
				<!--		<input type="submit" class="btn btn-info" value="Update hotel Priority" style="float:right" />
                        
                     <p class="help-block" style="color: #A94442;background-color: #F2DEDE;border-color: #EBCCD1; width:300px;"> <?=$hotel_seq_error?></p>  
					-->
                    	<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr id="<?php echo $hotel_id; ?>" class="edit_tr">
                                        <th style="width:5%">#</th>
								
                                <!--    <th style="width:10%">hotel Sub Category</th> -->
                                    <th style="width:15%">Hotel Name</th>
										 <th style="width:10%">Hotel Category</th>  
                                   <th style="width:27%">Image</th> 
								<!--    <th style="width:2%">Download PDF</th> -->
								  <th style="width:15%">Created Date</th>
                              <!--    <th>hotel Priority</th> -->
									<th style="width:2%">Status</th>
                                    <th style="width:2%">Action</th>
                                            
										</tr>
								</thead>
							 	<tbody>
							   <?php 
								foreach($get_hotel as $hotel_detail)
								{
									$hotel_id 		= $hotel_detail['hotel_id'];
									$hotel_category 	= $hotel_detail['hotel_category'];
									//$hotel_category_0 = $hotel_detail['hotel_category_0'];
									$hotel_name 		= $hotel_detail['hotel_name'];
									//$hotel_price 		= $hotel_detail['hotel_price'];
									//$hotel_size 		= $hotel_detail['hotel_size'];
									//$hotel_image 		= $hotel_detail['hotel_image'];
									//$hotel_video 		= $hotel_detail['hotel_video'];
									$hotel_image 		= $hotel_detail['hotel_image'];
									$hotel_date 		= $hotel_detail['hotel_created_date'];
									$hotel_file 		= $hotel_detail['hotel_file'];
									$hotel_seq 		= $hotel_detail['hotel_seq'];
									$hotel_status = $hotel_detail['hotel_status'] == '1' ? 'Published' : 'Draft';
									$get_name = get_hotelcat_name($hotel_category);
									//$get_sub_name = get_cat_name($hotel_category_0);
								?>
							<tr class="gradeA">
								  <td class="align-center"><?=$hotel_id?></td>
                                  
                                  <!--   <td><?=$get_sub_name?></a></td> -->
                                    <td><?=$hotel_name?></td>
									 <td><?=$get_name?></td> 
                                    <td>
                                    <?php 
									$images = explode(',',$hotel_image);
									for($i = 0; $i < count($images) ; $i++)
									{
									?>
										<img src="<?=HOTEL_THUMBURL.$images[$i]?>" width="100">
									<?php 
									}
									?>
                                    </td>
                              <!--  <td>
								   <a href="<?=hotelURL.$hotel_file?>" class="fr" target="_blank"><?=$hotel_file?></a>
								   </td> 
                                  -->
                                    <td><?=$hotel_date?></td>
                               <!--     <td>                                      
                                        <input type="text" name="txtcommision[<?=$hotel_id?>]" value="<?=$hotel_seq?>" style="width:50px"; />
                                    </td>  -->
                                    <td><?=$hotel_status?></td>
								                                        
									
                                    <td>
                                    	&nbsp;<input type="checkbox" name="hotel_ids[]" value="<?=$hotel_id?>" />&nbsp;
                                        <a href="<?=ADMINURL?>hotel-edit.php?hotel_id=<?=$hotel_id?>"><img src="images/pencil.gif" width="16" height="16" alt="edit" /></a> 
                                    </td>
							</tr>
								<?php } ?>
								
							</tbody>
							
								<tfoot>
								
								</tfoot>
							</table>
						</div>
                    </div>
					<header class="panel-heading btn-primary">
						<form action="">
						<div class="form-group">
							<label class="col-lg-3 col-sm-2">Apply action to selected:</label>
								<select class="input-medium" onChange="apply_actions(this.value)">
									<option value="" selected="selected">Select action</option>
									<option value="1">Publish</option>
									<option value="2">Draft</option>
									<option value="3">Delete</option>
								</select>
						</div>
						</form>
					</header>
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
	</div>
	<!--right sidebar end-->
</section>
</body>
</html>
