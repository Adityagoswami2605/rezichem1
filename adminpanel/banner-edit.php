<?php 
include('configure/configure.php');
include('auth.php');
$banner_id = $_REQUEST['banner_id'];
if($banner_id != '' && is_numeric($banner_id))
{
	$banner_detail = get_banner_detail($banner_id);
	if(!$banner_detail)
	{
		header('location:banner.php');
		exit;
	}
	
//	pre($banner_detail);
	$banner_name 	= $banner_detail['banner_name'];
	$banner_image 	= $banner_detail['banner_image'];
	$banner_status 	= $banner_detail['banner_status'];
}
else
{
	header('location:banner.php');
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
			$image_arr = explode(',',$banner_image);
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(BANNERPATH.$org_image))
					{
						unlink(BANNERPATH.$org_image);
						if(file_exists(BANNER_THUMBPATH.$org_image))
						{
							unlink(BANNER_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			
			$_POST['banner_image'] = implode(',',$new_arr);
			$_POST['banner_image'] = $_POST['banner_image'].',';
			
			$image_count = count($_FILES['banner_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['banner_image']['name'][$i]) != '')
				{
					$_FILES['BANNER_IMAGE_NEW']['name'] = $_FILES['banner_image']['name'][$i];
					$_FILES['BANNER_IMAGE_NEW']['tmp_name'] = $_FILES['banner_image']['tmp_name'][$i];
					$_FILES['BANNER_IMAGE_NEW']['type'] = $_FILES['banner_image']['type'][$i];
					$_FILES['BANNER_IMAGE_NEW']['error'] = $_FILES['banner_image']['error'][$i];
					$_FILES['BANNER_IMAGE_NEW']['size'] = $_FILES['banner_image']['size'][$i];
					
					/*
					$file_size = get_file_size($_FILES['banner_image_new']['size']);
					
					if($file_size > 0 && $file_size <= 1)
					{
					*/
						$image_name = upload_image($_FILES['BANNER_IMAGE_NEW'],BANNERPATH,BANNER_THUMBPATH);
						if($image_name) 
						{
							$_POST['banner_image'] .= $image_name.',';	
						}
					
				}
			}
			$_POST['banner_image'] = trim($_POST['banner_image'],',');
			unset($_POST['old_images']);
			
			if($_POST['banner_image'] == '')
			{
				$banner_image_error = '<label class="alert-danger fade in">Please select atleast one image.</span>';	
			}
			$_POST['banner_created_date'] = $current_date;
			//pre($_POST);
			$update_id = update_data('banner',$_POST,'banner_id='.$banner_id);
			//exit;
			header('location:banner.php');
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
<title>Edit Banner</title>
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
                            Edit Banner
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter banner name" name="banner_name" value="<?=$banner_name?>" />
									 <p class="help-block"><?=$banner_name_error;?></p>
                            </div>
                            <div class="form-group">
                                    <label>Upload Banner  [Upload Image Size: 1270px X 450px] </label>
                                    <input type="file" class="multi" name="banner_image[]" maxlength="5" />
									<p class="help-block"><?php echo $banner_image_error;?></p>
									<?php 
										$images = explode(',',$banner_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=BANNER_THUMBURL.$images[$i]?>" height="100" width="200">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										}
										?>
                                </div>
								
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="banner_status" value="1" <?php if($banner_status == 1) echo 'checked="checked"'; ?>>
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="banner_status" value="2" <?php if($banner_status == 2) echo 'checked="checked"'; ?>>
										Draft
									</label>
								</div>
                             </div>
                                	<input type="submit" class="btn btn-info" value="Submit">
                                     <input type="reset" class="btn btn-info" value="Cancel">
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
