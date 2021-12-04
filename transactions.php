<?php
	session_start();
    include 'connect.php';
    
    $uname = $_SESSION["Username"];

	if (!isset($_SESSION['Username'])) {
		
	?>
        <script type="text/javascript">
            alert("Oops! Sorry you are logged out!");
            location.replace("index.php");
        </script>
    <?php
		exit();
	}
    
    // <!-- ----------------------------- -->
    // <!-- Amount Deposited -->

        $bal = 0.00;
        $deposit = 0.00;
        $withdraw = 0.00;
    
        // <!-- Amount Deposited -->
        if(isset($_POST['depobtn'])) {
            $deposit = mysqli_real_escape_string($con, $_POST['amount']);
        
            // balance verification
            $uname = $_SESSION['Username'];
            $balquery = "SELECT * FROM accounts WHERE Name='$uname' and ID=(SELECT max(ID) FROM accounts);"; 
            $result = mysqli_query($con, $balquery);
        
            if ($result) {
                $row = mysqli_fetch_array($result);

                $email = $row['Email'];
                $accno = $row['Account'];
                $balance = $row['Balance'];
                $bal = $balance + $deposit;

                $insert = "INSERT INTO `accounts`(`Name`, `Email`, `Account`, `Balance`, `Deposit`) VALUES ('$uname','$email','$accno','$bal','$deposit')";
                $iq = mysqli_query($con, $insert);
                if($iq){
                    ?>
                        <script type="text/javascript">
                            alert("Amount Deposited!");
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script type="text/javascript">
                            alert("Please try again! Transfer Failed");
                        </script>
                    <?php
                }
            }
        }
    
        // <!-- Amount Withdrew -->
        if(isset($_POST['vdrawbtn'])) {
            $withdraw = mysqli_real_escape_string($con, $_POST['amount']);
        
            // balance verification
            $uname = $_SESSION['Username'];
            $balquery = "SELECT * FROM accounts WHERE Name='$uname' and ID=(SELECT max(ID) FROM accounts);"; 
            $result = mysqli_query($con, $balquery);
        
            if ($result) {
                $row = mysqli_fetch_array($result);

                $email = $row['Email'];
                $accno = $row['Account'];
                $balance = $row['Balance'];

                // check if withdrawal amount is less than balance
                if ($withdraw<=$balance) {

                    $bal = $balance - $withdraw;
    
                    $insert = "INSERT INTO `accounts`(`Name`, `Email`, `Account`, `Balance`, `Withdraw`) VALUES ('$uname','$email','$accno','$bal','$withdraw')";
                    $iq = mysqli_query($con, $insert);
                    if($iq){
                        ?>
                            <script type="text/javascript">
                                alert("Amount Withdrawn!");
                            </script>
                        <?php
                        // -------------------------
                        $balance == $bal;
                    }
                    else{
                        ?>
                            <script type="text/javascript">
                                alert("Please try again! Transfer Failed");
                            </script>
                        <?php
                    }
                }
                else{
                    ?>
                        <script type="text/javascript">
                            alert("Insufficient Balance");
                        </script>
                    <?php
                }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>DBS-Transactions</title>
	<!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- local files -->
	<link rel="stylesheet" href="transstyle.css">
</head>
<body>
    <!-- logout btn -->
    <div class="logout-btn">
        <button type="button" class="btn userbtn disabled shadow-sm">
            <i class="far fa-user"></i>
            <b><?php echo $_SESSION['Username']; ?></b>
        </button>
        <button type="button" class="btn btn-warning shadow-sm" onclick="myFunction()">
            <a class="logoff" href="logout.php">Logout</a>
            <i class="fas fa-sign-out-alt ml-1"></i>
        </button>
    </div>
    <!-- title -->
	<h1 class="Pgtitle">Transaction Page</h1>
    <!-- content -->
    <div class="transactions">
        <table class="table table-striped table-bordered shadow-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Account Number</th>
                <th scope="col">Balance</th>
                <th scope="col">Withdrawal</th>
                <th scope="col">Deposit</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    // name verification
                    $namequery = "SELECT * FROM users WHERE Type='Client' and Name='$uname'";
                    $nresult = mysqli_query($con, $namequery);

                    if (!$nresult) {
                        echo "User is not a client.";
                    }

                    // fetching accounts
                    $query = "SELECT * FROM `accounts` WHERE Name='$uname'"; 
                    $result = mysqli_query($con, $query);

                    if ($nresult) {
                        while($row = mysqli_fetch_array($result))
                        {  
                            ?>
                                <tr>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Account']; ?></td>
                                    <td><?php echo $row['Balance']; ?></td>
                                    <td><?php echo $row['Withdraw']; ?></td>
                                    <td><?php echo $row['Deposit']; ?></td>
                                    <td><?php echo $row['Date']; ?></td>
                                </tr>
                            <?php 
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- ------------- -->
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-success btn-lg" title="Add Fund" data-toggle="modal" data-target="#DepoModal">
            Deposit
        </button>
        <!-- Depo-Modal -->
        <div class="modal fade" id="DepoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cash Deposit</h5>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span><i class="fas fa-times"></i></span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <span class="text-danger">(*) Mandatory field</span>
                        <form class="form-container" method="POST" action="#">
                            <input name="amount" id="amount" class="amount" type="number" pattern="/^[0-9]/gi" ondrop="return false;" onpaste="return false;" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" onkeypress="removeSigns();" placeholder="Please Enter Amount" required="" />
                            <br />
                            <div>
                                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Cancel</button>
                                <input name="depobtn" type="submit" class="btn btn-success" value="Proceed" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- =============================== -->
        <button type="button" class="btn btn-danger btn-lg" title="Remove Fund" data-toggle="modal" data-target="#WidModal">Withdraw</button>
        <!-- Withdraw-Modal -->
        <div class="modal fade" id="WidModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cash Withdrawal</h5>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span><i class="fas fa-times"></i></span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <span class="text-danger">(*) Mandatory field</span>
                        <form class="form-container" method="POST" action="#">
                            <input name="amount" id="amount2" class="amount" type="number" pattern="/^[0-9]/gi" ondrop="return false;" onpaste="return false;" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" onkeypress="removeSigns();" placeholder="Please Enter Amount" required="" />
                            <br />
                            <div>
                                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Cancel</button>
                                <input name="vdrawbtn" type="submit" class="btn btn-success" value="Proceed" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------- -->
    <hr />
	<footer>
		All Rights Reserved. Copyright &copy; 2020
	</footer>
    <!-- ---------------------------- -->
    <script type="text/javascript">
        function myFunction(){
            alert("Hey <?php echo $_SESSION['Username']; ?>, Thank you for visiting!");
            location.replace("index.php");
        }
        function removeSigns() {
            var dep = document.getElementById('amount');
            dep.value = parseInt(dep.value.toString().replace('+', '').replace('-', ''));

            var wid = document.getElementById('amount2');
            wid.value = parseInt(wid.value.toString().replace('+', '').replace('-', ''));
        }
    </script>
    <!-- ---------------------------- -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>