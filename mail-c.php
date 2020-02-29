<?php
include('configure/configure.php');

//declare our variables
if(isset($_POST['submit']))
{
	$name = $_POST['name-c'];
	$email = $_POST['email-c'];
	$contact = $_POST['phone-c'];
	
	$comment = nl2br($_POST['message-c']);
	//get todays date
	$todayis = date("l, F j, Y, g:i a") ;
	//set a title for the message
	$subject = "CONTACTUS FOR REZICHEM";
	//$body = "<b>CONTACT INFORMATION</b> <br><br> <b>Name :</b> $name <br> <b>Email :</b> $email <br> <b>Subject :</b> $title <br>  <b>Current Job :</b> $current <br>  <b>Future Job :</b> $future <br>  <b>Contact :</b> $contact <br> <b>Comment :</b> $comment";
	
	$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
   <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
      <title>Super Taps</title>
      <style type='text/css'>
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a 'view in browser' menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #974BAB;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^='tel'], a[href^='sms'] {
         text-decoration: none;
         color: #9ec459; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
         text-decoration: default;
         color: #9ec459 !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         td[class=devicewidth] {width: 440px!important;text-align:center!important;}
         img[class=devicewidth] {width: 440px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:147px!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         table[class=icontext] {width: 345px!important;text-align:center!important;}
         img[class='colimg2'] {width:420px!important;height:243px!important;}
         table[class='emhide']{display: none!important;}
         img[class='logo']{width:440px!important;height:110px!important;}
         
         }
         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^='tel'], a[href^='sms'] {
         text-decoration: none;
         color: #9ec459; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
         text-decoration: default;
         color: #9ec459 !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         td[class=devicewidth] {width: 280px!important;text-align:center!important;}
         img[class=devicewidth] {width: 280px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:93px!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         table[class=icontext] {width: 186px!important;text-align:center!important;}
         img[class='colimg2'] {width:260px!important;height:150px!important;}
         table[class='emhide']{display: none!important;}
         img[class='logo']{width:280px!important;height:70px!important;}
        
         }
      </style>
   </head>
   <body>
<!-- Start of preheader -->
<table width='100%' bgcolor='#00A256' cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
   <tbody>
      <tr>
         <td>
            <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
               <tbody>
                  <tr>
                     <td width='100%'>
                        <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width='100%' height='20'></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width='280' align='left' border='0' cellpadding='0' cellspacing='0' class='devicewidthinner'>
                                       <tbody>
                                          <tr>
                                             <td align='left' valign='middle' style='font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff'>
                                                Welcome To Rezichem
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <table width='280' align='left' border='0' cellpadding='0' cellspacing='0' class='emhide'>
                                       <tbody>
                                          <tr>
                                             <td align='right' valign='middle' style='font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff'>
                                                <a href='#' style='text-decoration: none; color: #ffffff'> </a> 
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td width='100%' height='20'></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of preheader --> 
<!-- Start of LOGO -->
<table width='100%' bgcolor='#e8eaed' cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
   <tbody>
      <tr>
         <td>
            <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
               <tbody>
                  <tr>
                     <td width='100%'>
                        <table bgcolor='#e8eaed' width='600' align='center' cellspacing='0' cellpadding='0' border='0' class='devicewidth'>
                           <tbody>
                              <tr>
                                 <!-- start of image -->
                                 <td align='center' style='background:#fff;'>
                                    <a target='_blank' href='#'><img width='250' border='0' height='100' alt='' border='0' style='display:block; border:none; outline:none; text-decoration:none; margin-top:20px;' src='".SITEURL."/images/logo2.png' class='logo'></a>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <!-- end of image -->
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- End of LOGO -->    
<!-- start textbox-with-title -->
<table width='100%' bgcolor='#e8eaed' cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
   <tbody>
      <tr>
         <td>
            <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
               <tbody>
                  <tr>
                     <td width='100%'>
                        <table bgcolor='#ffffff' width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width='100%' height='20'></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width='400' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner'>
                                       <tbody>
                                          <!-- Title -->
                                          <tr>
                                             <th colspan='2' style='font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;'>
                                                CONTACT INFORMATION FOR REZICHEM
                                             </th>
                                          </tr>
                                          <!-- End of Title -->
                                          <!-- spacing -->
                                          <tr>
                                             <td height='5'></td><td height='5'></td>
                                          </tr>
                                          <!-- End of spacing -->
                                          <!-- content -->
                                          <tr>
                                             <td style='font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px; width:200px;'> <b> Name: </b> $name </td>
											 
										
											 
                                          </tr>
										  
										  <tr>
                                             <td style='font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px; width:200px;'><b> Email: </b> $email </td>
											 
                                          </tr>
										  
										   <tr>
                                             <td style='font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px; width:200px;'><b> Mobile: </b> $contact </td>
											 
                                          </tr>
										  
										  
										   <tr>
                                             <td style='font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px; width:200px;'><b> Message: </b> $comment </td>
											 
                                          </tr>
                                          
										  
                                          <!-- End of content -->
                                          <!-- Spacing -->
                                          <tr>
                                             <td width='100%' height='5'></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <!-- button -->
                                          <tr>
                                             <td style='font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;'>
                                             
                                             </td>
                                          </tr>
                                          <!-- /button -->
                                          <!-- Spacing -->
                                          <tr>
                                             <td width='100%' height='20'></td>
                                          </tr>
                                          <!-- Spacing -->
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of textbox-with-title -->

<!-- Start of postfooter -->
<table width='100%' bgcolor='#00A256' cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
   <tbody>
      <tr>
         <td>
            <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
               <tbody>
                  <tr>
                     <td width='100%'>
                        <table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='devicewidth'>
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width='100%' height='20'></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td align='center' valign='middle' style='font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff'>
                                   Design & Developed By <a href='http://india.seawindsolution.com' target='_blank'> Seawindsolution.Pvt.Ltd  </a>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td width='100%' height='20'></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of postfooter -->
   </body>
   </html>";
	
	

	$adminmail = "dm@seawindsolution.com";

	$from_text = $email;
	
	$headers = 'From: '.$from_text.'' . "\r\n" .

		'Reply-To: '.$email.'' . "\r\n" .
		
		'Bcc: '.$adminmail.'' . "\r\n" .

		'Content-type: text/html; charset=utf-8' . "\r\n" .

		'X-Mailer: PHP/' . phpversion();

	

	//put your email address here

	

	mail("rezichemhealthcarepvtltd@gmail.com", $subject, $body, $headers);
//	mail("ankit@seawindsolution.com", $subject, $body, $headers);


	echo '<script>';
		echo 'alert("Thanks for Visit To Rezichem ,Our executive contact you soon!");';
		echo 'location.href="http://rezichem.com/index.php"';
		echo '</script>';
	

//	header('Location: http://localhost/colormax/index.php');
}
?>
