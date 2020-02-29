<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
$approve_status = '';
$news_name   = '';

 if(
	($_REQUEST['news_status'] != '' && is_numeric($_REQUEST['news_status'])) || 
	($_REQUEST['news_admin_status'] != '' && is_numeric($_REQUEST['news_admin_status'])) ||
	$_REQUEST['news_category'] != '' ||
	$_REQUEST['news_category_0'] != '' ||
	$_REQUEST['news_store'] != '' || 
	$_REQUEST['news_name'] != ''
	)
{
	$params['news_status'] 		= $status = $_REQUEST['news_status'];
	$params['news_admin_status']	= $approve_status = $_REQUEST['news_admin_status'];
	$params['news_category'] 	= $_REQUEST['news_category'];
	$params['news_category_0'] 	= $_REQUEST['news_category_0'];
	$params['news_store'] 		= $_REQUEST['news_store'];
	$params['news_name'] 		= $news_name = $_REQUEST['news_name'];
	$get_news = search_newss($params);
	
/*	pre($get_news);
	exit;
*/}
else
{
	$get_news = get_news();
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>News</title>
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
				
				$.post('action.php', {action_type:action,action_module:'news',actions_ids:val}, function(data) {
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
					<?php /* include('search-news.php'); */?>
                    <header class="panel-heading btn-primary">
                        Updates
                    </header>
					
                    <div class="panel-body">
                       <a href="<?=ADMINURL?>news-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Update</a>
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr id="<?php echo $news_id; ?>" class="edit_tr">
                                        <th style="width:5%">#</th>
								
                                <!--    <th style="width:10%">news Sub Category</th> -->
                                    <th style="width:15%">Updates Name</th>
                             <th style="width:15%">News Date</th> 
										<!-- <th style="width:10%">news Category</th> --> 
                                   <th style="width:27%">Image</th>  
								  <!--  <th style="width:2%">Download PDF</th> -->
								  <th style="width:15%">Created Date</th>
									<th style="width:2%">Status</th>
                                    <th style="width:2%">Action</th>
                                            
										</tr>
								</thead>
							 	<tbody>
							   <?php 
								foreach($get_news as $news_detail)
								{
									$news_id 		= $news_detail['news_id'];
									$news_name 		= $news_detail['news_name'];
									$news_date 		= $news_detail['news_date'];
									$news_image 		= $news_detail['news_image'];
									$news_created_date 		= $news_detail['news_created_date'];
									$news_status = $news_detail['news_status'] == '1' ? 'Published' : 'Draft';
								?>
							<tr class="gradeA">
								  <td class="align-center"><?=$news_id?></td>
                                  
                                  <!--   <td><?=$get_sub_name?></a></td> -->
                                    <td><?=$news_name?></td>
                                    <td><?=$news_date?></td>
								<!--	<td><?=$news_desc?></td> -->
								<!--	 <td><?=$get_name?></a></td> -->
                                    <td>
                                    <?php 
									
									$images = explode(',',$news_image);
									for($i = 0; $i < count($images) ; $i++)
									{
									?>
										<img src="<?=NEWS_THUMBURL.$images[$i]?>" width="100">
									<?php 
									}
									 ?>
                                    </td> 
                              <!--  <td>
								   <a href="<?=newsURL.$news_file?>" class="fr" target="_blank"><?=$news_file?></a>
								   </td>  -->
                                    <td><?=$news_created_date?></td>
                                    <td><?=$news_status?></td>
								                                        
									
                                    <td>
                                    	&nbsp;<input type="checkbox" name="news_ids[]" value="<?=$news_id?>" />&nbsp;
                                        <a href="<?=ADMINURL?>news-edit.php?news_id=<?=$news_id?>"><img src="images/pencil.gif" width="16" height="16" alt="edit" /></a> 
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