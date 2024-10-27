<html>
  <head>
    <title>DB & PHP test: UPLOAD</title>
  </head>
  <body>
   <form enctype="multipart/form-data" action="insert_from_file.php" method="POST">
    Selezionare il file dei prodotti da inviare:<br>
    <input type="file" name="prodotti"><br><br> <!--IMPORTANTE inserire prodotti nel name-->
    <input type="submit" value="Inoltra">
   </form>
  </body>
</html>
