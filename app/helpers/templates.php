<?php

function getAssets($file='', $lang=''){
    $path = _WEB_HOST_TEMPLATE."/assets/".$lang.'/'.$file.'.'.$lang;
    return $path;
}

?>