<?php
function getFinAidTable($id){
    $content = array('', '');
    $res = DB::pdo()->query("SELECT * FROM financialaid WHERE StuID=".$id." AND accepted != 1");
    $rowcount = $res->rowCount();
    if ($rowcount) {
        //start of div
        $content[0].='<div class="portlet mtsu-portlet portlet-container portlet-original">'.
        '<h2 class="portlet-title">Financial Aid Check List</h2>'.
        '<div class="mtsu-portlet-content">';
        $content[1].='<div class="portlet mtsu-portlet portlet-container">'.
        '<h2 class="portlet-title">Financial Aid Check List</h2>'.
        '<div class="mtsu-portlet-content">';

        for ($i = 0; $i < $rowcount; $i++){
            $r = $res->fetch();

            $type = $r['type'];

            $content[0].='Do you remember about '.$type;
            if ($i < $rowcount-1) $content[0].='<hr>';
            $content[1].='Do you remember about '.$type;
            if ($i < $rowcount-1) $content[1].='<hr>';
        }
        //end of div
        $content[0].='</div></div>';
        $content[1].='</div></div>';
    }

    return $content;
}
?>
