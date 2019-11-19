<?php
function getFinAidTable($id){
    $content = array('', '');
    $res = DB::pdo()->query("SELECT * FROM financialaid WHERE StuID=".$id." AND accepted != 1");
    $rowcount = $res->rowCount();

    $FAFSAcheck = DB::pdo()->query("SELECT * FROM student WHERE ID = ".$id." AND FAFSA_Recieved != 1");
    $rowcountFAFSA = $FAFSAcheck->rowCount();

    if ($rowcount OR $rowcountFAFSA) {
        //start of div
        $content[0].='<div class="portlet mtsu-portlet portlet-container portlet-original">'.
        '<h2 class="portlet-title">Financial Aid Check List</h2>'.
        '<div class="mtsu-portlet-content">';
        $content[1].='<div class="portlet mtsu-portlet portlet-container">'.
        '<h2 class="portlet-title">Financial Aid Check List</h2>'.
        '<div class="mtsu-portlet-content">';

        //if the s=university has not recieved the FAFSA
        if($rowcountFAFSA) {
          $content[0].='MTSU has not recieved your FAFSA, to be eligible for scholarships and loans
                        through the university please ensure that it has been submitted.';
          if(0 < $rowcountFAFSA - 1) $content[0].='<hr>';
          $content[1].='MTSU has not recieved your FAFSA, to be eligible for scholarships and loans
                        through the university please ensure that it has been submitted.';
          if(0 < $rowcountFAFSA - 1) $content[1].='<hr>';

          //If the student has private financial aid not affiliated with the university
          if($rowcount) {
            $content[0].='<hr>';
            $content[1].='<hr>';
            for ($i = 0; $i < $rowcount; $i++){
                $r = $res->fetch();

                $name = $r['name'];

                $content[0].='Do you remember about '.$name;
                if ($i < $rowcount-1) $content[0].='<hr>';
                $content[1].='Do you remember about '.$name;
                if ($i < $rowcount-1) $content[1].='<hr>';
          }
            }
        }
        //if iniversity has recieved the FAFSA and the student has pending financial aid
        else {
          for ($i = 0; $i < $rowcount; $i++) {
              $r = $res->fetch();

              $name = $r['name'];

              $content[0].='Do you remember about '.$name;
              if ($i < $rowcount-1) $content[0].='<hr>';
              $content[1].='Do you remember about '.$name;
              if ($i < $rowcount-1) $content[1].='<hr>';
            }
        }
        //end of div
        $content[0].='</div></div>';
        $content[1].='</div></div>';
    }

    return $content;
}
?>
