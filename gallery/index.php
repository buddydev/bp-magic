<?php
//switch the control to respective components
global $bp;
$g_template='';
if(bp_is_gallery_directory())
    $g_template='gallery/directory.php';
	
else if(bp_is_group ())
    $g_template ='gallery/groups/index.php';
else
    $g_template='gallery/members/index.php';
$g_template=apply_filters("gallery_locate_template",$g_template);

locate_template( array($g_template ), true ) ;
				

?>