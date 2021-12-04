<?php
    // establish connection
    include 'connect.php';
    session_start();

    // checks for var (if exists returns true)
    if(isset($_POST['login'])) {
        // $utype = $_POST['utype'];
        $email = $_POST['umail'];
        $pass = $_POST['upass'];

        $email_search = "SELECT * FROM `users` WHERE Email='$email'";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
        	// email exists check for password

        	// fetch password from email's row         
        	$email_pass = mysqli_fetch_assoc($query);
        	$db_pass = $email_pass['Password'];

            // fetch username
            $_SESSION['Username'] = $email_pass['Name'];

            // fetch type
            $_SESSION['Type'] = $email_pass['Type'];

        	//since the password is hashed we need to decode it
        	$pass_decode = password_verify($pass, $db_pass); 	
            //check if both are same

        	if ($pass_decode) {
                // select type 
                if($_SESSION['Type'] == "Employee") {
                    ?>
                        <script type="text/javascript">
                            alert("Login Successful!");
                            location.replace("accounts.php");
                        </script>
                    <?php
                } 
                // Client
                else {
                    ?>
                        <script type="text/javascript">
                            alert("Login Successful!");
                            location.replace("transactions.php");
                        </script>
                    <?php
                }        	
            }
        	else {
        		?>
                    <script type="text/javascript">
                        alert("Incorrect Password! Please Try Again.");
                        location.replace("index.php");
                    </script>
                <?php
        	}
        }
        else {
        	// email does not exist
            ?>
                <script type="text/javascript">
                    alert("Invalid Email! Please Try Again.");
                    location.replace("index.php");
                </script>
            <?php
        }
    }

?>