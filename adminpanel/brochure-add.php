<?php 
include('configure/configure.php');
include('auth.php');
$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
//	pre($_POST);
//	exit;
	
	if(trim($_POST['brochure_name']) == '') 
		{
		$brochure_name_error = '<label class="alert-danger fade in">Enter Name</label>';	
		$error = 1;
	}
	$image_count = count($_FILES['brochure_image']['name']);
	if($image_count <= 0 || $_FILES['brochure_image']['name'][0] == '')
	{
	//	$brochure_image_error = '<label class="alert-danger fade in">This field is required.</label>';	
	//	$error = 1;
	}
	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required information.</label>
                            </div>';
	}
	else
	{
	
			$_POST['brochure_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
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
					
						$image_name = upload_image($_FILES['brochure_image_new'],BROCHUREPATH,BROCHURE_THUMBPATH,'400','250');
						if($image_name) 
						{
							$_POST['brochure_image'] .= $image_name.',';	
						}
					}	 
				}
			}
	
	
			$_POST['brochure_image'] = trim($_POST['brochure_image'],',');
	
	
	if($_FILES['brochure_file']['name'] != '')
			{
				if($_FILES['brochure_file']['type'] == 'application/pdf')
				{
					$image_name = upload_file($_FILES['brochure_file'],BROCHUREPATH);
					if($image_name) 
					{
						$_POST['brochure_file'] = $image_name;	
					}
				}
				else
				{
					$brochure_file_error = '<span class="alert-danger fade in">This field is required.</span>';	
					$error = 1;
				}	
				
			}	 
	
			$_POST['brochure_created_date'] = $current_date;
			
		//	pre($_POST);
		//	exit;
			$insert_id = insert_data('brochure',$_POST);
			if($insert_id)
			{
				header('location:brochure.php');
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
<title>Add Brochure</title>
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
                            Add brochure
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Name  [Add Brochure Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter name" name="brochure_name" value="<?=$_POST['brochure_name']?>" />
									 <p class="help-block"><?=$brochure_name_error;?></p>
                            </div>
                        <!--    <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="multi" name="brochure_image[]" maxlength="5" />
                                    <p class="help-block"></p>
									<p class="help-block"><?php echo $brochure_image_error;?></p>
                                </div>
                           -->
                                <div class="form-group">
                                    <label>Upload Pdf File [ For Add Pdf Click Browse Button]   </label>
                                    <input type="file" class="multi" name="brochure_file"  />
                                    <p class="help-block"></p>
									<p class="help-block"><?php echo $brochure_file_error;?></p>
                                </div> 
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="brochure_status" value="1" checked="checked" >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="brochure_status" value="2">
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