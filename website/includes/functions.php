<?php
function execute_sql_query($sql) {
    include_once('./includes/config.php');

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->errno) {
        print "<p>$mysqli->error</p>";
        print "</body>";
        exit();
    }
    //Get the data
    $result = $mysqli->query($sql);

    print "<p style='display:none'>$sql</p>";
    //If no result, print the error
    if (!$result) {
        print($mysqli->error);
    }
    return $result;
}

// Function from http://us3.php.net/manual/en/function.imagecopyresampled.php#104028
function image_resize($src, $dst, $width, $height, $crop=0){

    if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

    $type = strtolower(substr(strrchr($src,"."),1));
    if($type == 'jpeg') $type = 'jpg';
    switch($type){
        case 'bmp': $img = imagecreatefromwbmp($src); break;
        case 'gif': $img = imagecreatefromgif($src); break;
        case 'jpg': $img = imagecreatefromjpeg($src); break;
        case 'png': $img = imagecreatefrompng($src); break;
        default : return "Unsupported picture type!";
    }

    // resize
    if($crop){
        if($w < $width or $h < $height) return "Picture is too small!";
        $ratio = max($width/$w, $height/$h);
        $h = $height / $ratio;
        $x = ($w - $width / $ratio) / 2;
        $w = $width / $ratio;
    }
    else{
        if($w < $width and $h < $height) return "Picture is too small!";
        $ratio = min($width/$w, $height/$h);
        $width = $w * $ratio;
        $height = $h * $ratio;
        $x = 0;
    }

    $new = imagecreatetruecolor($width, $height);

    // preserve transparency
    if($type == "gif" or $type == "png"){
        imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
    }

    imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

    switch($type){
        case 'bmp': imagewbmp($new, $dst); break;
        case 'gif': imagegif($new, $dst); break;
        case 'jpg': imagejpeg($new, $dst); break;
        case 'png': imagepng($new, $dst); break;
    }
    return true;
}


?>