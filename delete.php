<html>
 <head>
  <title>DB & PHP test: DELETE</title>
 </head>
 <body>
  <?php
	$prodotto = $_GET["prodotto"];

	// Connessione al database
	$connection = new mysqli("localhost", "root", "", "Storage");

	// Controllo della connessione
	if ($connection->connect_error) {
		die("Errore di connessione: " . $connection->connect_error);
	}

	// Preparazione della query di eliminazione
	$stmt = $connection->prepare("DELETE FROM prodotti WHERE DESCRIZIONE = ?");
	$stmt->bind_param("s", $prodotto);

	if ($stmt->execute()) {
		echo "Il prodotto $prodotto &egrave; stato eliminato dal database.";
	} else {
		echo "Errore nell'eliminazione del prodotto: " . $stmt->error;
	}

	// Chiusura dei prepared statements e della connessione
	$stmt->close();
	$connection->close();
  ?><br><br>
  <a href="http://localhost/storage/index.php">
   Visualizza elenco prodotti.
  </a>
 </body>
</html>
