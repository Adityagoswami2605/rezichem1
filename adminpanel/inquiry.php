<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
if($_REQUEST['industrial_status'] != '' && is_numeric($_REQUEST['industrial_status']))
{
	$status 	= $_REQUEST['industrial_status'];
	$get_industrial = search_industrial($status);
}

else
{
	$get_inquiry		= get_inquiry();
	
}	
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Inquiry</title>
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
				
				$.post('action.php', {action_type:action,action_module:'career',actions_ids:val}, function(data) {
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
                    <?php include('search-careers.php');?>
						<header class="panel-heading btn-primary">
							Inquiry
						</header>
						<div class="panel-body">
                           <!--<a href="<?=ADMINURL?>career-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Career</a>-->
							<div class="adv-table">
								<table class="display table table-bordered table-striped" id="dynamic-table">
									<thead>
										<tr>
										<th>#</th>
										<th>Name</th>
                                        <th>Contact No</th>
                                        <th>Email Id</th>
                                     <!--   <th>Products</th> -->
                                    <!--    <th>Message</th> -->
								        <th>View Details</th>
										
										
									</tr>
									</thead>
									<tbody>
					<?php 
					foreach($get_inquiry as $industrial_detail)
					{
						$inquiry_id 	= $industrial_detail['inquiry_id'];
						$name     = $industrial_detail['name-c'];
						$city 		= $industrial_detail['city-c'];
						$mobile = $industrial_detail['contact-c'];
						$email = $industrial_detail['mail-c'];
						$product = $industrial_detail['product-c'];
						$message = $industrial_detail['message-c'];
							
									?>
								<tr class="gradeA">
									   <td class="align-center"><?=$inquiry_id?></td>
										<td><?=$name?></td>
                                    <!--    <td><?=$city?></td> -->
                                        
                                       <td><?=$mobile?></td>
                                        <td><?=$email?></td>
                                     <!--   <td><?=$product?></td> -->
                                    <!--    <td><?=$message?></td> -->
                                       <td>
										
											<a href="<?=ADMINURL?>inquiry-detail.php?inquiry_id=<?=$inquiry_id?>">View Details</a> 
										</td>
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
						<div class="table-apply">
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
						</div>
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
</html>