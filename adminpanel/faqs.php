<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';
if($_REQUEST['page_status'] != '' && is_numeric($_REQUEST['page_status']))
{
//	$params['product_status'] 		= $status = $_REQUEST['product_status'];
	$get_pages = search_pages($status);
	//$get_pages = search_pages($params);
}
else if(
	($_REQUEST['page_status'] != '' && is_numeric($_REQUEST['page_status'])) || 
	$_REQUEST['page_name'] != ''
	)
{
	$params['page_status'] 		= $status = $_REQUEST['page_status'];
	$params['page_name'] 		= $page_name = $_REQUEST['page_name'];
	$get_pages = search_page($params);
}
else
{
	$get_faq = get_faq();
}	
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Faqs</title>
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
				
				$.post('action.php', {action_type:action,action_module:'faqs',actions_ids:val}, function(data) {
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


<!-- Initiate tablesorter script -->
<script type="text/javascript">
	$(document).ready(function() { 
		$("#dynamic-table") 
		.tablesorter({
			// zebra coloring
			widgets: ['zebra'],
			// pass the headers argument and assing a object 
			headers: { 
				// assign the sixth column (we start counting zero) 
				6: { 
					// disable it by setting the property sorter to false 
					sorter: false 
				} 
			}
		}) 
	.tablesorterfaqr({container: $("#faqr")}); 
}); 
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
                <?php /* include('search-page.php');  */ ?>
                    <header class="panel-heading btn-primary">
                        Faqs
                    </header>
                    <div class="panel-body">
                       <a href="<?=ADMINURL?>faq-add.php" class="btn btn-success btn-round">
                            	<i class="fa fa-plus"></i>
                            	Add Faqs</a> 
                     <div class="adv-table"> 
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                      <th style="width:5%">#</th>
                                    <th style="width:59%">Questions</th>
                                    <th style="width:13%">Created Date</th>
						 <th style="width:13%">Modified Date</th>
                                    <th style="width:10%">Status</th>
                                    <th style="width:8%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    	      
                     				<?php 
								foreach($get_faq as $faq_detail)
								{
									$faq_id 		= $faq_detail['faq_id'];
									$faq_name 		= $faq_detail['faq_que'];
									$faq_created 	= $faq_detail['faq_created_date'];
									$faq_modify_date 	= $faq_detail['faq_modify_date'];
									$faq_status 	= $faq_detail['faq_status'] == '1' ? 'Published' : 'Draft';
									
								?>

                    <tr class="gradeA">
			 <td class="align-center"><?=$faq_id?></td>
                                    <td><?=$faq_name?></td>
                                    <td><?=$faq_created?></td>
									<td><?=$faq_modify_date?></td>
                                    <td><?=$faq_status?></td>
                                    <td>
                                    	&nbsp;<input type="checkbox" name="faq_ids[]" value="<?=$faq_id?>" />&nbsp;
                                       <a href="<?=ADMINURL?>faq-edit.php?faq_id=<?=$faq_id?>"><img src="<?=IMAGEURL?>pencil.gif"  width="16" height="16" alt="edit" /></a> 
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
