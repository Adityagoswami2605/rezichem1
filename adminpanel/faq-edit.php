<?php 
include('configure/configure.php');
include('auth.php');


$faq_id = $_REQUEST['faq_id'];
if($faq_id != '' && is_numeric($faq_id))
{
	$faq_detail = get_faq_detail($faq_id);
	
	$faq_que 		= $faq_detail['faq_que'];
	$faq_ans 		= $faq_detail['faq_ans'];
	$faq_status 		= $faq_detail['faq_status'];
}
else
{
//	header('location:faqs.php');
	

		echo '<SCRIPT LANGUAGE="JavaScript">

						document.location.href="faqs.php" </SCRIPT>';
}

$error_message = '';
$error = 0;	

if(count($_POST) > 0)
{
	 
	if(trim($_POST['faq_que']) == '')
	{
		$_POST['faq_que'] = $faq_que;
	}
	if(trim($_POST['faq_ans']) == '')
	{
		$_POST['faq_ans'] = $faq_ans;
	}
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
			$_POST['faq_modify_date'] = $current_date;
			$update_id = update_data('faqs',$_POST,'faq_id='.$faq_id);
			//	header('location:faqs.php');
	

		echo '<SCRIPT LANGUAGE="JavaScript">

						document.location.href="faqs.php" </SCRIPT>';
			exit;
	}	
}
 
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,jquery.wysiwyg.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,jquery.wysiwyg.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Edit Faq</title>
<?=$styles?>
<?=$javascripts?>

<!-- Initiate WYIWYG text area -->
<script type="text/javascript">
	$(function()
	{
	$('#wysiwyg').wysiwyg(
	{
	controls : {
	separator01 : { visible : true },
	separator03 : { visible : true },
	separator04 : { visible : true },
	separator00 : { visible : true },
	separator07 : { visible : false },
	separator02 : { visible : false },
	separator08 : { visible : false },
	insertOrderedList : { visible : true },
	insertUnorderedList : { visible : true },
	undo: { visible : true },
	redo: { visible : true },
	justifyLeft: { visible : true },
	justifyCenter: { visible : true },
	justifyRight: { visible : true },
	justifyFull: { visible : true },
	subscript: { visible : true },
	superscript: { visible : true },
	underline: { visible : true },
	increaseFontSize : { visible : false },
	decreaseFontSize : { visible : false }
	}
	} );
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
                           Edit faq
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" enctype="multipart/form-data" action="faq-edit.php?faq_id=<?=$faq_id;?>">
								 <?=$error_message;?>
                                <div class="form-group">
                                    <label>Faq Que  [Enter Faq Questions Here] </label>
                                    <input type="text" class="form-control"  placeholder="Enter Faq Questions" name="faq_que" value="<?=$faq_que?>">
                                    
									
                                </div>
                               <div class="form-group">
								<label>Answer [Enter Faq Answer Here]  </label>
									<div class="col-sm-15">
										<textarea class="form-control wysiwyg" id="wysiwyg"  rows="6" name="faq_ans"><?=$faq_ans?></textarea>
									</div>
								</div>
                                
                                
                             
							<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="faq_status" value="1" <?php if($faq_status == 1) echo 'checked="checked"'; ?> />
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="faq_status" value="2" <?php if($faq_status == 2) echo 'checked="checked"'; ?> />
										Draft
									</label>
								</div>
                             </div>
                
                
                              <input type="submit" class="btn btn-info" value="Submit" />
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
