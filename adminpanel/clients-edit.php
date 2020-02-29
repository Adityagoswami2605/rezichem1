<?php 
include('configure/configure.php');
include('auth.php');
$clients_id = $_REQUEST['clients_id'];
if($clients_id != '' && is_numeric($clients_id))
{
	$clients_detail = get_clients_detail($clients_id);
	if(!$clients_detail)
	{
		header('location:clients.php');
		exit;
	}
	
//	pre($clients_detail);
	$clients_name 	= $clients_detail['clients_name'];
	$clients_image 	= $clients_detail['clients_image'];
	$clients_category 	= $clients_detail['clients_category'];
	$clients_status 	= $clients_detail['clients_status'];
}
else
{
	header('location:clients.php');
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
			$image_arr = explode(',',$clients_image);
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(CLIENTPATH.$org_image))
					{
						unlink(CLIENTPATH.$org_image);
						if(file_exists(CLIENT_THUMBPATH.$org_image))
						{
							unlink(CLIENT_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			
			$_POST['clients_image'] = implode(',',$new_arr);
			$_POST['clients_image'] = $_POST['clients_image'].',';
			
			$image_count = count($_FILES['clients_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['clients_image']['name'][$i]) != '')
				{
					$_FILES['clients_image_new']['name'] = $_FILES['clients_image']['name'][$i];
					$_FILES['clients_image_new']['tmp_name'] = $_FILES['clients_image']['tmp_name'][$i];
					$_FILES['clients_image_new']['type'] = $_FILES['clients_image']['type'][$i];
					$_FILES['clients_image_new']['error'] = $_FILES['clients_image']['error'][$i];
					$_FILES['clients_image_new']['size'] = $_FILES['clients_image']['size'][$i];
					
					/* 
					$file_size = get_file_size($_FILES['clients_image_new']['size']);
					
					if($file_size > 0 && $file_size <= 1)
					{
					*/
						$image_name = upload_image($_FILES['clients_image_new'],CLIENTPATH,CLIENT_THUMBPATH,'500');
						if($image_name) 
						{
							$_POST['clients_image'] .= $image_name.',';	
						}
					
				}
			}
			$_POST['clients_image'] = trim($_POST['clients_image'],',');
			unset($_POST['old_images']);
			
			if($_POST['clients_image'] == '')
			{
				$clients_image_error = '<label class="alert-danger fade in">Please select atleast one image.</span>';	
			}
			
			$update_id = update_data('clients',$_POST,'clients_id='.$clients_id);
			header('location:clients.php');
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
<title>Edit clients</title>
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
                            Edit clients
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter clients name" name="clients_name" value="<?=$clients_name?>" />
									 <p class="help-block"><?=$clients_name_error;?></p>
                            </div>
							
						<!--	<div class="form-group">
                                    <label>clients Category</label>
									<select class="form-control input-lg m-bot15 clients_category" name="clients_category" data-rel="1"> 
												<option value="0">Main Category</option>
											   <?php  
											   /*
									$cat_options = get_galcategories();
									if(count($cat_options) > 0 )
									{
										foreach($cat_options as $cat)
										{
											$selected = '';
											if($clients_category == $cat['CAT_ID'])
											{
												$selected = 'selected=selected';
											}
											if($cat['CAT_ID'] != $cat_id)
											{
												echo '<option value="'.$cat['CAT_ID'].'" '.$selected.'>'.$cat['CAT_NAME'].'</option>';
											}	
										}
									}
									*/ ?>
									
									</div>
							
							-->
                            <div class="form-group">
                                    <label>Upload Logo </label>
                                    <input type="file" class="multi" name="clients_image[]" maxlength="5" />
									<p class="help-block"><?php echo $clients_image_error;?></p>
									<?php 
										$images = explode(',',$clients_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=CLIENT_THUMBURL.$images[$i]?>" height="100" width="100">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										}
										?>
                                </div>
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="clients_status" value="1" <?php if($clients_status == 1) echo 'checked="checked"'; ?>>
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="clients_status" value="2" <?php if($clients_status == 2) echo 'checked="checked"'; ?>>
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