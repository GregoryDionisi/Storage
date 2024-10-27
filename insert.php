<html>
  <head>
    <title>DB & PHP test: INSERT</title>
  </head>
  <body>
   <?php
     $codiceean = $_GET["codiceean"];
     $descrizione = $_GET["descrizione"];
     $prezzo = $_GET["prezzo"];
     $fkcategoria = $_GET["fkcategoria"];

     $connection = new mysqli("localhost", "root", "", "Storage");


     if ($connection->connect_error) {
       die("Errore di connessione: " . $connection->connect_error);
     }

     $stmt = $connection->prepare("SELECT * FROM prodotti WHERE DESCRIZIONE = ?");
     $stmt->bind_param("s", $descrizione);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows != 0) {
       echo "Il prodotto $descrizione &egrave; gi&agrave; presente nel database!";
     } else {
       $stmt = $connection->prepare("INSERT INTO prodotti (codiceEAN, DESCRIZIONE, PREZZO, FKCATEGORIA) VALUES (?, ?, ?, ?)");
       $stmt->bind_param("ssdi", $codiceean, $descrizione, $prezzo, $fkcategoria);
       
       if ($stmt->execute()) {
         echo "Il prodotto $descrizione &egrave; stato aggiunto al database!";
       } else {
         echo "Errore nell'aggiunta del prodotto: " . $stmt->error;
       }
     }

     $stmt->close();
     $connection->close();
   ?><br><br>
   <a href="http://localhost/php/index.php">
    Visualizza elenco prodotti.
   </a>
  </body>
</html>
