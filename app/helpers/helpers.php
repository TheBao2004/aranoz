<?php

use core\DB;

function redirect($url='/index.php', $real=false){
    if(empty($real)) $url = _WEB_HOST_ROOT.'/'.$url;
    header('Location: '.$url);
    exit();
}

function back(){
    if(!empty($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER'];
    }else{
        $url = _WEB_HOST_ROOT.'/index.php';
    }
    header('Location: '.$url);
    exit();
}

function route($router){
    $router = str_replace('.', '/', $router);
    return _WEB_HOST_ROOT.'/'.$router;
}

function layout(){

}

function getAsset($rank){
    return _WEB_HOST_TEMPLATE."/$rank/assets";
}

function spanError($errors, $key){
    if(!empty($errors[$key])){
        $error = $errors[$key];
        return '<span class="text-danger mt-2 d-inline-block">'.$error.'</span>';
    }
}

function old($olds, $key, $check=''){
    if(!empty($olds[$key])){
        $old = $olds[$key];
        if(!empty($check)){
            if($old == $check) return true;
            return false;
        }
        return $old;
    }
}

function alert($msg, $type='success'){
    if(!empty($msg)) return '<div class="alert alert-'.$type.'">'.$msg.'</div>';
}

function query($item=null){
    if(!empty($_SERVER['REDIRECT_QUERY_STRING'])){
        return $item.$_SERVER['REDIRECT_QUERY_STRING'];
    }
    return false;
}

function timeFormat($strTime, $format){
    $dataObject = date_create($strTime);
    if(!empty($dataObject)){
        return date_format($dataObject, $format);
    }
    return false;
}

function notNull($variable, $value='NULL'){
    if(!empty($variable)) return $variable;
    return $value;
}

function yeno($status, $yes='Yes', $no='No'){
    if(!empty($status)) return $yes;
    return $no;
}

function image($image, $rank='client', $type=false){
    if(empty($type)){
        return _WEB_HOST_TEMPLATE.'/'.$rank.'/images/'.$image;
    }
    return _WEB_PATH_TEMPLATE.'/'.$rank.'/images/'.$image;
}

function numberCart(){

    $user = Auth::User();

    if(empty($user)) return 0;

    $carts = DB::db()->table('carts')->where('user_id', '=', $user['id'])->get();

    if(!empty($carts)){
        $quantity = 0;
        foreach ($carts as $key => $cart) {
            $quantity += $cart['quantity'];
        }

        return $quantity;
        
    }else{
        return 0;
    }

}

function aasss($a, $b, $call){
    $call($b, $b);
};

aasss(1, 3, function($a){
    // echo $a;
});










?>
































<?php

function pagination($totalPage, $page, $url, $fillter="", $number=2){

?>

<?php
    if(!empty($totalPage) && $totalPage > 1 ):

        $back = $page-1;
        if($back < 1){
            $back = 1;
        }
        $next = $page+1;
        if($next > $totalPage){
            $next = $totalPage;
        }
?>    
    <nav aria-label="Page navigation example" class="mt-3 text-right d-flex flex-row-reverse">
    <ul class="pagination">
        <li class="page-item d-<?php echo $page==1?'none':'block'; ?>">
        <a class="page-link" href="<?php echo route("$url/page-$back$fillter"); ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>

<?php
        $pageS = $page-$number;
        if($pageS < 1){
            $pageS = 1;
        }
        $pageE = $page+$number;
        if($pageE > $totalPage){
            $pageE = $totalPage;
        }    

        for ($i=$pageS; $i <= $pageE; $i++):
?>
        <li class="page-item <?php echo $page==$i?'active':''; ?>"><a class="page-link" href="<?php echo route("$url/page-$i$fillter"); ?>"><?php echo $i; ?></a></li>
<?php
        endfor;
?>
        <li class="page-item d-<?php echo $page==$totalPage?'none':'block'; ?>">
        <a class="page-link" href="<?php echo route("$url/page-$next$fillter"); ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
    </nav>
<?php endif; ?>  
<?php } ?>