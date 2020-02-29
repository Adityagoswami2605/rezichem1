<?php 
ob_start();

$db_host 	 = 'localhost';
$db_user 	 = 'root';
$db_password     = '';
$db_name 	 = 'hostiio4_rezichem';


date_default_timezone_set('Asia/Kolkata');
error_reporting(1);

mysql_error();

define('DOCTYPE','<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
define('XMLNS','<html xmlns="http://www.w3.org/1999/xhtml">');
define('CONTENTTYPE','<meta http-equiv="content-type" content="text/html; charset=utf-8" />');

//define('SITEURL','http://192.168.1.24/dinesh/shakti/');

define('SITEURL','http://localhost/dashboard/rezichem/');

define('ADMINURL',SITEURL.'adminpanel/');

define('CSSURL',SITEURL.'css/');

define('JSURL',SITEURL.'js/');

define('IMAGEURL',SITEURL.'images/');

define('PAGE_THUMBURL',SITEURL.'page/thumbs/');

define('PAGEURL',SITEURL.'page/');

define('BANNERURL',SITEURL.'banner/');

define('BANNER_THUMBURL',SITEURL.'banner/thumbs/');

define('CATEGORYURL',SITEURL.'category/');

define('CATEGORY_THUMBURL',SITEURL.'category/thumbs/');

define('GALLERYURL',SITEURL.'gallery/');

define('GALLERY_THUMBURL',SITEURL.'gallery/thumbs/');

define('PRODUCTURL',SITEURL.'products/');

define('PRODUCT_THUMBURL',SITEURL.'products/thumbs/');

define('APPLICATIONURL',SITEURL.'application/');

define('APPLICATION_THUMBURL',SITEURL.'application/thumbs/');

define('LABORATORYURL',SITEURL.'laboratory/'); 

define('LABORATORY_THUMBURL',SITEURL.'laboratory/thumbs/');

define('NEWSURL',SITEURL.'news/');

define('NEWS_THUMBURL',SITEURL.'news/thumbs/');

define('BLOGURL',SITEURL.'blog/');

define('BLOG_THUMBURL',SITEURL.'blog/thumbs/');

define('SERVICEURL',SITEURL.'services/');

define('SERVICE_THUMBURL',SITEURL.'services/thumbs/');

define('TESTIMONIALURL',SITEURL.'testimonial/');

define('TESTIMONIAL_THUMBURL',SITEURL.'testimonial/thumbs/');

define('CERTIFICATEURL',SITEURL.'certificate/');

define('CERTIFICATE_THUMBURL',SITEURL.'certificate/thumbs/');

define('QUALITYURL',SITEURL.'quality/');

define('QUALITY_THUMBURL',SITEURL.'quality/thumbs/');

define('BROCHUREURL',SITEURL.'brochure/');

define('BROCHURE_THUMBURL',SITEURL.'brochure/thumbs/');

define('CLIENTURL',SITEURL.'clients/');

define('CLIENT_THUMBURL',SITEURL.'clients/thumbs/');

//define('SITEPATH',$_SERVER['DOCUMENT_ROOT'].'/dinesh/arya/');

define('SITEPATH',$_SERVER['DOCUMENT_ROOT'].'/dashboard/');

define('ADMINPATH',SITEPATH.'adminpanel/');
define('CSSPATH',SITEPATH.'css/');
define('JSPATH',SITEPATH.'js/');
define('IMAGEPATH',SITEPATH.'images/');

define('PAGEPATH',SITEPATH.'page/');

define('PAGE_THUMBPATH',SITEPATH.'page/thumbs/');

define('CATEGORYPATH',SITEPATH.'category/');

define('CATEGORY_THUMBPATH',SITEPATH.'category/thumbs/');

define('BANNERPATH',SITEPATH.'banner/');

define('BANNER_THUMBPATH',SITEPATH.'banner/thumbs/');

define('GALLERYPATH',SITEPATH.'gallery/');

define('GALLERY_THUMBPATH',SITEPATH.'gallery/thumbs/');

define('PRODUCT_THUMBPATH',SITEPATH.'products/thumbs/');

define('PRODUCTPATH',SITEPATH.'products/');

define('APPLICATION_THUMBPATH',SITEPATH.'application/thumbs/');

define('APPLICATIONPATH',SITEPATH.'application/');


define('LABORATORY_THUMBPATH',SITEPATH.'laboratory/thumbs/');

define('LABORATORYPATH',SITEPATH.'laboratory/');


define('NEWS_THUMBPATH',SITEPATH.'news/thumbs/');

define('NEWSPATH',SITEPATH.'news/');

define('BLOG_THUMBPATH',SITEPATH.'blog/thumbs/');

define('BLOGPATH',SITEPATH.'blog/');

define('SERVICE_THUMBPATH',SITEPATH.'services/thumbs/');

define('SERVICEPATH',SITEPATH.'services/');

define('TESTIMONIAL_THUMBPATH',SITEPATH.'testimonial/thumbs/');

define('TESTIMONIALPATH',SITEPATH.'testimonial/');

define('CERTIFICATE_THUMBPATH',SITEPATH.'certificate/thumbs/');

define('CERTIFICATEPATH',SITEPATH.'certificate/');

define('QUALITY_THUMBPATH',SITEPATH.'quality/thumbs/');

define('QUALITYPATH',SITEPATH.'quality/');

define('BROCHURE_THUMBPATH',SITEPATH.'brochure/thumbs/');

define('BROCHUREPATH',SITEPATH.'brochure/');

define('PACKAGE_THUMBPATH',SITEPATH.'package/thumbs/');

define('PACKAGEPATH',SITEPATH.'package/');

define('CLIENT_THUMBPATH',SITEPATH.'clients/thumbs/');

define('CLIENTPATH',SITEPATH.'clients/');



$current_date = date('Y-m-d H:i:s');

$current_day =  date('d-m-Y');


include('functions.php');
include('adminusers-functions.php');
include('category-functions.php');
include('page-functions.php');
include('products-functions.php');
include('banner-functions.php');
include('gallery-functions.php');
include('services-functions.php'); 
include('news-functions.php'); 
include('blog-functions.php');
include('users-functions.php');
include('blogreplay-functions.php');
include('testimonial-functions.php');
include('certificate-functions.php');
include('brochure-functions.php');
include('client-functions.php');
include('faq-functions.php');


?>
