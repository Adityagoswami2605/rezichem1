<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
$approve_status = '';
$users_name   = '';

 if(
	($_REQUEST['users_status'] != '' && is_numeric($_REQUEST['users_status'])) || 
	($_REQUEST['users_admin_status'] != '' && is_numeric($_REQUEST['users_admin_status'])) ||
	$_REQUEST['users_category'] != '' ||
	$_REQUEST['users_category_0'] != '' ||
	$_REQUEST['users_store'] != '' || 
	$_REQUEST['users_name'] != ''
	)
{
	$params['users_status'] 		= $status = $_REQUEST['users_status'];
	$params['users_admin_status']	= $approve_status = $_REQUEST['users_admin_status'];
	$params['users_category'] 	= $_REQUEST['users_category'];
	$params['users_category_0'] 	= $_REQUEST['users_category_0'];
	$params['users_store'] 		= $_REQUEST['users_store'];
	$params['users_name'] 		= $users_name = $_REQUEST['users_name'];
	$get_users = search_userss($params);
	
/*	pre($get_users);
	exit;
*/}
else
{
	$get_users = get_users();
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>users</title>
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
				
				$.post('action.php', {action_type:action,action_module:'users',actions_ids:val}, function(data) {
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
					<?php /* include('search-users.php'); */?>
                    <header class="panel-heading btn-primary">
                        users
                    </header>
					
                    <div class="panel-body">
                       
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr id="<?php echo $users_id; ?>" class="edit_tr">
                                        <th style="width:5%">#</th>
								
                                <!--    <th style="width:10%">users Sub Category</th> -->
                                    <th style="width:15%">Users Name</th>
                                    <th style="width:15%">Full Name</th> 
									 <th style="width:10%">Phone</th> 
                                  <th style="width:27%">Email</th> 
								   <th style="width:2%">Password</th> 								  									<th style="width:15%">Gender</th>
									<th style="width:2%">Address</th>
                                    <th style="width:2%">Birth Of Date</th>
                                    <th style="width:2%">Action</th>
                                            
										</tr>
								</thead>
							 	<tbody>
							   <?php 
								foreach($get_users as $users_detail)
								{
									$users_id 		= $users_detail['user_id'];
									$username = $users_detail['username'];
									$fullname = $users_detail['fullname'];
									$phone 		= $users_detail['phone'];
									$email 		= $users_detail['email'];
									$password 		= $users_detail['password'];
									$gender 		= $users_detail['gender'];
									$address 		= $users_detail['address'];
									$bod 		= $users_detail['bod'];
									$gender 	= $users_detail['gender'] == '1' ? 'Male' : 'Female';
									$users_status = $users_detail['user_status'] == '1' ? 'Published' : 'Draft';
									?>
							<tr class="gradeA">
								  <td class="align-center"><?=$users_id?></td>
                                  
                                     <td><?=$username?></a></td> 
                                    <td><?=$fullname?></a></td>
									<td><?=$phone?></td> 
									 <td><?=$email?></a></td> 
                                     <td><?=$password?></a></td> 
                                      <td><?=$gender?></a></td> 
                                <td><?=$address?>  </td>
                                    <td><?=$bod?></td>
                                    <td><?=$users_status?></td>
								                                        
									
                                    <td>
                                    	&nbsp;<input type="checkbox" name="users_ids[]" value="<?=$users_id?>" />&nbsp;
                                       
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