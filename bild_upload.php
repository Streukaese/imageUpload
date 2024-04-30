<?php
if(!isset($_FILES['bild']) || !file_exists($_FILES['bild']['tmp_name'])) {
    header('Location:index.php');
    exit;
}
$origname = $_FILES['bild']['name'];
$ok_endungen = ['.jpg','jpeg','.png', '.gif', '.webp'];
$endung=strtolower(strrchr($origname,'.'));
if(!in_array($endung, $ok_endungen)) {
    header('Location:index.php');
    exit;
}

$origbild=imagecreatefromstring(file_get_contents($_FILES['bild']['tmp_name']));
if(!$origbild) {
    header('Location:index.php');
    exit;
}
$origsize=getimagesize($_FILES['bild']['tmp_name']);
$origwidth=$origsize[0];
$origheight=$origsize[1];
$destheight=150;
$destwidth=($origsize[0]*$destheight)/$origheight;
$destbild=imagescale($origbild,$destwidth,$destheight);
// ToDo - Bild runterskalieren
$destname=substr($origname,0,strlen($origname)-strlen($endung)).'.png';
$destpath='bilder/'.$destname;
if(file_exists($despath)) {
    unlink($despath);
}
// if(move_uploaded_file($_FILES['bild']['tmp_name'],$despath)) {
imagepng($destbild,$destpath);
chmod($despath, 0644);
header('Location:index.php');
exit;
?>