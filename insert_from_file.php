<html>
  <head>
    <title>DB & PHP test: UPLOAD</title>
  </head>
  <body>  <!--IMPORTANTE inserire prodotti-->
   <?php
	if ($_FILES["prodotti"]["error"] == UPLOAD_ERR_OK) {
		$connection = new mysqli("localhost", "root", "", "Storage");
		if ($connection->connect_error) {
			die("Errore di connessione con il DBMS: " . $connection->connect_error);
		}

		$command = $connection->prepare("INSERT INTO prodotti (codiceEAN, DESCRIZIONE, PREZZO, FKCATEGORIA) VALUES (?, ?, ?, ?)");
		if (!$command) {
			die("Errore nella preparazione della query: " . $connection->error);
		}

		$personaggi = file($_FILES["prodotti"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		foreach ($personaggi as $linea) {
			$dati = explode(",", $linea);

			if (count($dati) !== 4) {
				echo "Errore nel formato del file: ogni riga deve contenere esattamente 4 valori.<br>";
				continue;
			}

			$codiceean = trim($dati[0]);
			$descrizione = trim($dati[1]);
			$prezzo = intval(trim($dati[2]));  
			$fkcategoria = intval(trim($dati[3])); 

			if (!$command->bind_param("ssii", $codiceean, $descrizione, $prezzo, $fkcategoria)) {
				echo "Errore nel binding dei parametri: " . $command->error . "<br>";
				continue;
			}

			if ($command->execute()) {
				echo "Il prodotto $descrizione &egrave; stato aggiunto al database.<br>";
			} else {
				echo "Errore: il prodotto $descrizione NON &egrave; stato aggiunto al database: " . $command->error . "<br>";
			}
		}

		unlink($_FILES["prodotti"]["tmp_name"]);
		$command->close();
		$connection->close();
	} else {
		echo "Errore di caricamento del file.";
	}
    ?><br>
    
    <a href="http://localhost/storage/index.php">Visualizza elenco prodotti.</a>
  </body>
</html>
