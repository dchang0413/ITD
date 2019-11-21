<?php
function getPaymentTable($id){
    $content = array('', '');
    $res = DB::pdo()->query("SELECT * FROM balance WHERE StuID=".$id." AND fee < 0");
    $rowcount = $res->rowCount();
    if ($rowcount) {
        //start of div
        $content[0].='<div class="portlet mtsu-portlet portlet-container portlet-original">'.
        '<h2 class="portlet-title">Payment Due</h2>'.
        '<div class="mtsu-portlet-content">';
        $content[1].='<div class="portlet mtsu-portlet portlet-container">'.
        '<h2 class="portlet-title">Payment Due</h2>'.
        '<div class="mtsu-portlet-content">';

        for ($i = 0; $i < $rowcount; $i++){
            $r = $res->fetch();

            $title = $r['type'];
            $fee = -$r['fee'];
            $date = explode('-',$r['dueDate']);
            $y = $date[0];
            $m = $date[1];
            $d = $date[2];
            $duedate = join('/',array($m,$d,$y));

            $content[0].=$title.': $'.sprintf("%.2f", $fee).' is due on '.$duedate;
            if ($i < $rowcount-1) $content[0].='<hr>';
            $content[1].=$title.': $'.sprintf("%.2f", $fee).' is due on '.$duedate;
            if ($i < $rowcount-1) $content[1].='<hr>';
        }
        //end of div
        $content[0].='</div></div>';
        $content[1].='</div></div>';
    }

    return $content;
}
?>
