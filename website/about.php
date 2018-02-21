<?php
  	session_start();

	$page_title = 'Maddie Freeman Photography';
    include_once('./includes/header.php');
?>

<body>

	<?php
		include_once('./includes/banner.php');
		include_once('./includes/navbar.php');
		include_once('./includes/functions.php');

        echo "<p class='page-title'>Hi! I'm Maddie...</p>";

		$photo = "
		    SELECT *
		    FROM Photos
		      INNER JOIN About_photos
		        ON Photos.photoID = About_photos.photoID
		";
        $result = execute_sql_query($photo);

        //prints the album title as a header
        while ($row = $result->fetch_assoc()) {
            $path = $row['file_path'];
            print(" <img id='about-photo' src='images/$path' /> ");
        }
	?>

	<div class="about">
    	<p class="about-description">Hi! I'm Maddie. I grew up in Acton, Massachusetts in a co-housing neighborhood -- 
    	an intentional community of 24 households who share some meals, duties, and a love of community. 
    	This has shaped who I am today: a lover of groups, laughter, and genuine emotional connection.

		I hold a Bachelor's in Psychology (and a minor in Dance!) from the University of Rochester and am a current
 		graduate student in Clinical Social Work. I live in Somerville, Massachusetts.

		It brings me intense joy to make someone laugh and snap a vibrant picture. It is always a very fun and easygoing 
		photo session; people have told me I make them feel "special" and "really good about themselves."

		Please contact me to set up a session! I would love to laugh with you.</p>
	</div>

    <?php
        include_once('./includes/footer.php');
    ?>
</body>
</html>
