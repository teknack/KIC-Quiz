<?php 
	include_once 'includes/con.php';
	session_start();

    $mail=$_SESSION['tek_emailid'];
    $name=$_SESSION['tek_fname'];

    if (isset($_POST['sub'])) {
    	$stmt1 = "SELECT ans_json FROM score WHERE email='$mail'";
	    $result = $con->query($stmt1);
	    if (!$result) {
	    	echo "Error fetching user answer";
	    }
	    while ($row = $result->fetch_assoc()) {
	        $ans_json = json_decode($row['ans_json']);
	    }
	    $stmt2 = "SELECT CONCAT('[',GROUP_CONCAT(right_ans),']') AS right_ans_json FROM answers WHERE trashed=0";
	    $result = $con->query($stmt2);
	    if (!$result) {
	    	echo "Error fetching right answer";
	    }
	    while ($row = $result->fetch_assoc()) {
	        $right_ans_json = json_decode($row['right_ans_json']);
	    }
	    $score = 0;
	    foreach ($ans_json as $key => $value) {
	    	// echo $value.'-'.$right_ans_json[$key];
	    	if ($value == $right_ans_json[$key]) {
	    		$score++;
	    	}
	    }
	    $stmt3 = "UPDATE score SET main_score='$score', end=1 WHERE email='$mail'";
	    $result = $con->query($stmt3);
	    if (!$result) {
	    	echo "Error updating score";
	    }
	    // echo $mail;
	    // echo $score;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Score</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css" />
</head>
<body>
	<div class="container">
		<div style="padding-top:100px;">
			<center>
				<div style="height:300px;width:300px;border-radius:150px;background:#222">
					<p style="font-size:180px;color:#FFF;margin-bottom:0px;"><?php echo $score; ?></p>
					<p style="font-size:32px;margin-top:-40px;color:#FFF;">score</p>
				</div>
				<p style="font-size:72px;">Thank you for playing</p>
				<button style="font-size:22px;padding:30px 60px;" class="btn btn-lg btn-default btn-outline">Go back to Teknack</button>
			</center>
		</div>
	</div>
	<script type="text/javascript" src="lib/jquery-2.2.0/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</body>
</html>