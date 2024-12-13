<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex 51 willy</title>
</head>
<body>
    <form action="fita51.php" method="post">
        <textarea name="text" id="text" cols="30" rows="10" placeholder="pais"></textarea>
        <input type="submit" value="Enviar">
     </form>
     <br/>
<?php
  try {
    $hostname = "localhost";
    $dbname = "mundo";
    $username = "admin";
    $pw = "admin123";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Error connectant a la BD: " . $e->getMessage() . "<br>\n";
    exit;
  }
 
  //obtenemos el pais 
  if (isset($_POST['text'])) {
    $pais = $_POST['text'];
    var_dump($pais);

    try {

        $qstr = "SELECT ci.Name as 'nom_ciutat' FROM city ci JOIN country co ON ci.CountryCode = co.Code WHERE co.Name LIKE '%$pais%';";
        echo $qstr."<br/>";
        $query = $pdo->prepare($qstr);
        $query->execute();

      } catch (PDOException $e) {
        echo "Error de SQL<br>\n";
        $e = $query->errorInfo();
        if ($e[0]!='00000') {
          echo "\nPDO::errorInfo():\n";
          die("Error accedint a dades: " . $e[2]);
        }  
      }
      echo "{\n";
     //formulario de paises nombre ciudad y nombre pais
      $row = $query->fetch();
      while ( $row ) {
        echo $row['nom_ciutat'] .":" . $row['nom_pais']. "<br/>";
          $row = $query->fetch();
      }
      echo "}\n";
  } 
  unset($pdo); 
  unset($query)
 
?>
    
</body>
</html>