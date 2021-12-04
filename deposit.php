<?php
    // establish connection
    include 'connect.php';
	session_start();

    if(isset($_POST['depobtn'])) {
      $uamount = mysqli_real_escape_string($con, $_POST['amount']);

      // balance verification
      $uname = $_SESSION['Username'];
      $balquery = "SELECT * FROM accounts WHERE Name='$uname'"; 
      $result = mysqli_query($con, $balquery);

      if ($result) {
          while($row = mysqli_fetch_array($result))
          {
                $balance = $row['Balance'];
                $deposit = $row['Deposit'];
                $withdraw = $row['Withdraw'];
                ?>
                    <script type="text/javascript">
                        alert("$balance | $deposit | $withdraw");
                    </script>
                <?php
          }
      }
    }

?>