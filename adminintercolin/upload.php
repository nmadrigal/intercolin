<?php
 $ds          = DIRECTORY_SEPARATOR;  //1
 
 //$storeFolder = '/Content/Images/Casas/Venta';   //2
 $directory = $storeFolder = $_SERVER['DOCUMENT_ROOT']."/uploads";
 
 //if (file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name']))

 
 if(isset($_GET["action"]))
	$action =  $_GET["action"];
 
 if(isset($_POST["action"]))
	$action =  $_POST["action"];
 
 switch($action){	
	case "uploadImages";
		if (!empty($_FILES)) {		     
			 $tempFile = $_FILES['file']['tmp_name'];          //3                   
			 include('SimpleImage.php'); 
			 $image = new SimpleImage(); 
			 $image->load($tempFile); 
			 $image->resize(800,600); 			 			 
			 $targetPath = $storeFolder.$ds;  //4     
			 $targetFile =  $targetPath.$_FILES['file']['name'];  //5	
			 $image->save($targetFile); 
			 //move_uploaded_file($tempFile,$targetFile); //6     
		}
		
		break;
 
	case "moveImages";
		$id = $_POST["lastID"];
		$suff = "img-".$id."-";
		//$directory = "uploads";
		if(isset($storeFolder) && file_exists($directory)){
			$dirint = dir($directory);
			
		} 
		mkdir($directory."/".$id, 0777);
		chmod($directory."/".$id, 0755);
		 while (($archivo = $dirint->read()) !== false)
		 {																
			if (eregi("jpg", $archivo)){ 
				$ext = ".jpg";	
			}
			if(eregi("png", $archivo)){
				$ext = ".png";
			}
			if(eregi("gif", $archivo)){
				$ext = ".gif";
			}
			if(eregi("png", $archivo) || eregi("jpg", $archivo) || eregi("gif", $archivo))
				$renamed = rename($directory."/".$archivo, $directory."/".$id."/img".$id."-".$archivo);
							
		 }
		
		echo $renamed;
		
		break;
		
	case "removeImage";
		 if(isset($_POST["remove"]))
		 {
			$fileUnlink = $_POST["remove"];
			$fileUnlink = $directory."/".$fileUnlink;
			if (file_exists($fileUnlink)) {
				$unlink = unlink($fileUnlink); 
			}
		 }
		echo $fileUnlink;
		
		break;
 
 }
 
//- See more at: http://www.startutorial.com/articles/view/how-to-build-a-file-upload-form-using-dropzonejs-and-php#sthash.G7RyyOER.dpuf

?> 
