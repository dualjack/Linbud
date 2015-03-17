<?php

	if(empty($_POST['mail']) or empty($_POST['text'])) {
		
		site::back("Proszę wypełnić wszystkie pola|red");
		
	} else {
	
		// Naglowki mozna sformatowac tez w ten sposob.
		$naglowki = "Reply-to: {$_POST['mail']}  < {$_POST['mail']} >".PHP_EOL;
		$naglowki .= "From: {$_POST['mail']}  < {$_POST['mail']} >".PHP_EOL;
		$naglowki .= "MIME-Version: 1.0".PHP_EOL;
		$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 

		//Wiadomość najczęściej jest generowana przed wywołaniem funkcji
		$wiadomosc = "<html> 
		<head> 
		  <title>Kontakt z klientem</title> 
		</head>
		<body>
		  {$_POST['text']}
		</body>
		</html>";


		if(mail('biuro@linbud.pl', 'Kontakt', $wiadomosc, $naglowki))
		{
			
			site::back("Wiadomość została wysłana|green");
		  
		} else {
			
			site::back("Wystąpił błąd|red");
			
		}
	}
?>
