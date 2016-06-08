
<?php
// Author : baltenspda
// Date : 16.02.2016
// Summary : Php page for upload a file

    session_start();

    // Check if there are some error in the import
    if($_FILES["filfileToUpload"]["error"]>0){
        //if error, print the number of the error
        print("Il y a eu des erreurs, importation avortée, vous serez redirigé dans 10 secondes <br>");
        print($_FILES["filfileToUpload"]["error"]);
        echo '<meta http-equiv="refresh" content="10;URL=myProfile.php">';
    }else{
        //if the file is correctly import, print the informations about the file
        //print("Nom d'origine du fichier : ".$_FILES["filfileToUpload"] ["name"]."<br>");
        //print("Type du fichier : ".$_FILES["filfileToUpload"] ["type"]."<br>");
        //print("Taille du fichier : ".($_FILES["filfileToUpload"] ["size"]/1024)." Kib"."<br>");
        //print("Nom temporaire du fichier : ".$_FILES["filfileToUpload"] ["tmp_name"]."<br><br>");

        //Find the extension
        $filName = $_FILES["filfileToUpload"]["name"];
        $filPath = pathinfo($filName);
        $filExtension = $filPath["extension"];

        if($filExtension == "jpg"){

            //Define the repertory where we can store the file
            $repPath = "../../userContent/profilePicture/";

            //Define an unique name for the file
            $filFinalName = $_SESSION['namPseudo'].".".$filExtension;

            //Rename and move the file
            if(move_uploaded_file($_FILES["filfileToUpload"]["tmp_name"],$repPath.$filFinalName)){
                echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
            }else{
                print "Failure";
            }
        }else{
            echo '<body onLoad="alert(\'Extension non valide\')"> ';
            echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
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