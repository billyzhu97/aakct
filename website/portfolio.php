<?php session_start(); ?>

<?php
	$page_title = 'Maddie Freeman Photography';
    include_once('./includes/header.php');
?>

<body>
	<?php
		include_once('./includes/banner.php');
		include_once('./includes/navbar.php');
        include_once('includes/functions.php');
        // Find album id from get data
        $portfolio_id = null;
        if (isset($_GET["portfolioID"])) {
            $portfolio_id = filter_input(INPUT_GET, "portfolioID", FILTER_SANITIZE_NUMBER_INT);
        } else {
            print "<p id='warning'> Error: This page does not exist </p>";
            print "<p id='return-to-home'>
                                    <a href='index.php'> Return to Home</a>
                               </p>
                              ";
            print "</div> </body>";
            exit();
        }

        // Find info on album
        $portfolio_query = "
                        SELECT *
                        FROM Portfolios
                        Where portfolioID = $portfolio_id;
                        ";
        $portfolio = execute_sql_query($portfolio_query);

        $portfolio_title = $portfolio->fetch_assoc()['portfolio_title'];

        // Find paintings from album
        $picture_query = "
            SELECT * 
            FROM Photos 
            INNER JOIN Portfolio_photos ON Photos.photoId = Portfolio_photos.photoId 
            INNER JOIN Portfolios ON Portfolio_photos.portfolioId = Portfolios.portfolioId
            WHERE Portfolios.portfolioId = $portfolio_id;";
        $photos = execute_sql_query($picture_query);
    ?>

    <h1 class="center">
        <?php print "<p class='port-title'>$portfolio_title</p>";  ?>
    </h1>

   <div id="slider" class="center">
        <?php

            $num_rows = mysqli_num_rows($photos);
            if($num_rows==0){
                echo"<p class='soon'>Photos coming soon! Please <a href='contact.php'>contact</a> Maddie to book your $portfolio_title photos today</p>";
            }
            while ( $row = $photos->fetch_assoc() ) {
                print "
                    <img src='images/${row['file_path']}' alt='picture in the $portfolio_title portfolio'>
                ";
            }
        ?>
    </div>

    <?php    
        include_once('./includes/footer.php');
    ?>


</body>