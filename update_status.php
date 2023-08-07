<?php 

include './components/config.php';
include './components/functions.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
  header('Location: ./staff_login.php');
}

$status = "";
$date = "";
$desc = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(!isset($_GET['client_id'])){
      $prompt[] = 'user id is empty!';prompt($prompt);
    }

    $client_id = $_GET['client_id'];


    if(isset($_POST['update'])){

        echo 'ready to update!';

        $select_data = $conn->prepare("SELECT * FROM `history` where client_id = ?");
        $select_data->execute([$client_id]);
        $data_row = $select_data->fetch(PDO::FETCH_ASSOC);
        $check_r_count = $select_data->fetchColumn();

        $status_id = $_POST['status_id'];
        $date = $_POST['date'];
        $next_date = $_POST['next_date'];
        $description = $_POST['desc'];
        // if($check_r_count > 0){
            $update_history = $conn->prepare("UPDATE `history` SET date = ? ,status_id = ?, description = ? , next_contactable = ? WHERE client_id = ? AND staff_id = ?");
            $update_history->execute([$date, $status_id, $description, $next_date, $client_id, $user_id]);

            $update_mappings = $conn->prepare("UPDATE `data_maps` SET date_of_progress = ?,status_id = ? WHERE client_id = ? AND staff_id = ?");
            $update_mappings->execute([$date, $status_id, $client_id, $user_id]);
        // }
        // else{
            // echo 'there is no existing data! '.$conn->errorCode();
        // }

          $prompt[] = 'Succesfully Updated';

    }while(false);
    
    header('Location: ./index.php');
    exit;
}

?>

<!DOCTYPE html>
<title>Update status</title>
<link rel="stylesheet" href="./style/style.css">
<style>
* {
    box-sizing: border-box;
  }
  
  input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }
  
  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
  }
  
  input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }
  
  input[type=submit]:hover {
    background-color: #45a049;
  }
  
  .up-container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }
  
  .col-small {
    float: left;
    width: 25%;
    margin-top: 6px;
  }
  
  .col-large {
    float: left;
    width: 75%;
    margin-top: 6px;
  }
  
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  
  @media screen and (max-width: 600px) {
    .col-small, .col-large, input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }


</style>
<body>
<div class="up-container">

<?php echo prompt($prompt);?>
  <form action="" method = post>
    <div class="row">
      <div class="col-small">
        <label for="fname">Date :</label>
      </div>
      <div class="col-large">
      <input type="hidden" value="<?php echo $date ?>">
        <input type="date" name="date"  class="-button green">
      </div>
    </div>

    <div class="row">
      <div class="col-small">
        <label for="fname">Next Contact :</label>
      </div>
      <div class="col-large">
      <input type="hidden" value="<?php echo $next_date ?>">
        <input type="date" name="next_date" class="-button green">
      </div>
    </div>


    <div class="row">
      <div class="col-small">
        <label for="country">Status</label>
      </div>
      <div class="col-large">
      <input type="hidden" value="<?php echo $status_id ?>">
      <select class="-button green" name="status_id">
        <option name="status_id" value="0">In progress</option>
        <option name="status_id" value="1">Yet to reach</option>
        <option name="status_id" value="-1">Closed with Negative Command</option>
        <option name="status_id" value="2">Closed with positive Command</option>
    </select>
      </div>
    </div>

    <div class="row">
      <div class="col-small">
        <label for="subject">Description</label>
      </div>
      <div class="col-large">
         <input type="hidden" value="<?php echo $desc ?>">
        <textarea name="desc" placeholder="Write remarks.." style="height:400px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" name="update" value="Submit">
    </div>
  </form>
</div>


<br><br><br>
<?php include './components/staff_footer.php';?>



<!-- 


<body class="center green-border">
<form class="center green-border" method="post" style="margin-top:200px">
    <h3>Date :</h3>
    <input type="hidden" value="<?php echo $date ?>">
    <input class="-button green"  type="date" name="date">
    <h3>Status:</h3>
    <input type="hidden" value="<?php echo $status_id ?>">
    <select class="-button green" name="status_id">
        <option name="status_id" value="0">In progress</option>
        <option name="status_id" value="1">Yet to reach</option>
        <option name="status_id" value="-1">Closed with Negative Command</option>
        <option name="status_id" value="2">Closed with positive Command</option>
    </select>
    <h3>Description :</h3>
    <input type="hidden" value="<?php echo $desc ?>">
    <input  class="-button green  " type="text" name="desc" placeholder="Write the description...">
    <input class="-button orange" type="submit" name="update">
</form>

</body>
</html> -->