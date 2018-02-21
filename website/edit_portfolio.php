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
    include_once('includes/functions.php');

    if (!isset($_SESSION['logged_user'])) {
      echo("<h1>Sorry, this page is only available for admins</h1>");
    }
    else{
      echo("<h1 class='page-title'>Edit Your Portfolios</h1><div class='container'>");
      //selects all albums
      $sql = 'SELECT * FROM Portfolios ;';

      $result = execute_sql_query($sql);

      //prints table that allows the user to pick which album to go to with its information
      print ("<table class='portfolios_table'>");

      print ("
        <tr class='portfolios_table'>
        <td class='portfolios_table'>Title</td>
        <td class='portfolios_table'>Description</td>
        <td class='portfolios_table'>Remove Portfolio</td>
        </tr >");

        //Loop through the $result rows fetching each one as an associative array
        while ($row = $result->fetch_assoc()) {
          //gets album id and hyperlink
          $port_id = $row['portfolioID'];
          $href = "edit_port.php?portfolioID=$port_id";

          //gets appropriate image caption
          if(strlen($row['description'])==0)
            $descript =  "<td class='portfolios_table'><span class=none> None to show</span></td>";
          else
            $descript = "<td class='portfolios_table'>{$row['description']}</td>"; 

          //start the HTML table row and print out each album with its description
          print("<tr>");
            print( "<td class='portfolios_table'><a href='$href'>{$row[ 'portfolio_title' ]}</a></td>" );
            print( $descript);
            echo("<td class='portfolios_table'><form method='post'>
            <button type='submit'  name='delete' value='$port_id'>Delete Album</button>
            </form></td> ");
          print("</tr>");
        }

        print ("</table>");

        //if the delete button is clicked
        if (isset($_POST["delete"])){

          //get the album to delete
          $portfolio = $_POST['delete'];

          //sql to delete the album
          $sql2 = "DELETE FROM Portfolios WHERE portfolioID = $portfolio;";

          $result2 = execute_sql_query($sql2);

          //If no result, print the error
          if (!$result2) {
            print($mysqli->error);
            exit();
          }

          else{
            print ("<p>Album successfully deleted!</p>");
            //refreshes the page to reflect the change
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }


        echo "
        <h3>Add a new portfolio </h3>
          <form class='edit_form' method='post'>
           <label>Portfolio Name: </label>
           <input type='text' name='new_port_name' required />
           <label class='padded_label'>Portfolio Description: </label>
           <textarea rows='5' name='new_port_descript' placeholder='Optional'></textarea>
           <input type='submit' name='add_port' value='Add Portfolio'>
          </form>";

        //when the user desires to add an album
        if(isset($_POST["add_port"])){

          //gets data and cleans it up
          $port_title = filter_input(INPUT_POST, 'new_port_name', FILTER_SANITIZE_STRING);
          $port_descript = filter_input(INPUT_POST, 'new_port_descript', FILTER_SANITIZE_STRING);

          //if the albums are valid
          if (validPortInfo($port_title, $port_descript)){

            //inserts new album with fields
            $sql3 = "INSERT INTO Portfolios (portfolio_title, description)
            VALUES('$port_title', '$port_descript');";

            //Get the data
            $result3 = execute_sql_query($sql3);
                  
            //If no result, print the error
            if (!$result) {
              print($mysqli->error);
              exit();
            }
            else
              echo "<p>Album successfully added!</p>";
              //refreshes the page to reflect the change
              echo "<meta http-equiv='refresh' content='0'>";
              
          }
        }


        echo"</div>";

    }

    //validates album info based on title and description
    function validPortInfo($album_title, $album_descript){
      //title field has to be filled and less than 50 characters
      if(strlen($album_title)>50 || strlen($album_title)==0){
          echo "<p class='warning'>Please submit an album title with less than 50 characters</p>";
          return false;
        }

      //description field has to be less than 300 characters
        if(strlen($album_descript)>300){
          echo "<p class='warning'>Please submit an album description with less than 300 characters</p>";
            return false;
        }
          return true;
    }
  ?>

  


    <? include_once('./includes/footer.php'); ?>
    
  </body>
</html>
