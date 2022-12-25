<?php
//insert.php;

if(isset($_POST["emp_id"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=jbl", "root", "");
 for($count = 0; $count < count($_POST["emp_id"]); $count++)
 {  
  $query = "INSERT INTO employee
  (emp_id, bn_name, en_name, designation, cell_id, usertype, pwd) 
  VALUES (:emp_id, :bn_name, :en_name, :designation, :cell_id, :usertype, :pwd)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':emp_id'  => $_POST["emp_id"][$count], 
    ':bn_name'  => $_POST["bn_name"][$count], 
    ':en_name'  => $_POST["en_name"][$count], 
    ':designation' => $_POST["designation"][$count], 
    ':cell_id' => $_POST["cell_id"][$count],
    ':usertype' => $_POST["usertype"][$count],
    ':pwd'  => $_POST["pwd"][$count]
   )
  );
 }
 $result4 = $statement->fetchAll();
 if(isset($result4))
 {
  echo 'ok';
 }
}
?>
