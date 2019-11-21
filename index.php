<?php
//Config for webprojects
//Change it to your own database logins
DEFINE ('DBUSER','SEPpipeline');
DEFINE ('DBPASS','b!4cKg01dT3x@s$+34');
DEFINE ('DBNAME','SEPpipeline');

include('confirm.php');
include('payment.php');
include('class.DB.php');
include('financialaid.php');
include('schedule.php');

session_start();
//if(array_key_exists('confirmation',$_POST)) echo $_POST
if(array_key_exists('confirmation',$_POST)){
	loadConfirmPg($_POST['confirmation']);
} else {
	if(!array_key_exists('id',$_POST)){
		$res = DB::pdo()->query("SELECT * FROM student WHERE 1 LIMIT 1");
		if ($res->rowCount() != 1){
			$params['STU_NAME'] = $params['ID'] = 'Empty Database';
		} else {
			$r = $res->fetch();
			$_SESSION['id'] = $r['ID'];

			// Load user according to session ID
			$params['STU_NAME'] = $r['fname'].' '.$r['mname'].' '.$r['lname'];
			$params['ID'] = 'M'.sprintf("%06s", $r['ID']);
		}
	} else {
		$_SESSION['id'] = $_POST['id'];
		$res = DB::pdo()->query("SELECT * FROM student WHERE id=".$_SESSION['id']." LIMIT 1");
		// Load user according to session ID
		$r = $res->fetch();
		$params['STU_NAME'] = $r['fname'].' '.$r['mname'].' '.$r['lname'];
		$params['ID'] = 'M'.sprintf("%06s", $_POST['id']);
	}

	//Get the confirm button template
	$params['CONFIRM'] = getConfirmBtn($_SESSION['id']);

	//Get the payment table template
	$payment = getPaymentTable($_SESSION['id']);
	$params['PAYMENT1'] = $payment[0];
	$params['PAYMENT2'] = $payment[1];

	//Get FinAid table template
	$finaid = getFinAidTable($_SESSION['id']);
	$params['FINAID1'] = $finaid[0];
	$params['FINAID2'] = $finaid[1];

	//Get schedule table template
	$schedule = getScheduleTable($_SESSION['id']);
	$params['SCHED1'] = $schedule[0];
	$params['SCHED2'] = $schedule[1];

	// Drop down ID list for switching through different accounts
	$res = DB::pdo()->query("SELECT * FROM student WHERE id");
	$rowCnt = $res->rowCount();
	$params['IDDROP'] = '';
	if ($rowCnt){
		$dropdown = '<select id="idpicker" onchange="changeUser(\'\', this);">';
		for($i = 0; $i < $rowCnt; $i++){
			$r = $res->fetch();
			$sel = $r['ID'] == intval($_SESSION['id']) ? 'selected' : '';
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
}
 ?>
