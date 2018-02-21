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

		$home_photos = "
		    SELECT *
		    FROM Photos
		      INNER JOIN Home_photos
		        ON Photos.photoID = Home_photos.photoID
		    ORDER BY Home_photos.photoID    
		";

		function create_gallery_table_cell($photo) {
		    if($photo) {
                $file_path = $photo['file_path'];
                $thumbnail_path = "thumb-".$file_path;

                if (!file_exists("images/$thumbnail_path")) {
                    $resized = image_resize("images/$file_path", "images/$thumbnail_path", 303, 200, 0);
                    print $resized;
                    if (!$resized) {
                        print "resize error";
                        $thumbnail_path = $file_path;
                    }
                }

                print
                    "
                    <td class='album-entry'>
                        <a href='images/$file_path' data-lightbox='home-photos'>
                            <img src='images/$thumbnail_path' class='home-photo'/>
                        </a>
                    </td>";
            }
        }

        function create_gallery_table($photos) {
            print "<table class = 'gallery-table center'>";
            print "
            <!-- Zooming of images done with lightbox by Lokesh Dhakar
                            Info: http://lokeshdhakar.com/projects/lightbox2/
                            Licence: https://raw.githubusercontent.com/lokesh/lightbox2/master/LICENSE
                    -->
             ";
            for ($row = 0; $row < $photos->num_rows/3; $row++) {
                print "<tr>";
                for ($col = 0; $col < 3; $col++) {
                    create_gallery_table_cell($photos->fetch_assoc());
                }
                print "</tr>";
            }
            print "</table>";
        }
		create_gallery_table(execute_sql_query($home_photos));
	?>
    <div class='share_btn'>
    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Finfo2300.coecis.cornell.edu%2Fusers%2Ffp_aackt%2Fwww%2FFP%2Findex.php&layout=button&size=large&mobile_iframe=false&width=73&height=28&appId" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
     </div>

    <?php
        include_once('./includes/footer.php');
    ?>
</body>
</html>