<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
if($_REQUEST['gallery_status'] != '' && is_numeric($_REQUEST['gallery_status']))
{
	$status 	= $_REQUEST['gallery_status'];
	$get_gallery = search_gallery($status);
}

else
{
	$get_gallery		= get_gallery();
	
}	
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Gallery</title>
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
				
				$.post('action.php', {action_type:action,action_module:'gallery',actions_ids:val}, function(data) {
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
                    <?php include('search-gallerys.php');?>
						<header class="panel-heading btn-primary">
						Gallery
						</header>
						<div class="panel-body">
                           <a href="<?=ADMINURL?>gallery-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Gallery</a>
							<div class="adv-table">
								<table class="display table table-bordered table-striped" id="dynamic-table">
									<thead>
										<tr>
										<th>#</th>
										<th>Name</th>
                                        <th>Image</th>
										<th>Created Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php 
									foreach($get_gallery as $gallery_detail)
									{
										$gallery_id 			= $gallery_detail['gallery_id'];
										$gallery_name 		= $gallery_detail['gallery_name'];
										$gallery_image 		= $gallery_detail['gallery_image'];
										$gallery_created 		= $gallery_detail['gallery_created_date'];
										$gallery_status 		= $gallery_detail['gallery_status'] == '1' ? 'Published' : ($gallery_detail['gallery_status'] == '2' ? 'Draft' : 'Deleted');
									?>
								<tr class="gradeA">
									   <td class="align-center"><?=$gallery_id?></td>
										<td><?=$gallery_name?></td>
										<td>
									<?php 
										$images = explode(',',$gallery_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<a href="<?=GALLERYURL.$images[$i]?>" target="_blank"><img width="100" height="100" src="<?=GALLERY_THUMBURL.$images[$i]?>"></a>
										<?php 
										}
										?>
									</td>
                                        <td><?=$gallery_created?></td>
										<td><?=$gallery_status?></td>
										 
										<td>
										  &nbsp;<input type="checkbox" name="gallery_ids[]" value="<?=$gallery_id?>" />&nbsp;
											<a href="<?=ADMINURL?>gallery-edit.php?gallery_id=<?=$gallery_id?>"><img src="<?=IMAGEURL?>pencil.gif" width="16" height="16" alt="edit" /></a> 
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