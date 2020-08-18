<?php
session_start();
// echo '<p>TEST CONFIRM</p>';

include_once('myClasses\Vcoeoci.class.php'); 

if(key_exists('hsh', $_GET) and strlen($_GET['hsh']) == 32){
    $vcoe = New myClasses\Vcoeoci;
    $strsql1 = "select * from entries where hashed_email = '" . htmlentities($_GET['hsh']) . "'";
    $arrRecs = $vcoe->ArrayFromDB($strsql1);
}else{
    $arrRecs = [];
};

//Es sollte genau ein Eintrag abgefragt worden sein mit dem entspr. hash...
if(count($arrRecs)>0){

    $strsql2 = "Update entries set marked_del = 0 where hashed_email = '" . htmlentities($_GET['hsh']) . "'";
    $vcoe = New myClasses\Vcoeoci;
    $vcoe->execute($strsql2); 

    if($vcoe->execute($strsql2)>0){
        
        //Success...
        header("Location: index.php?noticode=3");
        die();
    }else{
        //Fehler...
        header("Location: index.php?noticode=3");
        die();
    }

}else{
    //Fehler...
    header("Location: index.php?noticode=4");
    die();   
};

?>
