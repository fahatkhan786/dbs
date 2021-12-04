<?php

$server="localhost";
$user="root";
$password="";
$db="bank";

$con = mysqli_connect($server, $user, $password, $db);

if(!$con){
    ?>
    	<script type="text/javascript">
    		alert("Connection Failed");
    	</script>
    <?php
  }

?>