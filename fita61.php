<!-- INSERTS EN BD -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex 61 willy</title>
</head>
<body>
    <form action="fita61.php" method="post">
        <label for="countryCode">Country Code:</label>
        <input type="text" name="countryCode" id="countryCode">
        <label for="language">Language:</label>
        <input type="text" name="language" id="language">
        <label for="percentage">Percentage:</label>
        <input type="text" name="percentage" id="percentage">
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
  if(isset($_POST['countryCode']) && isset($_POST['language']) && isset($_POST['percentage'])) {
    $countryCode = $_POST['countryCode'];
    $language = $_POST['language'];
    $percentage = $_POST['percentage'];

    var_dump($countryCode);
    var_dump($language);
    var_dump($percentage);
    
    try {
        $sqrt = "INSERT INTO countrylanguage (CountryCode, Language, Percentage) VALUES ('$countryCode', '$language', '$percentage');";
        echo $sqrt."<br/>";

        $query = $pdo->prepare($sqrt);
        $query->execute();
        echo "Idioma insertado correctamente: $language<br/> $countryCode<br/> $percentage<br/>";
        
    }catch (PDOException $e) {
      echo "Error de SQL<br>\n";
      $e = $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
      }  
    }

  } else{
    if(!isset($_POST['percentage'])){
      echo "Percentage is required";
    } else if(!isset($_POST['language'])){
      echo "Language is required";
    } else if(!isset($_POST['countryCode'])){
      echo "Country Code is required";
    }
  }
  unset($pdo); 
  unset($query)
 
?>
    
</body>
</html>