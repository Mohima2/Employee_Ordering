<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=mohima", "root", "");
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

function fill_unit_select_box2($connect)
{ 
 $output = '';
 $query = "SELECT * FROM employee ORDER BY id ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["bn_name"].'">'.$row["bn_name"].'</option>';
 }
 return $output;
}

function fill_unit_select_box3($connect)
{ 
 $output = '';
 $query = "SELECT * FROM designation ORDER BY id ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["title"].'">'.$row["title"].'</option>';
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
  <link rel="stylesheet" href="jquery-ui.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="timepicker.css">
  <script type="text/javascript" src="timepicker.js"></script>
 </head>
 <body>
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
      <tr>
       <td><select name="en_name[]" class="form-control en_name"><option value="">Select Name(English)</option><?php echo fill_unit_select_box($connect); ?></select></td>
       <td><select name="bn_name[]" class="form-control bn_name"><option value="">Select Name(Bangla)</option><?php echo fill_unit_select_box2($connect); ?></select></td>
       <td><select name="designation[]" class="form-control designation"><option value="">Select designation</option><?php echo fill_unit_select_box3($connect); ?></select></td>
       <td><select name="shift[]" class="form-control shift"><option value="">Select shift</option><?php echo fill_unit_select_box($connect); ?></select></td>
       <td><input type="text" name="Datepicker[]" id="datepicker" class="form-control datepicker" autocomplete="off" /></td>
       <td><input id="timepkr" style="width: 100px; float: left" class="form-control" placeholder="HH:MM" /><button class="btn btn-primary"  onclick="showpickers('timepkr',12)" ><i class="fa fa-clock-o"></i></button></td>
        <div class="timepicker"></div>
       <td><input type="time" name="mytime" class="form-control mytime"></td>
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

<script src="jquery-3.6.2.min.js"></script>
<script src="jquery-ui.min.js"></script>

<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            dateFormat: "dd-mm-yy", 
            changeMonth: true
        });
    });
</script>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="en_name[]" class="form-control en_name"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><select name="bn_name[]" class="form-control bn_name"><option value="">Select Unit</option><?php echo fill_unit_select_box2($connect); ?></select></td>';
  html += '<td><select name="designation[]" class="form-control designation"><option value="">Select designation</option><?php echo fill_unit_select_box3($connect); ?></select></td>';
  html += '<td><select name="shift[]" class="form-control shift"><option value="">Select shift</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><input type="text" name="Datepicker[]"  class="form-control datepicker" autocomplete="off" /></td>';
  html += '<td><input type="time" name="mytime" class="form-control mytime"></td>';
  html += '<td><input type="time" name="mytime" class="form-control mytime"></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
  $('.datepicker').datepicker({
            dateFormat: "dd-mm-yy", 
            changeMonth: true
        });
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
    error += "<p>Enter Name1 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.bn_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter name2 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.designation').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.shift').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.datepicker').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Name1 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.time_from').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter name2 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.time_to').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter name2 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });


  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"empInsert.php.php",
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
