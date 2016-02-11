<?php
    $email='xxx@xxx.xxx';
    $fname='xxx';
    include_once 'includes/con.php';

    session_start();
    $_SESSION['tek_emailid']=$email;
    $_SESSION['tek_fname']=$fname;

    $mail=$_SESSION['tek_emailid'];
    $name=$_SESSION['tek_fname'];

    $stmt2 = "  INSERT INTO `score`(`name`, `email`) VALUES ('$name','$mail')";
    $result = $con->query($stmt2);
    // if (!$result) {
    //     die("Database Error");
    // }
    $stmt1 = "  SELECT q.id,q.question,a.option1,a.option2,a.option3,a.option4 
                FROM questions q 
                LEFT JOIN answers a ON q.id=a.question_id
                WHERE q.trashed = 0";
    // echo json_encode(array(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1));

    $stmt3 = "  SELECT ans_json FROM score WHERE email='$mail'";
    $result2 = $con->query($stmt3);
    while ($row = $result2->fetch_assoc()) {
        $ans_json = json_decode($row['ans_json']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PHP Quiz</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css" />
</head>
<body>
    
    <div class="site-wrapper">
        <div class="inner-site-wrapper">
            <div style="margin-top:-40px;">
                <center>
                    <p style="font-size:54px;">GRE QUIZ&nbsp;<sub style="font-size:16px;">by KIC.Education</sub></p>
                </center>
            </div>
            <div class="content">
                
            
        
        <?php
            $result=$con->query($stmt1);
            if ($result->num_rows > 0) {
                $i=0;
                while ($row = $result->fetch_assoc()) {
                    $radio_check = ["","","",""];
                        if ($ans_json[$row['id']-1] != 0) {
                            $radio_check[$ans_json[$row['id']-1]-1]="checked";
                        }
                    $i++;
                    echo "  <div id='qus-".$row['id']."' class='card quiz-qus'>
                                <h3>Question ".$row['id']."</h3>
                                <p class='main-qus'>".$row['question']."</p>
                                <div style='font-size:18px;'>
                                    <div class='radio'>
                                        <label>
                                            <input class='options' type='radio' name='option-quiz-".$row['id']."' value='1' data-quiz='".$row['id']."' ".$radio_check[0].">
                                            ".$row['option1']."
                                        </label>
                                    </div>
                                    <div class='radio'>
                                        <label>
                                            <input class='options' type='radio' name='option-quiz-".$row['id']."' value='2' data-quiz='".$row['id']."' ".$radio_check[1].">
                                            ".$row['option2']."
                                        </label>
                                    </div>
                                    <div class='radio'>
                                        <label>
                                            <input class='options' type='radio' name='option-quiz-".$row['id']."' value='3' data-quiz='".$row['id']."' ".$radio_check[2].">
                                            ".$row['option3']."
                                        </label>
                                    </div>
                                    <div class='radio'>
                                        <label>
                                            <input class='options' type='radio' name='option-quiz-".$row['id']."' value='4' data-quiz='".$row['id']."' ".$radio_check[3].">
                                            ".$row['option4']."
                                        </label>
                                    </div>
                                </div>
                                <div class='card-footer'>
                                    <button value='".$row['id']."' data-action='prev' class='btn btn-outline btn-default pull-left nav-btn'>< Prev</button>
                                    <button value='".$row['id']."' data-action='next' class='btn btn-default pull-right nav-btn'>Next ></button>
                                </div>
                            </div>";

                }
            }
        ?>
                            <div id='qus-11' class="card">
                                <div class='card-footer'>
                                    <h3>Hey <?php echo $name;?>,<br />
                                        You've completed the quiz. Click the 'submit' button to finalize.
                                    </h3>
                                    <center>
                                        <form role="form" action='finalize.php' method="POST">
                                            <button style="margin-top:30px;font-size:18px;padding:15px 30px;" class="btn btn-lg btn-default" name="sub" value="1" type="submit">Submit Your answers</button>
                                        </form>
                                    </center>
                                    <button style="margin-top:100px;" value='11' data-action='prev' class='btn btn-default pull-left nav-btn btn-outline'>< Prev</button>
                                    <!-- <button value='".$row['id']."' data-action='next' class='btn btn-primary pull-right nav-btn'>Next ></button> -->
                                </div>
                            </div>

            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="lib/jquery-2.2.0/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.card').css('display','none');
        $('#qus-1').css('display','block');
        $('.nav-btn').click(function(){
            var quizid = $(this).val();
            var dataaction = $(this).attr('data-action');
            var divid = '#qus-'+quizid;
            var newdivid = '';
            var newquizid = 0;
            if (dataaction == 'prev') {
                if (quizid > 1) {
                    newquizid = parseInt(quizid)-1;
                }else{
                    newquizid = 1;
                }
            }
            else if (dataaction == 'next') {
                if (quizid < 11) {
                    newquizid = parseInt(quizid)+1;
                }else{
                    newquizid = 11;
                }
            }
            newdivid = '#qus-'+newquizid;
            // alert(newdivid);
            $(divid).css('display','none');
            $(newdivid).css('display','block');
            // alert(quizid);
            // alert(dataaction);

        });
        $('.options').click(function(){
            var optionval = $(this).val();
            var quizid = $(this).attr('data-quiz');
            // alert(optionval);
            // alert(quizid);
            var request = $.ajax({
              url: "submit.php",
              method: "POST",
              data: { qid : quizid, ansid : optionval },
            });
             
            request.done(function(e) {
              console.log(JSON.stringify(e));
            });
             
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
        });
    </script>

</body>
</html>
