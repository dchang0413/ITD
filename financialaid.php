<?php
function getFinAidTable($id){
    $content = '';
    $res = DB::pdo()->query("SELECT * FROM financialaid WHERE StuID=".$id." AND accepted != 1");
    $rowcount = $res->rowCount();
    if ($rowcount) {
        //start of div
        $content.='<div class="portlet mtsu-portlet portlet-container portlet-original">'.
        '<h2 class="portlet-title">Financial Aid Check List</h2>'.
        '<div class="mtsu-portlet-content">';

        for ($i = 0; $i < $rowcount; $i++){
            $r = $res->fetch();

            $type = $r['type'];

            $content.='Do you remember about '.$type;
            if ($i < $rowcount-1) $content.='<hr>';
        }
        //end of div
        $content.='</div></div>';
    }

    return $content;
}
?>
