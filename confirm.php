<?php
function getConfirmBtn($id){
  $content = '';

  $res = DB::pdo()->query("SELECT confirmed FROM student WHERE id=".$id." LIMIT 1");
  if ($res->rowCount()) {
  	$r = $res->fetch();
    $confirmed = $r['confirmed'] == 1 ? true : false;
  } else $confirmed = false;

  if (!$confirmed){
    $content.='<div id="confirm" class="confirmation" onclick="window.location=\'google.com\'">'.
    'Confirm your classes'.
    '</div>';
  }

  return $content;
}
?>
