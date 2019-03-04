<?php



//Events.php

$connect = new PDO("mysql:host=localhost;dbname=trinity;charset=UTF8","root","");

$data = array();

$query = "SELECT * FROM expositions";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["nom"],
  'start'   => $row["date_debut"],
  'end'   => $row["date_fin"],
 );
}

echo json_encode($data);

?>
