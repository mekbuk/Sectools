<?php

 /*
  * php+gd dynamic progress bar image script.
  * copyright 2003, B. Johannessen <bob@db.org>
  * 
  * This program is free software; you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation; either version 2 of the License, or
  * (at your option) any later version, and provided that the above
  * copyright and permission notice is included with all distributed
  * copies of this or derived software.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * A copy of the GNU General Public License is available from the GNU
  * website at the following URL: http://www.gnu.org/licenses/gpl.txt
  *
  */

 /*
  * configuration: the location of the style fragments, and 
  * a list of available styles.
  */
 $style_dir = 'fragments/';
 $styles = array('winxp', 'winxpblue', 'winxpred', 'winxpyellow', 'osx', 'led', 'ledred', 'ledblue', 'ledyellow', 'solaris');

 /*
  * only allow links from hosting server.
  */
 if(isset($_SERVER['HTTP_REFERER'])) {
  $referer = parse_url($_SERVER['HTTP_REFERER']);
  if($referer['host'] != $_SERVER['HTTP_HOST']) {
   error('403 Forbidden', 'This script only allow links from ' . $_SERVER['HTTP_HOST']);
  }
 }

 /*
  * fetch the arguments from path info. the format is:
  * http://example.com/progress.php/style/width/done/total
  */
 $parts = explode('/', $_REQUEST['img']);
 $style = $parts[0];
 $width = $parts[1];
 $done = $parts[2];
 $total = $parts[3];

 /*
  * sanity check on the arguments.
  */
 if( ($width < 64) || ($width > 1280) || ($total < 1) || ($done < 0) || ($done > $total) ) {
  error('500 Internal Server Error', 'Value out of range');
 }

 /*
  * is the style valid.
  */
 if(!in_array($style, $styles)) {
  error('500 Internal Server Error', 'Invalid Style');
 }

 /*
  * read the style fragments.
  */
 $bg       = @imagecreatefrompng($style_dir . $style . '-bg.png');
 $fill     = @imagecreatefrompng($style_dir . $style . '-fill.png');
 $bg_cap   = @imagecreatefrompng($style_dir . $style . '-bg-cap.png');
 $fill_cap = @imagecreatefrompng($style_dir . $style . '-fill-cap.png');

 /*
  * verify that all the fragments loaded correctly.
  */
 if(!$bg || !$fill || !$bg_cap || !$fill_cap) {
  error('503 Service Unavailable', 'Error reading fragments');
 }

 /*
  * calculate the width of the fill.
  */
 $fill_width = round((($width - imagesx($bg_cap)) * $done) / $total) - imagesx($fill_cap);

 /*
  * create the new image, and copy the fragments into it.
  */
 $image = imagecreatetruecolor($width, imagesy($bg));
 imagecopy($image, $bg, 0, 0, 0, 0, imagesx($bg), $width - imagesx($bg_cap));
 imagecopy($image, $bg_cap, $width - imagesx($bg_cap), 0, 0, 0, imagesx($bg_cap), imagesy($bg_cap));
 imagecopy($image, $fill, 0, 0, 0, 0, $fill_width, imagesy($fill));
 imagecopy($image, $fill_cap, $fill_width, 0, 0, 0, imagesx($fill_cap), imagesy($fill_cap));

 /*
  * write the content-type: header and the image data.
  */
 header("Content-Type: image/png");
 imagepng($image);

 /*
  * get rid of the image and all the fragments.
  */
 imagedestroy($bg);
 imagedestroy($fill);
 imagedestroy($bg_cap);
 imagedestroy($fill_cap);
 imagedestroy($image);

 /*
  * function to signal http error and exit.
  */
 function error($code, $desc) {
  header($_SERVER['SERVER_PROTOCOL'] . ' ' . $code);
  if(strtoupper($_SERVER['REQUEST_METHOD']) != 'HEAD') {
   echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
   echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n";
   echo '<html xml:lang="en" lang="en">';
   echo '<head><title>' . $code . '</title></head><body><h1>' . $code . '</h1><p>' . $desc . '</p></body></html>';
  }
  exit;
 }

?>
