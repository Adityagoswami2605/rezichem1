<?php 
include('configure/configure.php');
include('auth.php');
$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(trim($_POST['banner_name']) == '') 
		{
		$banner_name_error = '<label class="alert-danger fade in">Enter Name</label>';	
		$error = 1;
	}
	$image_count = count($_FILES['banner_image']['name']);
	if($image_count <= 0 || $_FILES['banner_image']['name'][0] == '')
	{
		$banner_image_error = '<label class="alert-danger fade in">This field is required.</label>';	
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
	
			$_POST['banner_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['banner_image']['name'][$i]) != '')
				{
					$_FILES['banner_image_new']['name'] = $_FILES['banner_image']['name'][$i];
					$_FILES['banner_image_new']['tmp_name'] = $_FILES['banner_image']['tmp_name'][$i];
					$_FILES['banner_image_new']['type'] = $_FILES['banner_image']['type'][$i];
					$_FILES['banner_image_new']['error'] = $_FILES['banner_image']['error'][$i];
					$_FILES['banner_image_new']['size'] = $_FILES['banner_image']['size'][$i];
					

					$file_size = get_file_size($_FILES['banner_image_new']['size']);
					
					if($file_size > 0 && $file_size <= 1)
					{
					
						$image_name = upload_image($_FILES['banner_image_new'],BANNERPATH,BANNER_THUMBPATH);
						if($image_name) 
						{
							$_POST['banner_image'] .= $image_name.',';	
						}
					}	 
				}
			}
	
	
			$_POST['banner_image'] = trim($_POST['banner_image'],',');
	
			$_POST['banner_created_date'] = $current_date;
			
		//	pre($_POST);
		//	exit;
			$insert_id = insert_data('banner',$_POST);
			if($insert_id)
			{
				header('location:banner.php');
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
<title>Add Banner</title>
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
                            Add Banner
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter name" name="banner_name" value="<?=$_POST['banner_name']?>" />
									 <p class="help-block"><?=$banner_name_error;?></p>
                            </div>
                            <div class="form-group">
                                    <label>Upload Image  [Upload Image Size: 1270px X 450px]</label>
                                    <input type="file" class="multi" name="banner_image[]" maxlength="5" />
                                    <p class="help-block"></p>
									
								
									<p class="help-block"><?php echo $banner_image_error;?></p>
                                </div>
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="banner_status" value="1" checked="checked" >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="banner_status" value="2">
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
