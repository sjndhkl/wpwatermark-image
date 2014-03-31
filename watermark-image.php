<?php
/*
* Plugin Name: Watermark Image
* Description: Adds Watermark to the Uploaded Attachment based on settings
* Author: Sujan Dhakal
*/
include_once 'autoload.php';
//use \wpsujan\core\ImageWatermarkHandler as ImageWatermarkHandler;
use \wpsujan\core\TextWatermarkHandler as TextWatermarkHandler;

define('FONT_FILE', __DIR__ . '/ubuntu.ttf');
add_filter('wp_generate_attachment_metadata',function($data){
	$imagine = new \Imagine\Gd\Imagine;
        //$watermarkHandler = new \wpsujan\core\ImageWatermarkHandler($imagine,__DIR__ . '/watermark.png');
        $watermarkHandler = new TextWatermarkHandler($imagine,FONT_FILE, "® Sujan Dhakal - ".date('Y'));
	$watermarkHandler->handle($data, \wpsujan\core\Position::BOTTOM_LEFT);
	return $data;
}); 