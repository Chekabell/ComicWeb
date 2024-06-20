<?
session_start();

require_once 'dbconnect.php';
$sth = $db->query("SELECT id_user FROM mainschem.account WHERE nickname = " . $db->quote($_SESSION['nickname']));
$data = $sth->fetch();
$upploadDir = "C:\OSPanel\domains\ComicWeb\IMG\PROFILE_PHOTO\\";
$upploadFile = $upploadDir . $data[0] . ".png";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upploadFile)) {
    $db->query("UPDATE mainschem.account SET avatar = true WHERE nickname = " . $db->quote($_SESSION['nickname']));
	$info   = getimagesize($upploadFile);
	$width  = $info[0];
	$height = $info[1];
	$type   = $info[2];

	switch ($type) { 				
		case 2: 
			$img = imageCreateFromJpeg($upploadFile);
			break;
		case 3: 
			$img = imageCreateFromPng($upploadFile); 
			imageSaveAlpha($img, true);
			break;
	}


	$w = 512;
	$h = 512;
	
	if (empty($w)) {
		$w = ceil($h / ($height / $width));
	}
	if (empty($h)) {
		$h = ceil($w / ($width / $height));
	}
	
	$tmp = imageCreateTrueColor($w, $h);
	if($type == 3){
		imagealphablending($tmp, true); 
		imageSaveAlpha($tmp, true);
		$transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127); 
		imagefill($tmp, 0, 0, $transparent); 
		imagecolortransparent($tmp, $transparent);   
	}  
	
	$tw = ceil($h / ($height / $width));
	$th = ceil($w / ($width / $height));
	if ($tw < $w) {
		imageCopyResampled($tmp, $img, ceil(($w - $tw) / 2), 0, 0, 0, $tw, $h, $width, $height);        
	} else {
		imageCopyResampled($tmp, $img, 0, ceil(($h - $th) / 2), 0, 0, $w, $th, $width, $height);    
	}            
	
	$img = $tmp;

	$width = $w;
	$height = $h; 

	$w = 256;
	$h = 256;

	$x = '0';
	$y = '50%';
	
	if (strpos($x, '%') !== false) {
		$x = intval($x);
		$x = ceil(($width * $x / 100) - ($w / 100 * $x));
	}
	if (strpos($y, '%') !== false) {
		$y = intval($y);
		$y = ceil(($height * $y / 100) - ($h / 100 * $y));
	}
	
	$tmp = imageCreateTrueColor($w, $h);
	if ($type == 3) {
		imagealphablending($tmp, true); 
		imageSaveAlpha($tmp, true);
		$transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127); 
		imagefill($tmp, 0, 0, $transparent); 
		imagecolortransparent($tmp, $transparent);    
	}     
	
	
	imageCopyResampled($tmp, $img, 0, 0, $x, $y, $width, $height, $width, $height);
	$img = $tmp;

	imagePng($img, $upploadFile);
	imagedestroy($img);

	header('Location: http://comicweb/index.php');
	exit();
}
