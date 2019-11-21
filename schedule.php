<?php
function getScheduleTable($id, $term = "F2019"){
    $content = array(
        '',
        '',
    );
    $res = DB::pdo()->query("SELECT * FROM schedule WHERE StuID = {$id} and semester = \"{$term}\" ORDER BY startTime");
    $rowcount = $res->rowCount();

    $days = array(
        'M' => array(),
        'T' => array(),
        'W' => array(),
        'R' => array(),
        'F' => array(),
        'S' => array(),
    );

    for($i = 0; $i < $rowcount; $i++){
        $r = $res->fetch();
        $bin = array(
            32 => 'S',
            16 => 'F',
            8 => 'R',
            4 => 'W',
            2 => 'T',
            1 => 'M'
        );
        foreach($bin as $k => $v){
            if ($r['days'] >= $k){
                array_push(
                    $days[$v],
                    array(
                        'start' => $r['startTime'],
                        'end' => $r['endTime'],
                        'loc' => $r['location'],
                        'name' => $r['className'] ? $r['className'] : 'Invalid Class Name'
                    )
                );
                $r['days'] -= $k;
            }
        }
        //debug stuff
        /*foreach($r as $key => $val){
            echo "{$key} => {$val} \n";
        }*/
    }

    $j = 1;
    $content[0].= '<div class="portlet mtsu-portlet portlet-container portlet-original">
        <table style="width: 100%">
        <h2 class="portlet-title">Weekly Schedule</h2>
            <tr>';
    $content[1].= '<div class="portlet mtsu-portlet portlet-container">
        <table style="width: 100%">
        <h2 class="portlet-title">Weekly Schedule</h2>
            <tr>';
    foreach($days as $key => $val){
        if($key != '') {
            if ($j == date('w')){
                $content[0].="<th id=\"SchedHead2{$j}\" style=\"width:16.6%\" class=\"ScheduleHeadSel\" onclick=\"changeSchedTab2('{$j}')\">{$key}</th>";
                $content[1].="<th id=\"SchedHead{$j}\" style=\"width:16.6%\" class=\"ScheduleHeadSel\" onclick=\"changeSchedTab('{$j}')\">{$key}</th>";
            } else {
                $content[0].="<th id=\"SchedHead2{$j}\" style=\"width:16.6%\" onclick=\"changeSchedTab2('{$j}')\">{$key}</th>";
                $content[1].="<th id=\"SchedHead{$j}\" style=\"width:16.6%\" onclick=\"changeSchedTab('{$j}')\">{$key}</th>";
            }
        }
        $j++;
    }
    $j = 1;
    $content[0].= '</tr> <tr>';
    $content[1].= '</tr> <tr>';
    foreach($days as $key => $val){
        if($key != ''){

            if ($j == date('w')){
                $content[0].= '<td id="SchedCell2'.$j.'" class="ScheduleCell" style="text-align:center" colspan=6>';
                $content[1].= '<td id="SchedCell'.$j.'" class="ScheduleCell" style="text-align:center" colspan=6>';
            } else {
                $content[0].= '<td id="SchedCell2'.$j.'" class="ScheduleCell" style="display: none; text-align:center">';
                $content[1].= '<td id="SchedCell'.$j.'" class="ScheduleCell" style="display: none; text-align:center">';
            }
            $k = 0;
            if(sizeof($val)){
                foreach($val as $keys => $vals){
                    $name = $vals['name'];
                    $start = substr($vals['start'],0,5);
                    $end = substr($vals['end'],0,5);
                    $loc = $vals['loc'];

                    $content[0].="{$name}<br>{$start} - {$end} <br> {$loc} <br>";
                    $content[1].="{$name}<br>{$start} - {$end} <br> {$loc} <br>";
                    if ($k != sizeof($val)-1){
                        $content[0].='<hr>';
                        $content[1].='<hr>';
                    }
                    //debug stuff
                    /*foreach($vals as $k => $v){
                        echo "{$key} => {$k} => {$v}\n";
                    }*/
                    $k++;
                }
            } else {
                $content[0].='You have no classes today';
                $content[1].='You have no classes today';
            }
            $content[0].='</td>';
            $content[1].='</td>';
            $j++;
        }
    }
    $content[0].='</tr></table></div>';
    $content[1].='</tr></table></div>';

    return $content;
}
?>
