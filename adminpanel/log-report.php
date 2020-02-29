<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
if($_REQUEST['report_status'] != '' && is_numeric($_REQUEST['report_status']))
{
	$status 	= $_REQUEST['report_status'];
	$get_report = search_report($status);
}

else
{
	$get_report		= get_report();
	
}	
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Report</title>
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
				
				$.post('action.php', {action_type:action,action_module:'report',actions_ids:val}, function(data) {
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
                    <?php include('search-reports.php');?>
						<header class="panel-heading btn-primary">
						Login Report
						</header>
						<div class="panel-body">
                         
							<div class="adv-table">
								<table class="display table table-bordered table-striped" id="dynamic-table">
									<thead>
										<tr>
										<th>#</th>
										<th>Login Date</th>
                                        <th>Login Time</th>
									</tr>
									</thead>
									<tbody>
									<?php 
									foreach($get_report as $report_detail)
									{
										$report_id 			= $report_detail['report_id'];
										$report_date		= $report_detail['report_date'];
										$report_time 		= $report_detail['report_time'];
									
									?>
								<tr class="gradeA">
									   <td class="align-center"><?=$report_id?></td>
										<td><?=$report_date?></td>
									    <td><?=$report_time?></td>
										
								</tr>
									<?php } ?>
									
								</tbody>
									<tfoot>
									</tfoot>
								</table>
							</div>
						</div>
						<section class="panel">
						<header class="panel-heading btn-primary">
						<!--<div class="table-apply">
							<form action="">
							<div class="form-group">
							<span>Apply action to selected:</span> 
							<select class="" onChange="apply_actions(this.value)">
								<option value="" selected="selected">Select action</option>
								<option value="1">Publish</option>
								<option value="2">Draft</option>
								<option value="3">Delete</option>
							</select>
							</div>
							</form>
						</div> -->
						</header>
					</section>
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
<?php include('footer.php');?>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
