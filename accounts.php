<?php
    include 'connect.php'; 
	session_start();

	if (!isset($_SESSION['Username'])) {
		
        ?>
            <script type="text/javascript">
                alert("Oops! Sorry you are logged out!");
                location.replace("index.php");
            </script>
        <?php

		exit();
	}
    
    // type verification
    $typequery = "SELECT * FROM `users` WHERE Type='Client'"; 
    $typeresult = mysqli_query($con, $typequery);

    // fetching accounts
    $query = "SELECT * FROM `accounts` ORDER BY ID DESC"; 
    $result = mysqli_query($con, $query);
    
?>
<!-- ------------------------ -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>DBS-Accounts</title>
	<!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- local files -->
	<link rel="stylesheet" href="accstyle.css">
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
	<h1 class="Pgtitle">Account Details</h1>
    <!-- content -->
    <div class="accounts">
        <table class="table table-striped table-bordered shadow-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Sr No.</th>
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
                    if ($typeresult) {
                        $no = 1;
                        while($row = mysqli_fetch_array($result))
                        {  
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Account']; ?></td>
                                    <td><?php echo $row['Balance']; ?></td>
                                    <td><?php echo $row['Withdraw']; ?></td>
                                    <td><?php echo $row['Deposit']; ?></td>
                                    <td><?php echo $row['Date']; ?></td>
                                </tr>
                            <?php 
                            $no++;
                        }
                    }
                ?>
            </tbody>
        </table>
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
    </script>
    <!-- ---------------------------- -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>