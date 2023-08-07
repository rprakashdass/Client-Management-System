<?php 
      $select_profile = $conn->prepare("SELECT * FROM `staff_info` WHERE staff_id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<header class="green" style=" height: 200px;">
<div style="padding: 50px;">
      <span style="font-size:xxx-large;padding:0"  class="left-align text-yellow"><b>SRI SHAKTHI</b></span><br>
      <span style="font-size:x-large;"  class="left-align text-yellow">INSTITUTE OF ENGINEERING AND TECHNOLOGY</span><br>
</div>

</header>