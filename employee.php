<?php
//Employee.php

$connect = new PDO("mysql:host=localhost;dbname=jbl", "root", "");
function fill_unit_select_box($connect)
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
  <title>Add Employee</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>

 <?php include ("nav.php"); ?>

  <br />
  <div class="container">
   <h4 align="center">Enter Item Details</h4>
   <br />
   <form method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Employee ID</th>
       <th>Name1</th>
       <th>Name2</th>
       <th>Designation</th>
       <th>Cell Code</th>
       <th>Usertype</th>
       <th>Password</th>
      </tr>
     </table>
     <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
  </div>


<?php 

$conn = mysqli_connect("localhost", "root", "", "jbl");

?>

<div class="dashboard flex-grow-1">

        <div class="container-fluid px-4">
        <div class="row at-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                           Employee Details
                           
                        </h1>
                    </div>

                <div class="card-body">
        
                <div class="table-responsive">
            
                <table class="table table-bordered table-striped">
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Designation</th> 
                        <th>Cell</th>
                        <th>Edit Info</th>

                    </tr>
                   
                </thead>
                <tbody>
                    <?php 
                         $check = "SELECT * FROM employee";
                         $posts_run = mysqli_query($conn, $check);

                         if(mysqli_num_rows($posts_run) >0)
                         {
                            foreach($posts_run as $post)
                            {
                                ?>
                                <tr>
                                    <td><?= $post['emp_id'] ?></td>
                                    <td><?= $post['en_name'] ?></td>
                                    <td><?= $post['designation'] ?></td>
                                    <td><?= $post['cell_id'] ?></td>
                                    <td><a href="#" class="btn btn-success">Update</a></td>
                                </tr>
                                <?php
                            }
                         }
                         else
                         {
                    ?>
                    <tr>
                        <td colspan="6">No Record Found!</td>
                    </tr>
                    <?php 
                     }
                    ?>         
                </tbody>
            </table>
        </div>
    </div>
    </div>
 </div>
</div>
</div></div></div>


 </body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="emp_id[]" class="form-control emp_id" /></td>';
  html += '<td><input type="text" name="bn_name[]" class="form-control bn_name" /></td>';
  html += '<td><input type="text" name="en_name[]" class="form-control en_name" /></td>';
  html += '<td><select name="designation[]" class="form-control designation"><option value="">Select designation</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><input type="text" name="cell_id[]" class="form-control cell_id" /></td>';
  html += '<td><input type="text" name="usertype[]" class="form-control usertype" /></td>';
  html += '<td><input type="text" name="pwd[]" class="form-control pwd" /></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.emp_id').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter emp_id at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.bn_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter bn_name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.en_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter en_name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.designation').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select designation at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.cell_id').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter cell_id at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.usertype	').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter usertype	 at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  $('.pwd').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter pwd at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });

  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data1)
    {
     if(data1 == 'ok')
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
