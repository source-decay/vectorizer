<?php
//Don't mind me - I'm just the janitor
shell_exec('rm upload/*');

$allowed	=	array('gif', 'png', 'jpg');
$filename	=	$_FILES['fileChoice']['name'];
$tmpname	=	$_FILES['fileChoice']['tmp_name'];
$error		=	$_FILES['fileChoice']['error'];
$size		=	$_FILES['fileChoice']['size'];
$ext		=	pathinfo($filename, PATHINFO_EXTENSION);

/*This is not the code you are looking for - debugging it is for
 * if(!in_array($ext,$allowed)){
	echo 'error';
} else {
	echo 'okay then';
}

echo '<pre>';
if (move_uploaded_file($_FILES['fileChoice']['tmp_name'], $uploadfile)) {
	echo 'File is valid, and was successfully uploaded.';
} else {
		echo 'Uh oh, your file didn\'t upload successfully. Are you sure ' . 
		'it\'s a JPG or PNG and no larger than 2 Mb?';
}
print_r($_FILES);
echo '</pre>';
 */

$uploaddir	= '/var/www/html/vectorizer/upload/';
$uploadfile	= $uploaddir . basename($_FILES['fileChoice']['name']);

//Make sure that the image the user supplies is kosher
if (in_array($ext,$allowed) && $size < 2000000){
	
	move_uploaded_file($tmpname, $uploadfile);
	chmod($uploadfile, 0666);

	$filename_tga = preg_replace("/.jpg$/", ".tga", $uploadfile);
	$convert_command = "djpeg -targa " . $uploadfile . " > " . $filename_tga;
	exec ($convert_command);
	
	$filename_svg = preg_replace("/.jpg$/", ".svg", $uploadfile);
	$autotraceCmd = "autotrace -color-count 255 -despeckle-level 5" .
	" -input-format tga -output-file " . $filename_svg . " " . $filename_tga;
	exec($autotraceCmd);
	@unlink ($filename_tga);

	if (file_exists($filename_svg)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment;' .
		' filename="'.basename($filename_svg).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename_svg));
		readfile($filename_svg);
		exit;
	}
} else {
	exit("Houston, we have a problem! ($error)");
}
	//print_r($_FILES);
?>
