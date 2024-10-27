<html>
 <head>
  <title>DB & PHP test: INSERT</title>
 </head>
 <body>
  <form action="insert.php" method="GET"><br>
    Codice EAN:
  <input type="text" name="codiceean"> <br>
    Descrizione:
  <input type="text" name="descrizione"> <br>
    Prezzo:
  <input type="text" name="prezzo"> <br>
    FK Categoria:
    <select name="fkcategoria">
    <option value="1">1</option> 
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
   </select><br>
   <input type="submit" value="Inserisci">
  </form>
 </body>
</html>