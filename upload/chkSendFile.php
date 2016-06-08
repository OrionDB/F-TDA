
<?php
// Author : baltenspda
// Date : 16.02.2016
// Summary : Php page for upload a file

    // Check if there are some error in the import
    if($_FILES["filfileToUpload"]["error"]>0){
        //if error, print the number of the error
        print("Il y a eu des erreurs, importation avortée <br>");
        print($_FILES["filfileToUpload"]["error"]);
    }else{
        //if the file is correctly import, print the informations about the file
        print("Nom d'origine du fichier : ".$_FILES["filfileToUpload"] ["name"]."<br>");
        print("Type du fichier : ".$_FILES["filfileToUpload"] ["type"]."<br>");
        print("Taille du fichier : ".($_FILES["filfileToUpload"] ["size"]/1024)." Kib"."<br>");
        print("Nom temporaire du fichier : ".$_FILES["filfileToUpload"] ["tmp_name"]."<br><br>");

        //Find the extension
        $filName = $_FILES["filfileToUpload"]["name"];
        $filPath = pathinfo($filName);
        $filExtension = $filPath["extension"];


        //Define the repertory where we can store the file
        //$repPath = "C:/Users/baltenspda/Desktop/EasyPHP-DevServer-14.1VC11-Portable/data/localweb/projects/X-baltenspda-ex-upload/upload/";
        $repPath = "upload/";

        //Define an unique name for the file
        //$filFinalName = date("d-m-Y-H-i").$_FILES["filfileToUpload"]["name"];
        $filFinalName = "up".date("d-m-Y-H-i").$filPath["filename"].".".$filExtension;

        //Rename and move the file
        if(move_uploaded_file($_FILES["filfileToUpload"]["tmp_name"],$repPath.$filFinalName)){
            print "Le fichier temporaire ".$_FILES["filfileToUpload"]["tmp_name"]." a été déplacé vers ".$repPath.$filFinalName;
        }else{
            print "Failure";
        }
    }

?>
<!DOCTYPE html>

<html>
<head lang="en">
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

</body>
</html>