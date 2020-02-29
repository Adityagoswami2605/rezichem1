<?php 
include('configure/configure.php');
include('auth.php');
/* Filter */
$status = '';

if(
	
	$_REQUEST['en_store_id'] != '' 
	)
{
	$params['en_store_id'] 		= $_REQUEST['en_store_id'];
	
	$get_inquiries = search_inquiries($params);
	
/*	pre($get_product);
	exit;
*/}
else
{
	$get_inquiries = get_inquiries();
}


$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,dynamic_table/dynamic_table_init.js,jquery.dataTables.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Inquiries</title>
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
			var total_checked = $('#myTable input[type=checkbox]:checked').length;
			var i = 1;
			if(total_checked > 0 )
			{ 
				$('#myTable input[type=checkbox]:checked').each(function(){
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
				
				$.post('action.php', {action_type:action,action_module:'products',actions_ids:val}, function(data) {
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
                <?php include('search-inquiries.php');?>
                    <header class="panel-heading btn-primary">
                        Inquiries
                    </header>
					
                    <div class="panel-body">
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
									<th>Product ID</th>
                                    <th>Product</th>
									<th>Inquiry Message</th>
									<th>View details</th>
                                    <th>Inquiry By</th>
									<th>Inquiry Email</th>
									<th>Store</th>
									<th>Image</th>
									<th>Date</th>
								</tr>
								</thead>
							 	<tbody>
								<?php 
								foreach($get_inquiries as $product_inquiry_detail)
								{
									$product_id 			= $product_inquiry_detail['en_product_id'];
									$product_inquiry_id 	= $product_inquiry_detail['pr_en_id'];
									
									$product_detail         = get_products_detail($product_id);
									$product_name 			= $product_detail['product_name'];
									$product_image 			= $product_detail['product_image'];
									$product_inquiry	 	= $product_inquiry_detail['pr_enquiry'];
									$product_inquiry		= $product_inquiry != '' ? $product_inquiry : '-';
									
									$product_en_date 			= $product_inquiry_detail['pr_en_created_date'];
									$store_id =        $product_inquiry_detail['en_store_id'];
					
									
									$product_store	 		= get_storename($product_inquiry_detail['en_store_id']);
									$product_store			= $product_store != '' ? $product_store : '-';
									
									$username    = '-';
									$user_email  = '-';
									
									 
										 
										$username    = $product_inquiry_detail['u_name'];
										$user_email  = $product_inquiry_detail['u_email'];
									 
								?>
							<tr class="gradeA">
								 <td class="align-center"><?=$product_id?></td>
                                    <td><?=$product_name?></td>
									<td><?=$product_inquiry?></td>
                                      <td><a href="<?=ADMINURL?>message-details.php?enquiry_id=<?=$product_inquiry_id?>&en_product_id=<?=$product_id?>&store_id=<?=$store_id?>">View Details</a> </td>
									<td><?=$username?></td>
									<td><?=$user_email?></td>
									<td><?=$product_store?></td>
                                    <td>
									<?php 
										$images = explode(',',$product_image);
										for($i = 0; $i < 1 ; $i++)
										{
										?>
											<img width="60" height="60" src="<?=PRODUCT_THUMBURL.$images[$i]?>">
										<?php 
										}
										?>
									</td>
									<td><?=$product_en_date;?></td>
							</tr>
								<?php } ?>
								
							</tbody>
							
								<tfoot>
								
								</tfoot>
							</table>
						</div>
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
	</div>
	<!--right sidebar end-->
</section>
</body>
</html>