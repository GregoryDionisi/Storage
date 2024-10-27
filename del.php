<html>
  <head>
   <title>DB & PHP test: DELETE</title>
  </head>
  <body>
	<?php
		// Connessione al database
		$connection = new mysqli("localhost", "root", "", "Storage");

		// Controllo della connessione
		if ($connection->connect_error) {
			die("Errore di connessione: " . $connection->connect_error);
		}

		$query = "SELECT DESCRIZIONE FROM prodotti ORDER BY DESCRIZIONE";
		$result = $connection->query($query);

		if ($result->num_rows != 0) {
	?>
		<form action="delete.php" method="GET" ><br>
		Prodotto da eliminare<br>
		<select name="prodotto">
	<?php
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				echo "<option value=\"{$row['DESCRIZIONE']}\">{$row['DESCRIZIONE']}</option>";
			}
	?>
		</select><br><br>
		<input type="submit" value="Elimina">
		</form>
	<?php
		} else {
			echo "Nessun prodotto &egrave; presente nel database.";
		}
		
		// Chiusura della connessione
		$connection->close();
	?>
  </body>
</html>
