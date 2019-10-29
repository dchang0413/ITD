<?php
//Config for webprojects
//Change it to your own database logins
DEFINE ('DBUSER','SEPpipeline');
DEFINE ('DBPASS','b!4cKg01dT3x@s$+34');
DEFINE ('DBNAME','SEPpipeline');

include('confirm.php');
include('payment.php');
include("class.DB.php");
include("financialaid.php");

$params = array();
if(!array_key_exists('id',$_POST)){
	$res = DB::pdo()->query("SELECT * FROM student WHERE 1 LIMIT 1");
	if ($res->rowCount() != 1){
		$params['STU_NAME'] = $params['ID'] = 'Empty Database';
	} else {
		$r = $res->fetch();
		$sess_id = $r['ID'];

		// Load user according to session ID
		$params['STU_NAME'] = $r['fname'].' '.$r['mname'].' '.$r['lname'];
		$params['ID'] = 'M'.sprintf("%06s", $r['ID']);
	}
} else {
	$sess_id = $_POST['id'];
	$res = DB::pdo()->query("SELECT * FROM student WHERE id=".$sess_id." LIMIT 1");
	// Load user according to session ID
	$r = $res->fetch();
	$params['STU_NAME'] = $r['fname'].' '.$r['mname'].' '.$r['lname'];
	$params['ID'] = 'M'.sprintf("%06s", $_POST['id']);
}

//Get the confirm button template
$params['CONFIRM'] = getConfirmBtn($sess_id);

//Get the payment table template
$params['PAYMENT'] = getPaymentTable($sess_id);

//Get FinAid table template
$params['FINAID'] = getFinAidTable($sess_id);

// Drop down ID list for switching through different accounts
$res = DB::pdo()->query("SELECT * FROM student WHERE id");
$rowCnt = $res->rowCount();
$params['IDDROP'] = '';
if ($rowCnt){
	$dropdown = '<select id="idpicker" onchange="changeUser(\'\', this);">';
	for($i = 0; $i < $rowCnt; $i++){
		$r = $res->fetch();
		$sel = $r['ID'] == intval($sess_id) ? 'selected' : '';
		$dropdown.='<option value='.$r['ID'].' '.$sel.'>M'.sprintf("%06s", $r['ID']).'</option>';
	}
	$dropdown.='</select>';
	$params['IDDROP'] = $dropdown;
}
// End of Drop down ID list generation

$content = file_get_contents('home.html');

foreach($params as $key => $val){
	$content = str_replace('['.$key.']',$val,$content);
}
echo $content ;
?>
