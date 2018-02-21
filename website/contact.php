<?php
  session_start();
?>

<?php
	$page_title = 'Maddie Freeman Photography';
	include_once('./includes/header.php');	
?>

<body>
	<?php
		include_once('./includes/banner.php');
		include_once('./includes/navbar.php');
		
	?>

	<div class='content center'>

    <h1>Contact Me!</h1>
    <p>Fill out the form below to send me a quick email! </p>
    <p>I'll be sure to get back to you as soon as possible! </p>
		<!-- Gives user the option to input a comment thru an email-->
        <form method="post" class="email_form">
          Name <label class='rq'>(required)</label> <input type="text" name="name" required><br><br>
          Email <label class='rq'>(required)</label> <input type="text" name="email" required><br><br>
          Phone Number <label class='rq'>(required)</label> <input type="text" name="number" placeholder="123-456-7890" required><br><br>
          Message:<br>
          <textarea class="email_msg"rows="5" name="message" ></textarea>
          <input type="submit" name="submit" value="Submit">
        </form>

        <?php 
        
          /* If the comment field has not been filled out, prompt user */
          if(isset($_POST['submit']) && strlen($_POST['message'])==0){
            echo "<p>Please input a comment</p>";
          }

          /* Sends an email after it validates name and validates email */
          elseif(isset($_POST['submit'])&&validName($_POST['name'])&&validEmail($_POST['email'])&&validNumber($_POST['number'])){
            $to = "madelinefreeman6@gmail.com"; 
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $from = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
            $subject = "Email from " . $name . " on Maddie Freeman Photography Website";
            $message = $name . " commented on your page:" . "\n" . "\n" . "His/her email is: ". $from . "\n" . "His/her phone number is: ". $phone . "\n" .
            "\n" . "His/her message is: " . "\n" . $_POST['message'];

            mail($to,$subject,$message);
            echo "<p class='success'> Comment submitted. Thank you " . $name . " for your comment!</p>";
          }
          /* If the name is not valid, prompt user to put a valid name */
          elseif (isset($_POST['submit'])&&!validName($_POST['name'])) {
            echo "<p class='warning'>Please input a valid name (only letters and spaces).</p>";
          }
          /* If the email is not valid, prompt user to put a valid email */
          elseif (isset($_POST['submit'])&&!validEmail($_POST['email'])) {
            echo "<p class='warning'>Please input a valid email.</p>";
          }
    
          /* If the number is not valid, prompt user to put a valid number */
          elseif (isset($_POST['submit'])&&!validEmail($_POST['number'])) {
            echo "<p class='warning'>Please input a valid number in the form 123-456-7890.</p>";
          }
          /* User-defined function to validate name using regular expressions */
          function validName($name){
            return preg_match("/^[a-zA-Z ]+$/", $name);
          }

          /* Another user-defined function to validate emails using regular expressions */
          /* http://stackoverflow.com/questions/5855811/how-to-validate-an-email-in-php */
          function validEmail($email){
            return preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email);
          }

          //validates phone number based on a format and doesn't allow for duplicate phone numbers
          function validNumber($number){
            return preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $number);
          }

        ?>
	</div>
  <?php
  include_once('./includes/footer.php');
  ?>
</body>