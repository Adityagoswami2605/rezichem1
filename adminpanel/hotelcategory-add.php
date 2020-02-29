<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(trim($_POST['hotelcategory_name']) == '')
	{
		$hotelcategory_name_error = '<label class="alert-danger fade in">This field is required.</label>';	
		$error = 1;
	}
	/*else if(check_cat_duplicate($_POST['hotelcategory_name']) != '0')
	{
		$hotelcategory_name_error = '<label class="alert-danger fade in">This hotelcategory already exists.</label>';	
		$error = 1;
		echo mysql_error();
	}*/
	/********************hotelcategory Icon******************************************11111**************** */
			
	
	if($_POST['product_hotelcategory']){
		$last_cat = end($_POST['product_hotelcategory']);
		if(!$last_cat){
			$last_cat = current(array_slice($_POST['product_hotelcategory'], -2));
		}
		$_POST['hotelcategory_parent_id'] =  $last_cat;
		unset($_POST['product_hotelcategory']);
	}
	
	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required information.</label>
                            </div>';
	}
	
	else
	{
			
			
			$_POST['hotelcategory_date'] = $current_date;
			$_POST['hotelcategory_slug'] = create_url_slug($_POST['hotelcategory_name']);	
			$insert_id = insert_data('hotelcategory',$_POST);
			if($insert_id)
			{
		//		update_hotelcategories_variation($insert_id,$pc_data);
				header('location:hotelcategories.php');
				exit;
			}
			else
			{
				echo mysql_error();
			}
	}	
}

$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Add hotel Category</title>
<?=$styles?>
<?=$javascripts?>
<script language="javascript" type="text/javascript">

$(document).ready(function(){

		var ajax_hotelcategory_url = 'ajax-hotelcategory-dropdown.php';

		$('.product_hotelcategory').live('change',function(){

				

				var cat_parent = $(this).val(); 
				var thisNode = $(this); 
				var data_rel = $(this).attr('data-rel'); 

				$.post(ajax_hotelcategory_url,{cat_parent:cat_parent,level:0,data_rel:data_rel}, function(data) {

					  if(data != '')
					  	//alert('.first_'+cat_parent);
						  $('.first_'+data_rel).remove();
						  //thisNode.attr('data-rel',1);
						  thisNode.parent().after(data);
						  //alert(thisNode.after());
						  //thisNode.remove('product_hotelcategory');
							
		

					  $('.product_hotelcategory_0').trigger('change');

				});

		});
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
		        <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading btn-primary">
                            Add Hotel Category
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" action="hotelcategory-add.php" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Hotel Category Name  [Add Hotel Category Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter hotelcategory name" name="hotelcategory_name" value="<?=$_POST['hotelcategory_name']?>"  />
									 <p class="help-block"><?=$hotelcategory_name_error;?></p>
                            	</div>
                            <!--   <div class="form-group">
                                    <label>Parent hotelcategory [select hotelcategory]  </label>
									<select class="form-control input-lg m-bot15 product_hotelcategory" name="hotelcategory_parent_id" data-rel="1"> 
										<option value="0">Main hotelcategory</option>
										<?php  /*
										$hotelcategory_options = get_multicat_options();
										// pre($hotelcategory_options);
										if(count($hotelcategory_options) > 0)
										{
											foreach($hotelcategory_options as $hotelcategory)
											{
												$selected = '';
												if($_POST['hotelcategory_parent_id'] == $hotelcategory['hotelcategory_id'])
												{
													$selected = 'selected=selected';
												}
												echo '<option value="'.$hotelcategory['hotelcategory_id'].'" '.$selected.'>'.$hotelcategory['hotelcategory_name'].'</option>';
											}
										}	 */
										?>
									</select>
							</div>
							-->
						<!--	<div class="form-group">
								<label>Summary  [Enter Short Description] </label>
                              <textarea rows="7" cols="90" class="input-short wyswing" name="hotelcategory_summary"><?=$_POST['hotelcategory_summary']?></textarea>
							</div>
							-->
								
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="hotelcategory_status" value="1" checked="checked" >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="hotelcategory_status" value="2">
										Draft
									</label>
								</div>
                             </div>
                                	<input type="submit" class="btn btn-info" value="Submit">
                            	</form>
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
