<div class="navbar">
	<ul class="navbar-tabs">
		<?php
	

		if (isset($_SESSION['logged_user'])) {
			/* Put menu items into an array and then print them out*/
			$menu_items = array(
				'Home' => 'index.php',
				'Portfolio' => 'edit_portfolio.php',
				'Add Photos' => 'add.php',
				'Session Info' => 'sessioninfo.php',
				'Contact' => 'contact.php',
				'About Maddie' => 'about.php'

				);
		}
		else{
			/* Put menu items into an array and then print them out*/
			$menu_items = array(
				'Home' => 'index.php',
				'Portfolio' => '#',
				'Session Info' => 'sessioninfo.php',
				'Contact' => 'contact.php',
				'About Maddie' => 'about.php',
				);
		}

		include_once('./includes/functions.php');

		$sql = "SELECT * FROM Portfolios";

		$result = execute_sql_query($sql);


		foreach ($menu_items as $title => $page) {
			if ($title === 'Portfolio') {
				echo ("
					<div class=\"drop\">
					<li class=\"droplink\"><a href='$page'>$title</a></li>
					<div class=\"drop-content\">
					");

				while ($row = $result->fetch_assoc()) {
					$portfolio_title = $row['portfolio_title'];
					$portfolioID = $row['portfolioID'];

					echo("
						<a href=\"portfolio.php?portfolioID=$portfolioID\">$portfolio_title</a>
						");
				}
				echo ("
					</div>
					</div>
					");
			} else {
				echo ("
					<li><a href='$page'>$title</a></li>
					");
			}

		}


		?>
	</ul>
</div>

<?php
   if (isset($_SESSION['logged_user'])) {
       echo ("<div class='logout_button'>
				<a href='login.php'>Log Out</a>
			</div>");
   }
?>