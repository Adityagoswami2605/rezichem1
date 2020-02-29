<?php 
include('configure/configure.php');
include('auth.php');

/* Filter */
$status = '';
// pre($_POST);
if($_POST > 0){
	if($_POST['txtcommision'] > 0){
		foreach($_POST['txtcommision'] as $key => $commision){
			$update = update_hotelcategory_commision($key,$commision);
		}
		
	}
}
if(($_REQUEST['hotelcategory_status'] != '' && is_numeric($_REQUEST['hotelcategory_status'])) || $_REQUEST['hotelcategory_parent_id'] != '')
{
	$params['hotelcategory_status'] 		= $status = $_REQUEST['hotelcategory_status'];
	$params['hotelcategory_parent_id'] 	= $hotelcategory_parent = $_REQUEST['hotelcategory_parent_id'];
	$get_hotelcategories = search_hotelcategories($params);
}
else
{
	$get_hotelcategories = get_hotelcategories();
}

$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Hotel categories</title>
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
				  if(i != total_checked) 
				  { 
						val += $(this).val()+',';  
				  }
				  else
				  {
						val += $(this).val();  
				  }
				  i++;
				});
				
				$.post('action.php', {action_type:action,action_module:'hotelcategory',actions_ids:val}, function(data) {
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
					<?php /* include('search-hotelcategory.php'); */  ?>
                    <header class="panel-heading btn-primary">
                        Hotel Categories
                    </header>
                    <div class="panel-body">
                       <a href="hotelcategory-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Hotel Categories</a>
					<form action="" method="post">
					<!--	<input type="submit" class="btn btn-info" value="Update Commision" style="float:right" />  -->
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
									<th>#</th>
                                    <th>Name</th>
								<!--	<th>Parent hotelcategory</th>  -->
                                 <!--   <th>hotelcategory Image</th> -->
                                 
                                    <th>Created Date</th> 
									<th>Status</th>
									<th>Action</th>
									
								</tr>
								</thead>
							 	<tbody>
								<?php 
								foreach($get_hotelcategories as $hotelcategory_detail)
								{
									$hotelcategory_id 			= $hotelcategory_detail['hotelcategory_id'];
									$hotelcategory_parent		= $hotelcategory_detail['hotelcategory_parent_id'];
									$hotelcategory_parent     	= $hotelcategory_parent != '0' ? get_cat_name($hotelcategory_parent) : '-';  
									$hotelcategory_name 			= $hotelcategory_detail['hotelcategory_name'];
								
									$hotelcategory_created 		= $hotelcategory_detail['hotelcategory_date'];
									$hotelcategory_status 		= $hotelcategory_detail['hotelcategory_status'] == '1' ? 'Published' : ($hotelcategory_detail['hotelcategory_status'] == '2' ? 'Draft' : 'Deleted') ;
								?>
							<tr class="gradeA">
								 <td class="align-center"><?=$hotelcategory_id?></td>
                                    <td><?=$hotelcategory_name?></td>
								<!--	<td><?=$hotelcategory_parent?></td> -->
                                <!--   <td><img width="100" height="100" src="<?=hotelcategory_THUMBURL.$hotelcategory_image?>"></td>  
									-->
                                  <td><?=$hotelcategory_created?></td>
                                    <td><?=$hotelcategory_status?></td>
                                    <td>
                                    	&nbsp;<input type="checkbox" name="hotelcategory_ids[]" value="<?=$hotelcategory_id?>" />&nbsp;
                                        <a href="<?=ADMINURL?>hotelcategory-edit.php?hotelcategory_id=<?=$hotelcategory_id?>"><img src="<?=IMAGEURL?>pencil.gif" width="16" height="16" alt="edit" /></a> 
                                    </td>
                                   
							</tr>
								<?php } ?>
								
							</tbody>
							
								<tfoot>
								
								</tfoot>
							</table>
						</div>
					</form>
                    </div>
					<header class="panel-heading btn-primary">
						<form action="">
						<div class="form-group">
							<label class="col-lg-3 col-sm-2">Apply action to selected:</label>
								<select class="input-medium" onChange="apply_actions(this.value)">
									<option value="" selected="selected">Select action</option>
									<option value="1">Published</option>
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
