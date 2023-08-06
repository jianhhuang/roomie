<?php
session_start();
?>
<?php
require "config.php";
?>
<?php
$getMesg = $_POST['text'];
$check_data = $conn->query("SELECT response FROM chatbot WHERE queries LIKE '%$getMesg%'");

// if user query matched to database query we'll show the reply otherwise it go to else statement
if ($check_data->rowCount() > 0) {
    //fetching a response from the database according to the user query
    $fetch_data = $check_data->fetch(PDO::FETCH_ASSOC);

    //storing replay to a varible which we'll send to ajax
    $replay = $fetch_data['response'];
    echo $replay;
} else {
    echo "Sorry can't be able to understand you!";
}

?>