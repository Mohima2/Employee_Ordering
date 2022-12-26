<?php
//insert.php;

if(isset($_POST["en_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=latest", "root", "");
 for($count = 0; $count < count($_POST["en_name"]); $count++)
 {  
  $query = "INSERT INTO office_order 
  (en_name, bn_name, designation, shift, datepicker, time_from, time_to) 
  VALUES (:en_name, :bn_name, :designation, :shift, :datepicker, :time_from, :time_to)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':en_name'  => $_POST["en_name"][$count], 
    ':bn_name'  => $_POST["bn_name"][$count], 
    ':designation'  => $_POST["designation"][$count], 
    ':shift'  => $_POST["shift"][$count], 
    ':datepicker'  => $_POST["datepicker"][$count], 
    ':time_from' => $_POST["time_from"][$count], 
    ':time_to'  => $_POST["time_to"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>

