<?php
	require_once('elements/controllers/index.php'); // Główne funkcje witryny
	
	/** ładowanie modułów z klas pliku main.php **/
	# ---------------------------------------------
	$site = new site; # + zainicjowanie sesji i output_buffering
	//site::errors(); # wyświetlanie błedów
	site::notification(); # wyświetlanie powiadomienia z adresu
	//mysql::db_connect(); # połącz z bazą danych
	//mysql::create_tables(); # utwórz tabelki
?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/elements/style.css" />
	<script type="text/javascript" src="/elements/functions/jquery-2.0.2.min.js"></script>
	<script src="/elements/functions/main.js"></script>
	<script src="/elements/functions/bjqs-1.3.min.js"></script>
	<style>
		.plomba {
			position:fixed;
			bottom:0px;
			width:100%;
			z-index:8000;
			background:url('elements/images/czarny-background-transparent.png');
			padding:15px;
			color:silver;
		}
	</style>
</head>
<body>
	
	<div class="plomba">
		To powiadomienie zniknie samoczynnie, po zaksięgowaniu wpłaty za wykonaną pracę nad stroną.
	</div>
	
	<?php
	// Menu główne
	include('elements/menu.php');
	?>

	<div class="main_div main_center">

		<?php
		
			$page = site::url(0); # pobierz pierwszą część adresu
			
			$site -> load_controller($page);
			
			$site -> load_page($page);

		?>

	</div>
	
	<?php
	// Stopka
	include('elements/footer.php');
	?>

</body>

<title>
	<?php $site -> end(); ?>
</title>

</html>
