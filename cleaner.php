 <?php
 error_reporting(0);
 if(isset($_GET['cleaner_yes_RGY']) and !empty($_GET['cleaner_yes_RGY'])){
 if($_GET['cleaner_yes_RGY']=="Yes , Do it"){
     $cacheDir = 'cache';
 foreach (glob($cacheDir . DIRECTORY_SEPARATOR . "*") as $imageFile) {
        if (file_exists($imageFile) && (filemtime($imageFile) < (time() - $cacheTime))) {
            unlink($imageFile);
        }
    }
 }
 }