<?php
function getPaymentTable($id){
    $content = '';
    $res = DB::pdo()->query("SELECT * FROM balance WHERE StuID=".$id);
    if ($res->rowCount()) {

    }

    return $content;
}
?>
