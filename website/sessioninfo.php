<?php session_start(); ?>
<?php
$page_title = 'Maddie Freeman Photography';
include_once('./includes/header.php');
?>

<body>

<script src="scripts/sesssion_details.js"></script>

<?php
include_once('./includes/banner.php');
include_once('./includes/navbar.php');
include_once('./includes/functions.php');

$sql = "SELECT * FROM Sessions";

$result = execute_sql_query($sql);

echo "<table class=\"packages\">";
while ($row = $result->fetch_assoc()) {
    $session_id = $row['sessionID'];
    $session_title = $row['session_title'];
    $price = $row['price'];
    $description = $row['description'];

    echo ("
        <tr data-sessionid='$session_id' class='session_row'> 
            <td class=\"session_title\">$session_title</td>
            <td class=\"session_price\">$price</td>
        </tr>
        <tr id='session-info-$session_id' class='session_info'>
            <td>
                $description
            </td>
        </tr>
    ");
}

echo "</table>";

if (isset($_SESSION['logged_user'])) {
    //selects all albums
    $sql = 'SELECT * FROM Sessions ;';

    $result = execute_sql_query($sql);

    //prints table that allows the user to pick which album to go to with its information
    print "<table id = 'sessions_table' class='center'>";

    print "
            <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Price</td>
                <td>Update</td>
                <td>Remove Session</td>
            </tr>";

    //Loop through the $result rows fetching each one as an associative array
    while ($row = $result->fetch_assoc()) {
        //gets album id and hyperlink
        $session_id = intval($row['sessionID']);
        $old_title = $row['session_title'];
        $old_description = $row['description'];
        $old_price = $row['price'];


        //start the HTML table row and print out each album with its

        print
            "<tr>
                <form method='post' action=''>
                    <td class='title'>
                        <input type=text value='$old_title' name='update_session_title' />
                    </td>
                    <td class='description'>
                        <textarea rows='3' name = 'update_session_description'>$old_description</textarea>
                    </td>
                    <td class='price'>
                        <input type=text value='$old_price' name='update_session_price' />
                    </td>
                    <td>
                        <button type='submit' name='update' value='$session_id'>Update</button>
                    </td>
                </form>
                <form method='post' action=''>
                   <td>
                        <button type='submit' name='delete' value=$session_id>Delete Session</button>
                    </td>
                </form>
            </tr>"
        ;
    }
    print
        "<tr>
                <form method='post' action=''>
                    <td class='title'>
                        <input type=text name='new_session_title'/>
                    </td>
                    <td class='description'>
                        <textarea class='search_area' rows='1' name = 'new_session_description'></textarea>
                    </td>
                    <td class='price'>
                        <input type=text name='new_session_price' />
                    </td>
                    <td></td>
                    <td>
                        <input type='submit' name='new_session' value='Add Session'>
                    </td>
                </form>
            </tr>";

    print "</table>";


    //if the delete button is clicked
    if (isset($_POST["delete"])){

        //get the album to delete
        $portfolio_to_delete = filter_input(INPUT_POST, "delete", FILTER_SANITIZE_STRING);

        print "hey".$portfolio_to_delete;
        //sql to delete the album
        $delete_session = "DELETE FROM Sessions WHERE SessionID = $portfolio_to_delete;";

        $delete_result = execute_sql_query($delete_session);

        //If no result, print the error
        if (!$delete_result) {
            print($mysqli->error);
            exit();
        }

        else{
            print ("<p>Session successfully deleted!</p>");
            //refreshes the page to reflect the change
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    //when the upate button is clicked
    if(isset($_POST['update'])){

        //gets data and cleans it up

        $session_id = filter_input(INPUT_POST, 'update', FILTER_SANITIZE_STRING);
        $new_title = filter_input(INPUT_POST, 'update_session_title', FILTER_SANITIZE_STRING);
        $new_description = trim(filter_input(INPUT_POST, 'update_session_description', FILTER_SANITIZE_STRING));
        $new_price = filter_input(INPUT_POST, 'update_session_price', FILTER_SANITIZE_STRING);

        //if the albums are valid
        if (validSessionInfo($new_title, $new_description, $new_price)){

            //inserts the updates into the database
            $update_sql=
                "UPDATE Sessions
                SET session_title = '$new_title', description = '$new_description', price = '$new_price'
                WHERE sessionID = $session_id;";

            //Get the data
            $update_result = execute_sql_query($update_sql);

            //If no result, print the error
            if (!$result) {
                print($mysqli->error);
                exit();
            }
            else {
                echo "<p>Changes saved!</p>";

                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    //when the user desires to add an album
    if(isset($_POST["new_session"])){

        //gets data and cleans it up
        $new_title = filter_input(INPUT_POST, 'new_session_title', FILTER_SANITIZE_STRING);
        $new_description = filter_input(INPUT_POST, 'new_session_description', FILTER_SANITIZE_STRING);
        $new_price = filter_input(INPUT_POST, 'new_session_price', FILTER_SANITIZE_STRING);

        //if the albums are valid
        if (validSessionInfo($new_title, $new_description, $new_price)){

            //inserts new album with fields
            $insert_sql = "
                  INSERT INTO Sessions (session_title, description, price)
                  VALUES('$new_title', '$new_description', '$new_price');";

            //Get the data
            $insert_result = execute_sql_query($insert_sql);

            //If no result, print the error
            if (!$insert_result) {
                print($mysqli->error);
                exit();
            }
            else
                echo "<p>Session successfully added!</p>";
            //refreshes the page to reflect the change
            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
}

//validates album info based on title and description
function validSessionInfo($new_title, $new_description, $new_price) {
    //title field has to be filled and less than 50 characters
    if(strlen($new_title)>50 || strlen($new_title)==0){
        echo "<p class='warning'>Please submit an session title with less than 50 characters</p>";
        return false;
    }

    //description field has to be less than 300 characters
    if(strlen($new_description)>300){
        echo "<p class='warning'>Please submit an session description with less than 300 characters</p>";
        return false;
    }
    if(strlen($new_price)>300){
        echo "<p class='warning'>Please submit an session description with less than 300 characters</p>";
        return false;
    }
    return true;
};

include_once('./includes/footer.php');


?>

</body>