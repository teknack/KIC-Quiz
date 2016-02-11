<?php

	session_start();
    // $_SESSION['tek_emailid']=$email;
    // $_SESSION['tek_fname']=$fname;

    $mail=$_SESSION['tek_emailid'];
    $name=$_SESSION['tek_fname'];

	include_once 'includes/con.php';

	// $_POST['qid']=1;
	// $_POST['ansid']=1;
	if (isset($_POST['qid']) && $_POST['ansid']) {

		$qid=$_POST['qid'];
		$ansid=intval($_POST['ansid']);

		$stmt1 = "SELECT ans_json FROM score WHERE email = '$mail'";
		$result = $con->query($stmt1);
		while ($row = $result->fetch_assoc()) {
			$ans_json = json_decode($row['ans_json']);
		}
		$ans_json[$qid-1] = $ansid;
		$ans_enj = json_encode($ans_json);
		$sflag = 1;
		// echo json_encode($ans_json);
		$stmt2 = "UPDATE score SET ans_json = '$ans_enj' WHERE email = '$mail'";
		$result = $con->query($stmt2);

	}else{
		$sflag = 0;
	}
	echo json_encode(array('success' => $sflag));
?>