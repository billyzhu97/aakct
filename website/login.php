<?php session_start(); ?>
<?php
	$page_title = 'Maddie Freeman Photography';
    include_once('./includes/header.php');
?>

<body>
    <?php
        include_once('./includes/banner.php');
        include_once('./includes/navbar.php');
        include_once('./includes/functions.php');
    ?>
    <div id="login-content" class="center">
	<?php
        //sanitizes inputs for username and password
        $post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
        $post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );

        function logout(){
            print("<p>You are currently logged in!<p>");
            print("<p>You can now add and edit your photos and albums!</p>");
            echo "
            <form class='logout_prompt' action='login.php' method='post'>
                <p> Click the button below to log out!</p>
                <input type='submit' name='logout' value='Logout'>
          </form>";

          if(isset($_POST['logout'])){
            unset($_SESSION['logged_user']);
            print("<p>Thanks for using the website!</p>");
            echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        //if the user is already logged in, tell them there's not need to log in
        if (isset($_SESSION['logged_user'] )){
            logout();
        }
		else{
        //if fields are empty, prompt the user to fill in the log in info
        if ( empty( $post_username ) || empty( $post_password )) {

          ?>

          <h1> This login page is only for admins!</h1>
          <form action="login.php" method="post">
            Username: <input type="text" name="username"> <br>
            Password: <input type="password" name="password"> <br>
            <input type="submit" value="Submit">
          </form>
          <?php
        } else {

          //Get the connection info for the DB. 
          require_once 'includes/config.php';

          //Establish a database connection
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

           //Was there an error connecting to the database?
          if ($mysqli->errno) {
            
            //The page isn't worth much without a db connection so display the error and quit
            print($mysqli->error);
            exit();
          }



          //gets the username and password for prepared statement checks
          $username = $post_username;
          $password = hash( "sha256", $post_password);
          $query = "SELECT * FROM Users
          WHERE username = ? AND hashpassword = ?";

          //prepared statment checks
          $stmt = $mysqli->stmt_init();

          if ($stmt->prepare($query)) { 
            $stmt->bind_param('ss', $username, $password ); 
            $stmt->execute();
            $result = $stmt->get_result();
          }

          //Make sure there is exactly one user with this username
          if ( $result && $result->num_rows == 1) {
             $row = $result->fetch_assoc();

            $db_hash_password = $row['hashpassword'];

            //if the password matches, start the session
            if( $password === $db_hash_password) {
              $db_username = $row['username'];
              $_SESSION['logged_user'] = $db_username;
            }

            
          } 

          $mysqli->close();

          //if the session is started, welcome the user
          if ( isset($_SESSION['logged_user'] ) ) {
            echo "<meta http-equiv='refresh' content='0'>";
            logout();

          } 
          //if the session did not start, tell them to try again
          else {
            echo '<p>You did not login successfully.</p>';
            echo '<p>Please <a href="login.php">try</a> again.</p>';
          }

        }
      }
	?>
    </div>

    <?php
        include_once('./includes/footer.php');
    ?>
</body>