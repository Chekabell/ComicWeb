<?php session_start();

setcookie("project_name", $_POST['project_name'], time()+1000,"/");
setcookie("description", $_POST['description'], time()+1000,"/");
setcookie("average_rating", $_POST['average_rating'], time()+1000,"/");
setcookie("url_read", $_POST['url_read'], time()+1000,"/");

require_once 'dbconnect.php';
$sth = $db->prepare("INSERT INTO mainschem.projects (project_name, description, average_rating, url_read) VALUES(:project_name, :description, :average_rating, :url_read)");
if($sth->execute([':project_name' => $_POST['project_name'], ':description' => $_POST['description'],':average_rating' => $_POST['average_rating'], ':url_read' => $_POST['url_read']])){
    $sth = $db->query("SELECT id_project FROM mainschem.projects WHERE project_name = " . $db->quote($_POST['project_name']));
    $data = $sth->fetch();
    $upploadDir = "C:\OSPanel\domains\ComicWeb\IMG\PROJECT_PHOTO\\";
    $upploadFile = $upploadDir . $data[0] . ".png";

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upploadFile)) {
        $w = 720;
        $h = 967;
           
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

        if (empty($w)) {
            $w = ceil($h / ($height / $width));
        }
        if (empty($h)) {
            $h = ceil($w / ($width / $height));
        }
         
        $tmp = imageCreateTrueColor($w, $h);
        if ($type == 3) {
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

        $w = 620;
        $h = 877;

        $x = '60';
        $y = '60';
        
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

}