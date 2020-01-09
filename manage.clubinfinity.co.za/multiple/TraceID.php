<?php

    
function randid(){
$random_id_length = 5; 
$rnd_id = @crypt(uniqid(rand(),1)); 
$rnd_id = strip_tags(stripslashes($rnd_id)); 
$rnd_id = str_replace(".","",$rnd_id); 
$rnd_id = strrev(str_replace("/","",$rnd_id)); 
$rnd_id = substr($rnd_id,0,$random_id_length); 
return "$rnd_id" ;
}
$new_traceid = randid();

?>