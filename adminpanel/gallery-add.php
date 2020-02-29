<?php 
include('configure/configure.php');
include('auth.php');
$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(trim($_POST['gallery_name']) == '') 
		{
		$gallery_name_error = '<label class="alert-danger fade in">Enter Name</label>';	
		$error = 1;
	}
	$image_count = count($_FILES['gallery_image']['name']);
	if($image_count <= 0 || $_FILES['gallery_image']['name'][0] == '')
	{
		$gallery_image_error = '<label class="alert-danger fade in">This field is required.</label>';	
		$error = 1;
	}
	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required information.</label>
                            </div>';
	}
	else
	{
	
			$_POST['gallery_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['gallery_image']['name'][$i]) != '')
				{
					$_FILES['gallery_image_new']['name'] = $_FILES['gallery_image']['name'][$i];
					$_FILES['gallery_image_new']['tmp_name'] = $_FILES['gallery_image']['tmp_name'][$i];
					$_FILES['gallery_image_new']['type'] = $_FILES['gallery_image']['type'][$i];
					$_FILES['gallery_image_new']['error'] = $_FILES['gallery_image']['error'][$i];
					$_FILES['gallery_image_new']['size'] = $_FILES['gallery_image']['size'][$i];
					

				//	$file_size = get_file_size($_FILES['gallery_image_new']['size']);
					
				//	if($file_size > 0 && $file_size <= 1)
				//	{
					
						$image_name = upload_image($_FILES['gallery_image_new'],GALLERYPATH,GALLERY_THUMBPATH,'500');
						if($image_name) 
						{
							$_POST['gallery_image'] .= $image_name.',';	
						}
				//	}	 
				}
			}
	
	
			$_POST['gallery_image'] = trim($_POST['gallery_image'],',');
	
			$_POST['gallery_created_date'] = $current_date;
			
			
			$insert_id = insert_data('gallery',$_POST);
			if($insert_id)
			{
				header('location:gallery.php');
				exit;
			}
			else
			{
				echo mysql_error();	
			}
	}	
}
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Add Gallery</title>
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
                            Add Gallery
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter name" name="gallery_name" value="<?=$_POST['gallery_name']?>" />
									 <p class="help-block"><?=$gallery_name_error;?></p>
                            </div>
							
						<!--	<div class="form-group">
                                    <label>Gallery Category</label>
									<select class="form-control input-lg m-bot15 gallery_category" name="gallery_category" data-rel="1"> 
												<option value="0">Main Category</option>
											   <?php  
											  /* 
									$cat_options = get_galcategories();
									if(count($cat_options) > 0 )
									{
										foreach($cat_options as $cat)
										{
											$selected = '';
											if($cat_parent == $cat['CAT_ID'])
											{
												$selected = 'selected=selected';
											}
											if($cat['CAT_ID'] != $cat_id)
											{
												echo '<option value="'.$cat['CAT_ID'].'" '.$selected.'>'.$cat['CAT_NAME'].'</option>';
											}	
										}
									}
									*/
									?>
									
									</div>
							-->
                            <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="multi" name="gallery_image[]" maxlength="5" />
                                    <p class="help-block"></p>
									<p class="help-block"><?php echo $gallery_image_error;?></p>
                                </div>
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="gallery_status" value="1" checked="checked" >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="gallery_status" value="2">
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