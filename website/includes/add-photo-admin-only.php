<!--Form to add a photo-->
    <p class="page-title">Add a Photo!</p>
    <form method="post" enctype="multipart/form-data">
        <table id='photo_add_table' class="center">
            <tr>
                <td>
                    <label for="new_photo_text">Photo Name: </label>
                </td>
                <td>
                    <input type="text" id="new_photo_text" name="new_photo_title" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label id="padded_label" for="new_photo_upload">Upload photo: </label>
                </td>
                <td>
                    <input id="new_photo_upload" type="file" name="newphoto" />
                </td>
            </tr>
            <tr>
                <td>
                    <label class="padded_label">
                        Portfolios: <br> (optional):
                    </label>
                </td>
                <td>
                    <?php
                    //sql to get all the albums and titles for checkboxes
                    $portfolios_sql = 'SELECT portfolioID, portfolio_title FROM Portfolios ;';

                    //Get the data
                    $result = execute_sql_query($portfolios_sql);

                    //prints out a checkbox with all the albums listed
                    while ($row = $result->fetch_assoc()) {
                        $port_id = $row['portfolioID'];
                        $port_title = $row['portfolio_title'];

                        print
                            "<label>
                                <input type='checkbox' name='checkbox[]' value='$port_id'/>
                                $port_title
                            </label><br>";
                    }
                    ?>
</td>
</tr>
<tr>
    <td></td>
    <td>
        <input type='submit' name='add_photo' value='Add Photo'>
    </td>
</tr>
</table>
</form>

<?php

//when the user desires to add a photo
if(isset($_POST["add_photo"])&&validatePhoto()){

    //gets data and cleans it up
    $photo_title = filter_input(INPUT_POST, 'new_photo_title', FILTER_SANITIZE_STRING);

    //if inputs are valid
    if(validateTitle($photo_title)){

        //Uploads the file
        if ( isset( $_FILES['newphoto'] ) ) {
            $newPhoto = $_FILES['newphoto'];
            $originalName = $newPhoto['name'];
            if ( $newPhoto['error'] == 0 ) {
                $tempName = $newPhoto['tmp_name'];
                move_uploaded_file( $tempName, "images/$originalName");
                $_SESSION['photos'][] = $originalName;
                print("<p>The file $originalName was uploaded successfully.</p>");
            } else {
                print("<p>Error: The file $originalName was not uploaded.</p>");
            }
        }

        //gets fields for sql input
        $file_path = "$originalName";
        $date_created = date("Y-m-d");

        include_once('./includes/config.php');

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->errno) {
            print "<p>$mysqli->error</p>";
            print "</body>";
            exit();
        }

        //inserts the photo into the database
        $sql2 = "INSERT INTO Photos (photo_name, file_path, date_created)
            VALUES('$photo_title', '$file_path', '$date_created');";

        //Get the data
        $result2 = $mysqli->query($sql2);
        $new_id = $mysqli->insert_id;

        //if the checkbox is checked
        if(isset($_POST['checkbox'])){

            //creates a many to many relationship with the photo and the desired album[s]
            foreach($_POST['checkbox'] as $port_id){
                $sql3 = "INSERT INTO Portfolio_photos (portfolioID, photoID)
                              VALUES ('$port_id', '$new_id'); ";

                $result3 = $mysqli->query($sql3);

                //If no result, print the error
                if (!$result3) {
                    print($mysqli->error);
                    exit();
                }

            }
        }

        //If no result, print the error
        if (!$result2) {
            print($mysqli->error);
            exit();
        }
        else {
            echo "<p>Photo successfully added to database!</p>";
        }
    }
}


//function to validate title input
function validateTitle($photo_title)
{
    //has to be less than 30 characters and must be inputted
    if (strlen($photo_title) > 30 || strlen($photo_title) == 0) {
        echo "<p class='warning'>Please submit a photo title with less than 30 characters</p>";
        return false;
    } else {
        return true;
    }
}

//function to make sure it's a valid photo-- if there is something in the upload photo field
function validatePhoto(){

    $newPhoto = $_FILES['newphoto'];

    if(getimagesize($newPhoto)) {
        return true;
    }
    else {
        echo "<p class='warning'>Upload is not a photo</p>";
        return false;
    }
}
?>
