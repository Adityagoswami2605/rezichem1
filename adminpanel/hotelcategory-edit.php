<?php 
include('configure/configure.php');
include('auth.php');

$hotelcategory_id = $_REQUEST['hotelcategory_id'];

if($hotelcategory_id != '' && is_numeric($hotelcategory_id))

{
	$hotelcategory_detail 		= get_hotelcategory_detail($hotelcategory_id);
	if(!$hotelcategory_detail)
	{
		header('location:hotelcategories.php');
		exit;
	}
	
	$hotelcategory_name 			= $hotelcategory_detail['hotelcategory_name'];
	$hotelcategory_parent 		= $hotelcategory_detail['hotelcategory_parent_id'];
	$hotelcategory_summary 		= $hotelcategory_detail['hotelcategory_summary'];

	$hotelcategory_status 		= $hotelcategory_detail['hotelcategory_status'];
}
else
{
	header('location:hotelcategories.php');
	exit;
}

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(check_cat_duplicate($_POST['hotelcategory_name']) != 0 && $_POST['hotelcategory_name'] != $hotelcategory_name)
	{
		$hotelcategory_name_error = '<span class="notification-input ni-error">hotelcategory name already exists.</span>';	
		$error = 1;
		$hotelcategory_name = $_POST['hotelcategory_name'];
	}
	else if(trim($_POST['hotelcategory_name']) == '')
	{
		$_POST['hotelcategory_name'] = $hotelcategory_name;
	}
	
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
	
		/*
			
			if($_POST['product_hotelcategory']){
				$last_cat = end($_POST['product_hotelcategory']);
				if(!$last_cat){
					$last_cat = current(array_slice($_POST['product_hotelcategory'], -2));
				}
				$_POST['hotelcategory_parent_id'] =  $last_cat;
				unset($_POST['product_hotelcategory']);
			}
		*/
			$_POST['hotelcategory_date'] = $current_date;
			$_POST['hotelcategory_slug'] = create_url_slug($_POST['hotelcategory_name']);	
			
			$update_id = update_data('hotelcategory',$_POST,'hotelcategory_id='.$hotelcategory_id);
			
			
			header('location:hotelcategories.php');
			exit;

			// $_POST['hotelcategory_modify_date'] = $current_date;
			// $update_id = update_data('hotelcategory',$_POST,'hotelcategory_id='.$hotelcategory_id);
			// header('location:hotelcategories.php');
			// exit;
	}	
	
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery.MultiFile.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Edit Hotel Category</title>
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
						//alert(data_rel);
						  //$('.first_'+data_rel).remove();
						    for (var i=Number(data_rel);i<20;i++)
							{
							$('.first_'+i).remove();
							}
						  //thisNode.attr('data-rel',1);
						  thisNode.parent().after(data);
						  //alert(thisNode.after());
						  //thisNode.remove('product_hotelcategory');
							//$('.first_'+Number(data_rel)+1).each(function(){
								//alert($(this).text())
							//});
		

					  $('.product_hotelcategory_0').trigger('change');

				});
				for (var i=Number(data_rel);i<20;i++)
							{
							$('.first_'+i).remove();
							}

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
                            Edit Hotel Category
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" action="hotelcategory-edit.php?hotelcategory_id=<?=$hotelcategory_id;?>" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Hotel Category Name  [Edit Hotel Category Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter hotelcategory name" name="hotelcategory_name" value="<?=$hotelcategory_name?>"  />
									 <p class="help-block"><?=$hotelcategory_name_error;?></p>
                            	</div>
                           <!--    <div class="form-group">
                                    <label>Parent hotelcategory [Edit hotelcategory ]  </label>
									<!-- <select class="form-control input-lg m-bot15 product_hotelcategory" name="hotelcategory_parent_id"> 
										<option value="0">Main hotelcategory</option>
										<?php /*
										$hotelcategory_options = get_cat_options();
										if(count($hotelcategory_options) > 0 )
										{
											foreach($hotelcategory_options as $hotelcategory)
											{
												$selected = '';
												if($hotelcategory_parent == $hotelcategory['hotelcategory_id'])
												{
													$selected = 'selected=selected';
												}
												if($hotelcategory['hotelcategory_id'] != $hotelcategory_id)
												{
													echo '<option value="'.$hotelcategory['hotelcategory_id'].'" '.$selected.'>'.$hotelcategory['hotelcategory_name'].'</option>';
												}	
											}
										}	*/
									?>
									</select> -->

									<!-- <select class="form-control input-lg" name="hotelcategory_parent_id">
									<?php /* echo hotelcategory_sub_cat_dropdown(0,-1,$hotelcategory_parent);?>
                                </select> -->
                               <?php
							   
							  
							  $details_arr = hotelcategory_sub_cat_dropdown_full($hotelcategory_id,-1,$hotelcategory_parent);
							  //pre($details_arr);
							  $set_class_count = 0;
								 foreach($details_arr as $key => $cat_single){
								if($key < count($details_arr)-1){
									?>
                                 <div class="first_<?=$set_class_count?>"> 
                               		 <p>
                                
                                <select class="form-control input-lg product_hotelcategory" name="product_hotelcategory[]" data-rel="<?=$set_class_count+1?>">
                            	<option value="0">Select hotelcategory</option>
								<?php 
								
								$hotelcategory_options = get_multicat_options($cat_single);
									
									if(count($hotelcategory_options) > 0)
									{
										foreach($hotelcategory_options as $hotelcategory)
										{
											$selected = '';
											//echo $hotelcategory['hotelcategory_id'];
											if($details_arr[$key+1] == $hotelcategory['hotelcategory_id'] || ($hotelcategory_id == $hotelcategory['hotelcategory_id'] ))
											{
												$selected = 'selected=selected';
											}
											echo '<option value="'.$hotelcategory['hotelcategory_id'].'" '.$selected.'>'.$hotelcategory['hotelcategory_name'].'</option>';
										}
									}
								
								?>
                                
                            </select>
                            </p>
                           		 </div>
                            <?php
								}
								if(count($details_arr)== 1 && $details_arr[0] == 0){ 
								
								?>
									<div class="first_<?=$set_class_count?>"> 
                                <p>
                                
                                <select class="form-control input-lg product_hotelcategory" name="product_hotelcategory[]" data-rel="<?=$set_class_count+1?>">
                            	<option value="0" selected>Main hotelcategory</option>
								<?php 
								
								$hotelcategory_options = get_multicat_options($cat_single);
									
									if(count($hotelcategory_options) > 0)
									{
										foreach($hotelcategory_options as $hotelcategory)
										{
											
											echo '<option value="'.$hotelcategory['hotelcategory_id'].'" '.$selected.'>'.$hotelcategory['hotelcategory_name'].'</option>';
										}
									}
								
								?>
                                
                            </select>
                            </p>
                            </div>
							<?php	}
								$set_class_count++;
							}  */ ?>
							
							</div> -->
							
						<!--	<div class="form-group">
								<label>Summary   [Edit hotelcategory Summary ]  </label>
                              <textarea rows="7" cols="90" class="form-control input-lg" name="hotelcategory_summary"><?=$hotelcategory_summary?></textarea>
							</div>
							-->
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="hotelcategory_status" value="1" <?php if($hotelcategory_status == 1) echo 'checked="checked"'; ?> >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="hotelcategory_status" value="2" <?php if($hotelcategory_status == 2) echo 'checked="checked"'; ?>>
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
