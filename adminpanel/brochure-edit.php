<?php 
include('configure/configure.php');
include('auth.php');
$brochure_id = $_REQUEST['brochure_id'];
if($brochure_id != '' && is_numeric($brochure_id))
{
	$brochure_detail = get_brochure_detail($brochure_id);
	if(!$brochure_detail)
	{
		header('location:brochure.php');
		exit;
	}
	
//	pre($brochure_detail);
	$brochure_name 	= $brochure_detail['brochure_name'];
	$brochure_image 	= $brochure_detail['brochure_image'];
	$brochure_file 	= $brochure_detail['brochure_file'];
	$brochure_status 	= $brochure_detail['brochure_status'];
}
else
{
	header('location:brochure.php');
	exit;
}
$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{

	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required 
								information.</label>
                           </div>';
	}
	else
	{
			$image_arr = explode(',',$brochure_image);
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(BROCHUREPATH.$org_image))
					{
						unlink(BROCHUREPATH.$org_image);
						if(file_exists(BROCHURE_THUMBPATH.$org_image))
						{
							unlink(BROCHURE_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			
			$_POST['brochure_image'] = implode(',',$new_arr);
			$_POST['brochure_image'] = $_POST['brochure_image'].',';
			
			$image_count = count($_FILES['brochure_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['brochure_image']['name'][$i]) != '')
				{
					$_FILES['brochure_image_new']['name'] = $_FILES['brochure_image']['name'][$i];
					$_FILES['brochure_image_new']['tmp_name'] = $_FILES['brochure_image']['tmp_name'][$i];
					$_FILES['brochure_image_new']['type'] = $_FILES['brochure_image']['type'][$i];
					$_FILES['brochure_image_new']['error'] = $_FILES['brochure_image']['error'][$i];
					$_FILES['brochure_image_new']['size'] = $_FILES['brochure_image']['size'][$i];
					
					$file_size = get_file_size($_FILES['brochure_image_new']['size']);
					
					if($file_size > 0 && $file_size <= 1)
					{
						$image_name = upload_image($_FILES['brochure_image_new'],BROCHUREPATH,BROCHURE_THUMBPATH,'400','150');
						if($image_name) 
						{
							$_POST['brochure_image'] .= $image_name.',';	
						}
					}
				}
			}
			$_POST['brochure_image'] = trim($_POST['brochure_image'],',');
			unset($_POST['old_images']);
		/*	
			if($_POST['brochure_image'] == '')
			{
				$brochure_image_error = '<label class="alert-danger fade in">Please select atleast one image.</span>';	
			}
			*/
			
			if($_FILES['brochure_file']['name'] != '')
			{
				
				{
					 
					if($_FILES['brochure_file']['type'] == 'application/pdf')
					{
						$image_name = upload_file($_FILES['brochure_file'],BROCHUREPATH);
						if($image_name) 
						{
							$_POST['brochure_file'] = $image_name;	
						}
						 
						if(file_exists(BROCHUREPATH.$brochure_file))
						{
							unlink(BROCHUREPATH.$brochure_file);
						}	
					}
				}
				
			}	 
			
			if($_POST['brochure_file'] == '')
			{
				$brochure_file_error = '<label class="alert-danger fade in">Please select atleast one pdf.</span>';	
			}
			
			$_POST['brochure_modify_date'] = $current_date;
			
	//	pre($_POST);
	//		exit;
			
			$update_id = update_data('brochure',$_POST,'brochure_id='.$brochure_id);
	//	echo 	$update_id;
//			exit;
			
			header('location:brochure.php');
			exit;
	}	
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Edit brochure</title>
<?=$styles?>
<?=$javascripts?>
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
                            Edit brochure
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name [Edit Banner Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter brochure name" name="brochure_name" value="<?=$brochure_name?>" />
									 <p class="help-block"><?=$brochure_name_error;?></p>
                            </div>
                        <!--    <div class="form-group">
                                    <label>Upload Image </label>
                                    <input type="file" class="multi" name="brochure_image[]" maxlength="5" />
									<p class="help-block"><?php echo $brochure_image_error;?></p>
									<?php 
										$images = explode(',',$brochure_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=BROCHURE_THUMBURL.$images[$i]?>" height="100" width="100">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										}
										?>
                                </div>
                                
                           -->     	
                                  <div class="form-group">
                                    <label>Upload Pdf File <span class="not" style="font-size:14px; font-weight:400;"> [For Edit pdf First remove check box click and then Select Browse Button And Then Submit]  </span>  </label>
                                    <input type="file" class="multi" name="brochure_file" />
                                    <?=$brochure_file?>
									<p class="help-block"><?php echo $brochure_file_error;?></p>
		                        </div> 
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="brochure_status" value="1" <?php if($brochure_status == 1) echo 'checked="checked"'; ?>>
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="brochure_status" value="2" <?php if($brochure_status == 2) echo 'checked="checked"'; ?>>
										Draft
									</label>
								</div>
                             </div>
                                	<input type="submit" class="btn btn-info" value="Submit">
                                     <input type="reset" class="btn btn-info" value="Cancel" />
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
<?php include('footer.php');?>
</body>
</html>