<Title>Bot Cleanning...</Title>
<!-- xml version="1.0" encoding="utf-8" --> 
Đã dọn dẹp sạch sẽ. Clean finished
<?php 
error_reporting(0);
$time_now = time() - 240*60;
$time_ip = time() - 6*60;
$time_link = time() - 1440*60;


###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN USER #######
$files = glob('user/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_now) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN USER #######
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('time/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_now) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
 $files = glob('timeip/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_ip) unlink($file); // delete file
} 
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######

###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
 $files = glob('vip/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_ip) unlink($file); // delete file
} 
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######

###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('timefolder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_now) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('size/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_link) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######

###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('userfolder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_now) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######


###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('chat/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    if (filemtime($file) <= $time_now) unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
?>