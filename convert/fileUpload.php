<?php
//This purpose of this file is the take a user-uploaded Bitmap image and
//convert it (via the Linux command line utility Autotrace) and then display
//it for the user to view.

//Housekeeping before execution. This will run to clean up leftovers from
//previous executions to keep things sanitary.
shell_exec('rm upload/*');

//Check the file size and file format of what the user uploads
$allowedExts = array("gif", "jpeg", "jpg", "png");

$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts)){
  if ($_FILES["file"]["error"] > 0)
    {
    //Return error code (if an error occurs)
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    //Move uploaded file to 'upload' folder
    move_uploaded_file($_FILES["file"]["tmp_name"],
    "upload/" . $_FILES["file"]["name"]);

    //Create variables that need to be escaped in order to be used in shell_execcommands properly
	
    $rasterTemp = "upload/" . $_FILES["file"]["name"];
    
    //Escaping the variables
    $escImage = escapeshellarg($rasterTemp);
    $escFormat = escapeshellarg($extension);

    //Tracing the picture and converting to SVG
    shell_exec("autotrace -input-format=$extension -output-file=vectorImage.svg -color-count 255 -background-color 000000 -despeckle-level 10 -output-format svg $escImage");

    //Move 'vectorImage.svg' to folder 'upload'
    shell_exec('mv /var/www/vectorImage.svg /var/www/upload/vectorImage.svg');

    //Make 'vectorImage.svg' readable
    $vectorTemp = "upload/vectorImage.svg";
    chmod("$vectorTemp",0444);

    //Begin HTML document used to display result
    echo"<!DOCTYPE HTML>";
    echo"<html>";
		echo"<head>";
			echo"<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />";
			echo"<style type='text/css'>";
				echo".imgDisplayDiv{";
				echo"text-align:center;";
				echo"}";
			echo"</style>";
		echo"</head>";
		echo"<body>";

    //Put raster picture in folder 'upload' and set permissions to readable
    $temp = "upload/" . $_FILES["file"]["name"];
    chmod("$temp",0444);

    //Fix header information of 'vectorImage2.svg' to mitigate MIMETYPE error 
    shell_exec('./headerFix.sh upload/vectorImage.svg');

    //Place 'vectorImage2.svg'
    //echo "<object height='400' width='400' data='upload/vectorImage2.svg' type='image/svg+xml'></object>";
    
    //Place original image along with link to view vectorized version
			echo "<img style='display:block; margin-left:auto; margin-right:auto;' src=" . "upload/" . $_FILES["file"]["name"] . "><br><br>";
			echo "<div class='imgDisplayDiv'>";
				echo "<a href='svgResult.html' target='_new'>Click here to see your vectorized picture</a>";
			echo "</div>";
    //echo "<img src=" . "upload/" . $_FILES["file"]["name"] . "><br>";
		echo "</body>";
    echo "</html>";
    }
  }
else //If the file type or size of the file is invalid after being passed through file checking
  {
  echo "Your file type is invalid or the image you chose was too large.";
  echo "This website will accept pictures in JPG, PNG or GIF formats whose file";
  echo "size is under 2 Megabytes in size.";
  echo "Please check your file type and size and try again.";
  }
?>