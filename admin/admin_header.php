<?php
$select_profile = $conn->prepare("SELECT * FROM `admin_info` WHERE admin_id = ?");
$select_profile->execute([$user_id]);
do{
   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}while(false);

?>
<header class="green" style=" height: 200px;">
<div style="padding: 50px;">
      <span style="font-size:xxx-large;padding:0"  class="left-align text-yellow"><b>SRI SHAKTHI</b></span><br>
      <span style="font-size:x-large;"  class="left-align text-yellow">INSTITUTE OF ENGINEERING AND TECHNOLOGY</span><br>
</div>

<h1 class="right-assign pointer text-yellow" style="margin-top:120px;" >Welcome Mr.<?= $fetch_profile["name"]; ?></span></h1><br>

</header>