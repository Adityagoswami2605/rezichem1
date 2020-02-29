<?php 
include('configure/configure.php');
include('auth.php');

$category_id = $_REQUEST['category_id'];

if($category_id != '' && is_numeric($category_id))

{
	$category_detail 		= get_category_detail($category_id);
	if(!$category_detail)
	{
		header('location:categories.php');
		exit;
	}
	
	$category_name 			= $category_detail['category_name'];
	$category_parent 		= $category_detail['category_parent_id'];
	$category_summary 		= $category_detail['category_summary'];
	$category_short 		= $category_detail['category_short'];
	$category_image 		= $category_detail['category_image'];
	$category_status 		= $category_detail['category_status'];
}
else
{
	header('location:categories.php');
	exit;
}

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(check_cat_duplicate($_POST['category_name']) != 0 && $_POST['category_name'] != $category_name)
	{
		$category_name_error = '<span class="notification-input ni-error">Category name already exists.</span>';	
		$error = 1;
		$category_name = $_POST['category_name'];
	}
	else if(trim($_POST['category_name']) == '')
	{
		$_POST['category_name'] = $category_name;
	}
	
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
		$image_arr = explode(',',$category_image);
			
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(CATEGORYPATH.$org_image))
					{
						unlink(CATEGORYPATH.$org_image);
						if(file_exists(CATEGORY_THUMBPATH.$org_image))
						{
							unlink(CATEGORY_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			 
			$_POST['category_image'] = implode(',',$new_arr);
			$_POST['category_image'] = $_POST['category_image'].',';
			
			$image_count = count($_FILES['category_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['category_image']['name'][$i]) != '')
				{
					$_FILES['CATEGORY_IMAGES_NEW']['name'] = $_FILES['category_image']['name'][$i];
					$_FILES['CATEGORY_IMAGES_NEW']['tmp_name'] = $_FILES['category_image']['tmp_name'][$i];
					$_FILES['CATEGORY_IMAGES_NEW']['type'] = $_FILES['category_image']['type'][$i];
					$_FILES['CATEGORY_IMAGES_NEW']['error'] = $_FILES['category_image']['error'][$i];
					$_FILES['CATEGORY_IMAGES_NEW']['size'] = $_FILES['category_image']['size'][$i];
					
					$image_name = upload_image($_FILES['CATEGORY_IMAGES_NEW'],CATEGORYPATH,CATEGORY_THUMBPATH);
					if($image_name) 
					{
						$_POST['category_image'] .= $image_name.',';	
					}
				}
			}
			
			$_POST['category_image'] = trim($_POST['category_image'],','); 
			unset($_POST['old_images']);
		
			
			
		
			$_POST['category_date'] = $current_date;
			$_POST['category_slug'] = create_url_slug($_POST['category_name']);	
			
			$update_id = update_data('category',$_POST,'category_id='.$category_id);
			
			
			header('location:categories.php');
			exit;

			// $_POST['category_modify_date'] = $current_date;
			// $update_id = update_data('category',$_POST,'category_id='.$category_id);
			// header('location:categories.php');
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
<title>Edit Category</title>
<?=$styles?>
<?=$javascripts?>
<script language="javascript" type="text/javascript">

$(document).ready(function(){

		var ajax_category_url = 'ajax-category-dropdown.php';

		$('.product_category').live('change',function(){

				

				var cat_parent = $(this).val(); 
				var thisNode = $(this); 
				var data_rel = $(this).attr('data-rel'); 

				$.post(ajax_category_url,{cat_parent:cat_parent,level:0,data_rel:data_rel}, function(data) {

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
						  //thisNode.remove('product_category');
							//$('.first_'+Number(data_rel)+1).each(function(){
								//alert($(this).text())
							//});
		

					  $('.product_category_0').trigger('change');

				});
				for (var i=Number(data_rel);i<20;i++)
							{
							$('.first_'+i).remove();
							}

		});
});
</script>
	
	<script language="Javascript" src="ckeditor/ckeditor.js"></script>	
	
	
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
                            Edit Category
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" action="category-edit.php?category_id=<?=$category_id;?>" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Category Name  [Edit Category Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter Category name" name="category_name" value="<?=$category_name?>"  />
									 <p class="help-block"><?=$category_name_error;?></p>
                            	</div>
                        	
						<div class="form-group">
								<label>Summary   [Edit Category Summary ]  </label>
                              <textarea rows="7" cols="90" class="form-control ckeditor" name="category_summary"><?=$category_summary?></textarea>
							</div>
								 <div class="form-group">
                                    <label>Upload Image </label>
                                    <input type="file" class="multi" name="category_image[]" maxlength="5" <span class="not" style="font-size:14px; font-weight:400;"> [For Edit Product Image First remove check box click and then Select Browse Button And Then Submit]  </span> 
									<p class="help-block"><?php echo $category_image_error;?></p>
									<?php 
										$images = explode(',',$category_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=CATEGORY_THUMBURL.$images[$i]?>" height="100" width="100">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										} 
										?>
                                </div>
								
							
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="category_status" value="1" <?php if($category_status == 1) echo 'checked="checked"'; ?> >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="category_status" value="2" <?php if($category_status == 2) echo 'checked="checked"'; ?>>
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
