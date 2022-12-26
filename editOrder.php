<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=latest", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM employee ORDER BY id ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["en_name"].'">'.$row["en_name"].'</option>';
 }
 return $output;
}



?>
<!DOCTYPE html>
<html>
 <head>
  <title>Office Order</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>

 
 <?php include ("nav.php") ?>
  <br />
  <div class="container">
   <h4 align="center">Enter Details</h4>
   <br />
   <form method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Name1</th>
       <th>Name2</th>
       <th>Designation</th>
       <th>Shift</th>
       <th>Date</th>
       <th>Time From</th>
       <th>Time To</th>
      </tr>
     </table>
     <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="en_name[]" class="form-control en_name"><option value="">Select en_name</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><input type="text" name="bn_name[]" class="form-control bn_name" /></td>';
  html += '<td><input type="text" name="designation[]" class="form-control designation" /></td>';
  html += '<td><input type="text" name="shift[]" class="form-control shift" /></td>';
  html += '<td><input type="text" name="datepicker[]" class="form-control datepicker" /></td>';
  html += '<td><input type="text" name="time_from[]" class="form-control time_from" /></td>';
  html += '<td><input type="text" name="time_to[]" class="form-control time_to" /></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';

  $('.en_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select en_name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.bn_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select bn_name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.designation').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter designation at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.shift').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Shift at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.datepicker').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Date at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.time_from	').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select time_from at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.time_to').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select time to at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insertEdit.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>