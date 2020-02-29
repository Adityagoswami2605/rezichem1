<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	

if(count($_POST) > 0)
{
	
	if($_POST['OLD_PASSWORD'] != '')
	{
		if(check_admin_password($_SESSION['ADMIN_ELALA_ID'],$_POST['OLD_PASSWORD']))
		{
			if(trim($_POST['admin_password']) != '' && $_POST['admin_password'] == $_POST['CONFIRM_PASSWORD'])
			{			
				$data['admin_password'] = md5($_POST['admin_password']);
				$updateid = update_data('admin',$data,'admin_id='.$_SESSION['ADMIN_ELALA_ID']);
				if($updateid){
				$success_message = ' <div>
                                <span class="notification n-success">Your password is successfully changed.</span>
                            </div>';
				}
			}
			else
			{
				$error = 1;
				$confirm_password_error = '<span class="notification-input ni-error">Confirm Password is wrong.</span>';
			}

		}
		else
		{
			$error = 1;
			$old_password_error = '<span class="notification-input ni-error">Please Correct old password.</span>';
		}

	}
	else
	{
		$error = 1;
	}
	 
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
}


$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js');

?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Change Password</title>
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
                           Change Password
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                
								<div class="form-group">
                        <form action="" method="post" role="form" >
                        	<?=$success_message?>
                            <?=$error_message;?>
                    
						<div class="form-group">
								   <label>Old Password (*)</label>
								   <input type="password" class="form-control" name="OLD_PASSWORD" />
								   <p> <?=$old_password_error;?></p>
							</div>
								
							 <div class="form-group">
									<label>New Password (*)</label>
									<input type="password" class="form-control" name="admin_password" />
									<p><?=$new_password_error;?> </p>
							 </div> 
                            
							 <div class="form-group">
									<label>Confirm New Password (*)</label>
									<input type="password" class="form-control"name="CONFIRM_PASSWORD" />
									<p><?=$confirm_password_error;?></p>

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