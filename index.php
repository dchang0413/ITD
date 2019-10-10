<?php
$params = array();
if(!array_key_exists('id',$_POST)){
	$sess_id = 1;
} else {
	$sess_id = $_POST['id'];
}

include('confirm.php');
include("class.DB.php");

$res = DB::pdo()->query("SELECT * FROM student WHERE id=".$sess_id." LIMIT 1");

$params['CONFIRM'] = getConfirmBtn($sess_id);
if ($res->rowCount()) {
	$r = $res->fetch();
	$params['STU_NAME'] = $r['fname'].' '.$r['lname'];
	$params['ID'] = 'M'.sprintf("%06s", $r['id']);
} else {
  echo '<p>Invalid sess_id</p>';
}

$res = DB::pdo()->query("SELECT * FROM student WHERE id");
$rowCnt = $res->rowCount();
if ($rowCnt){
	$dropdown = '<select id="idpicker" onchange="changeUser(\'\', this);">';
	for($i = 0; $i < $rowCnt; $i++){
		$r = $res->fetch();
		$sel = $r['id'] == intval($sess_id) ? 'selected' : '';
		$dropdown.='<option value='.$r['id'].' '.$sel.'>M'.sprintf("%06s", $r['id']).'</option>';
	}
	$dropdown.='</select>';
	$params['IDDROP'] = $dropdown;
}

$content = file_get_contents('home.html');

foreach($params as $key => $val){
	$content = str_replace('['.$key.']',$val,$content);
}
echo $content ;
?>
