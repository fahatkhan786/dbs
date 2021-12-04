<?php

    // establish connection
    include 'connect.php';

    if(isset($_POST['reg'])) {
      $utype = mysqli_real_escape_string($con, $_POST['usertype']);
      $uname = ucwords(mysqli_real_escape_string($con, $_POST['name']));
      $umail = mysqli_real_escape_string($con, $_POST['mail']);
      $upass = mysqli_real_escape_string($con, $_POST['pass']);
      // ============================================================== 
      // hashing technique (bloofish algorithm)
      $pass = password_hash($upass, PASSWORD_BCRYPT);
      //   $cpass = password_hash($ucp, PASSWORD_BCRYPT);
      $token = md5(time().mt_rand(0 ,1000000000000000000));
      //   --------------------------
      $_SESSION["Username"] = $uname;
      // ============================================================== 
      // VALIDATIONS

      // type verification
      $typequery = "SELECT * FROM users WHERE Type='$utype' and Name='$uname' and Email='$umail' and Password='$pass'"; // and cpassword='$cpass' 
      $result = mysqli_query($con, $typequery);
      if($result)
      {
        if($utype == "Employee"){
            // name verification
            $namequery = "SELECT * FROM users WHERE Name='$uname'";
            $nquery = mysqli_query($con, $namequery);
            $namecount = mysqli_num_rows($nquery);
            if($namecount > 0) {
                ?>
                    <script type="text/javascript">
                        alert("Username already exists");
                        location.replace("index.php");
                    </script>
                <?php
            }
            else{
                // email verification
                $emailquery = "SELECT * FROM users WHERE Email='$umail'";
                $equery = mysqli_query($con, $emailquery);
                $emailcount = mysqli_num_rows($equery);

                if($emailcount > 0) {
                    ?>
                        <script type="text/javascript">
                            alert("Email already exists");
                            location.replace("index.php");
                        </script>
                    <?php
                }
                else {
                    $insertquery = "INSERT INTO `users`(`Type`, `Name`, `Email`, `Password`, `Token`) VALUES ('$utype', '$uname','$umail', '$pass', '$token')";
                    $iquery = mysqli_query($con, $insertquery);
                    if($iquery){
                        // SUCCESS 
                        ?>
                            <script type="text/javascript">
                                alert("Congratulations! Your account has been created! Please login to continue.");
                                location.replace("index.php");
                            </script>
                        <?php
                    }
                    else{
                        echo "Insert failed!! Please try again after some time.";
                    }
                }
            }
        }
        // ===============================================================================
        elseif($utype == "Client") {
            // name verification
            $namequery = "SELECT * FROM users WHERE Name='$uname'";
            $nquery = mysqli_query($con, $namequery);
            $namecount = mysqli_num_rows($nquery);
            if($namecount > 0) {
                ?>
                    <script type="text/javascript">
                        alert("Username already exists");
                        location.replace("index.php");
                    </script>
                <?php
            }
            else{
                // email verification
                $emailquery = "SELECT * FROM users WHERE email='$umail'";
                $equery = mysqli_query($con, $emailquery);
                $emailcount = mysqli_num_rows($equery);

                if($emailcount > 0) {
                    ?>
                        <script type="text/javascript">
                            alert("Email already exists");
                            location.replace("index.php");
                        </script>
                    <?php
                }
                else {
                    $insertquery = "INSERT INTO `users`(`Type`, `Name`, `Email`, `Password`, `Token`) VALUES ('$utype', '$uname','$umail', '$pass', '$token')";
                    $iquery = mysqli_query($con, $insertquery);

                    if($iquery){
                        // SUCCESS 
                        ?>
                            <script type="text/javascript">
                                alert("Congratulations! Your account has been created!");
                                location.replace("index.php");
                            </script>
                        <?php
                        // --------------------------------
                        // inserting data in accounts
                        $bal = 0.00;
                        $wid = 0.00;
                        $dep = 0.00;         
                        $acc = mt_rand(0 ,1000000000);
                        
                        //accounts table
                        $accquery = "SELECT * FROM accounts WHERE Account='$acc'";
                        $aquery = mysqli_query($con, $accquery);
                        $acount = mysqli_num_rows($aquery);

                        if ($acount > 0) {
                            ?>
                                <script type="text/javascript">
                                    alert("Account Number Repeated");
                                    location.replace("index.php");
                                </script>
                            <?php
                        }
                        else{
                            $insert = "INSERT INTO `accounts`(`Name`, `Email`, `Account`, `Balance`, `Withdraw`, `Deposit`) VALUES ('$uname','$umail','$acc','$bal','$wid','$dep')";
                            $iq = mysqli_query($con, $insert);
                            if($iq){
                                // SUCCESS
                                ?>
                                    <script type="text/javascript">
                                        alert("Please login to continue.!");
                                        location.replace("index.php");
                                    </script>
                                <?php
                            }
                            else{
                                ?>
                                    <script type="text/javascript">
                                        alert("Accounts failed!");
                                        location.replace("index.php");
                                    </script>
                                <?php
                            }
                        }
                    }
                    else{
                        echo "Insert failed!! Please try again after some time.";
                    }
                }
            }
        }
        // ==================================================================================
        else{
            ?>
                <script type="text/javascript">
                    alert("Please select a usertype");
                    location.replace("index.php");
                </script>
            <?php
        }
      }
    }

?>

