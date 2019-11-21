<?php
function getConfirmBtn($id){
    $content = '';
    $res = DB::pdo()->query("SELECT confirmed FROM student WHERE id=$id LIMIT 1");
    if ($res->rowCount()) {
        $r = $res->fetch();
        $confirmed = $r['confirmed'] == 1 ? true : false;
    } else $confirmed = false;

    if (!$confirmed){
        $content.='<div id="confirm" class="confirmation" onclick="confirmClasses('.$id.')">'.
        'Confirm your classes'.
        '</div>';
    }

    return $content;
}


function loadConfirmPg($id){
    DB::pdo()->query("update student set confirmed = 1 where id = $id");

    $returntxt = '<div style="font: 16px \'Nunito Sans\', sans-serif; color:white; position:relative; top:250px; text-align:center" onclick="returnHome('.$id.')">Return</div>'.
    '<script src="/script/main.js"></script>';

    $content = file_get_contents('confirmed.html');
    $content = str_replace('[RETURN]', $returntxt, $content);
    echo $content;
}
?>
