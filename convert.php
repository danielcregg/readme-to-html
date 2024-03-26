<?php
require_once 'vendor/autoload.php'; 

if(isset($_POST['url'])) {
            $readme_content = file_get_contents($_POST['url']);
                $Parsedown = new Parsedown();
                echo $Parsedown->text($readme_content);
} else {
            echo "Error: No README URL provided.";
}
?>
