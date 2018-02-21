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

      
      //gets the album id from the url
      $portfolio_id = filter_input( INPUT_GET, 'portfolioID', FILTER_SANITIZE_NUMBER_INT );

      //load all the photos onto the main page
       $sql = "SELECT * FROM Portfolios WHERE portfolioID = '$portfolio_id';";

      //Get the data
      $result = execute_sql_query($sql);
              
      //If no result, print the error
      if (!$result) {
        print($mysqli->error);
        exit();
      }

      //if there are no results, tell the user the album has been deleted or doesn't exist
      $num_rows = mysqli_num_rows($result);
      if($num_rows==0){
        echo"<p>This portfolio has been deleted or it does not currently exist</p>";
      }


      //Loop through the $result rows fetching each one as an associative array
      while ($row = $result->fetch_assoc()) {
        $old_title = $row['portfolio_title'];
        $old_descript = $row['description'];

        echo("<h1 class=page-title>Edit $old_title</h1>");

        echo("<div class='container'>");
        //form to edit
        echo 
          ("<div class='edit_port'><form  method='post'>
              <label class='padded_label'>Portfolio Title:</label>
              <textarea class='search_area' rows='1' name = 'new_port_title'>$old_title</textarea>
              <label class='padded_label'>Description: </label>
              <textarea class='search_area'  rows='5' name='new_descript'>$old_descript</textarea>
              <input type='submit' name='update' value='Update'>
            </form></div>");
        }

        //when the upate button is clicked
        if(isset($_POST['update'])){
          //filter the inputs
          $new_title = filter_input(INPUT_POST, 'new_port_title', FILTER_SANITIZE_STRING);
          $new_descript = filter_input(INPUT_POST, 'new_descript', FILTER_SANITIZE_STRING);

          //if the inputs are valid
          if(validAlbumInfo($new_title, $new_descript)){

          //inserts the updates into the database
          $sql2 = "UPDATE Portfolios SET portfolio_title = '$new_title', description = '$new_descript'
          WHERE portfolioID = $portfolio_id;";

          //Get the data
          $result2 = execute_sql_query($sql2);

          //If no result, print the error
          if (!$result) {
            print($mysqli->error);
            exit();
          }
          else{
            echo "<p>Changes saved!</p>";

            //Brings the user back to the albums page
            echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.'edit_portfolio.php'.'">';  
            }
          }

        }

        // Find paintings from album
        $picture_query = "
            SELECT * 
            FROM Photos 
            INNER JOIN Portfolio_photos ON Photos.photoId = Portfolio_photos.photoId 
            INNER JOIN Portfolios ON Portfolio_photos.portfolioId = Portfolios.portfolioId
            WHERE Portfolios.portfolioId = $portfolio_id;";
        $photos = execute_sql_query($picture_query);

        echo("<h1>Manage your content</h1>");

        echo("<table class='port_table' id='padded_table'>
            <tr class='port_table'>
              <td class='port_table'>Thumbnail</td>
              <td class='port_table'>Info</td>
            </tr>");

            //Loop through the $result rows fetching each one as an associative array
            while ($row = $photos->fetch_assoc()) {

              //gets the href for the image if clicked
              $image_id = $row['photoID'];


              //start the HTML table row, prints out the corresponding image and its info
              print("<tr class='port_table'>");
                print( "<td class='file_path'><div><img class='edit_img' src= 'images/{$row[ 'file_path' ]}' alt='picture in the $portfolio_title portfolio'/></div></td>" );
                print( "<td class='port_table'><p class='title'>Photo Title: {$row[ 'photo_name' ]}</p>" );

                print( "<p class='date_created'>Date created: {$row[ 'date_created' ]}</p>" );
                echo("<form method='post'>
                <button name='delete' value='$image_id' type='submit'>Remove from Album</button>
                </form>");
                
                print("</td></tr>");
              }
              
          print("</table>");

          //if the delete button is pressed,
          if (isset($_POST['delete'])){
            //get which image to delete
            $d_img_id = $_POST['delete'];

            //sql to delete the appropriate picture
            $sql5 = "DELETE FROM Portfolio_photos WHERE
            photoID = $d_img_id AND portfolioID = $portfolio_id;";

            $result5 = execute_sql_query($sql5);

            //If no result, print the error
            if (!$result5) {
              print($mysqli->error);
              exit();
            }
             else{
              //refreshes page to reflect change
              echo "<meta http-equiv='refresh' content='0'>";
            }
          }

          echo"<h4>To add an image to this portfolio, go to the add page <a href='add.php'>here</a></h4>";

          echo"<h4>Add an image to this portfolio from the database</h4>";

           //sql query to get the information for photos
              $sql6 = "SELECT photo_name, photoID
              FROM Photos;";

              //Get the data
              $result6 = execute_sql_query($sql6);
                
              //If no result, print the error
              if (!$result6) {
                print($mysqli->error);
                exit();
              }

              //Creates an option dropdown so that the user can add one photo, (from all the pictures) into
              //the album
              echo ("
              <form method = 'post'>
                <select name='add_photo'>");

            while ($row3 = $result6->fetch_assoc()) {

              echo("<option value={$row3['photoID']}>{$row3['photo_name']}</option>");

            }

            echo("
              </select>
            <input type='submit' value='Add to Portfolio'>
            </form>");
          

    }

    //if the add photo button is clicked
    if (isset($_POST['add_photo'])){
      //get the image id and use sql to insert the data into the database
      $img_id = $_POST['add_photo'];

      $sql7 = "INSERT INTO Portfolio_photos (portfolioID, photoID)
              VALUES ('$portfolio_id', '$img_id');"; 

      $result7 = execute_sql_query($sql7);

      //If no result, print the error
      if (!$result7) {
          print($mysqli->error);
          exit();
        }
        else
          //refreshes page to reflect change
          echo "<meta http-equiv='refresh' content='0'>";
    echo"</div>";
        
    }

    //validates album info based on title and description
    function validAlbumInfo($album_title, $album_descript){

      //title field has to be filled and less than 50 characters
      if(strlen($album_title)>50 || strlen($album_title)==0){
        echo "<p class='warning'>Please submit a portfolio title with less than 50 characters</p>";
        return false;
      }

      //description field has to be less than 300 characters
      if(strlen($album_descript)>300){
        echo "<p class='warning'>Please submit a description with less than 300 characters</p>";
        return false;
      }
        return true;
    }
  ?>

  


    <? include_once('./includes/footer.php'); ?>
    
  </body>
</html>
