<Title>Bot Cleanning...</Title>
<!-- xml version="1.0" encoding="utf-8" --> 
Đã dọn dẹp sạch sẽ. Clean finished
<?php 
error_reporting(0);

###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('timefolder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######

###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
$files = glob('userfolder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
###### FUNCTION DELETE ALL FILES AND SUBFOLDERS IN TIME #######
?>