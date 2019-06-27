<?php

$Y = date("Y");
$j = date("j");//วัน
$n = date("n");//เดือน
$Y = date("Y");//ปี

$Y = $Y+543;
$j = $j+1;//วัน


$date = date("$j/$n/$Y") ;



if(isset($_POST)){

$newsid = $_POST['owner_id'];
$newsow = $_POST['owner_name'];
$newsname = $_POST['pub_name'];
$newsdetail = $_POST['project_name'];
$newspic = $_POST['reward_title_thai'];



$sql = "INSERT INTO owner(owner_id,owner_name) VALUES
('".$newsid."'.',".$newsow."')";
$query_sql = mysqli_query($conn,$sql);

    //$sql4 = "INSERT INTO project_has_owner(owner_owner_id,project_project_id) VALUES
//('".$newsid."'.',".$newsdetail."')";

    $sql2 = "INSERT INTO publishcation(pub_name) VALUES
('".$newsname."')";
    $query_sql2 = mysqli_query($conn,$sql2);
    $sql3 = "INSERT INTO Project(project_name) VALUES
('".$newsdetail."')";
    $query_sql3 = mysqli_query($conn,$sql3);

    $sql4 = "INSERT INTO reward(reward_title_thai) VALUES
('".$newspic."')";

    $query_sql4 = mysqli_query($conn,$sql4);


header("location: index.php");
}

?>