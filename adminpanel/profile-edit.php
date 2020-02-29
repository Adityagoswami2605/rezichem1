<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	

$admin_name = $_SESSION['ADMIN_ELALA_FULLNAME'];
$admin_email = $_SESSION['ADMIN_ELALA_EMAIL'];
$admin_id=1;

if(count($_POST) > 0)
{

	
$update_id = update_data('admin',$_POST,'admin_id='.$admin_id);
			header('location:dashboard.php');
}


$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js');

?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Profile</title>
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
                        Edit My Profile
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                
								<div class="form-group">
                        <form action="profile-edit.php" method="post" role="form" >
                        	<?=$success_message?>
                            <?=$error_message;?>
                    
						<div class="form-group">
								   <label>Name </label>
								   <input type="text" class="form-control" name="admin_name" value="<?=$admin_name?>" />
								   <p> <?=$old_password_error;?></p>
							</div>
								
							 <div class="form-group">
									<label>Email Id</label>
									<input type="text" class="form-control" name="admin_email" value="<?=$admin_email?>" />
									<p><?=$new_password_error;?> </p>
							 </div> 
                            
						<fieldset>
                                <input class="btn btn-info" type="submit" value="Submit" /> 
                            </fieldset>
                        </form>
                     </div>
								
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