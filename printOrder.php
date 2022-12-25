<?php 

$conn = mysqli_connect("localhost", "root", "", "jbl2");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css">
    <title>Print</title>
</head>

<body>

<div></br><div></br><div></br><div></br></div></div></div></div>
<div class="dashboard flex-grow-1">
        <div class="container-fluid px-4">
        <div class="row at-4">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-striped"  id="example">
                    
                <thead>
                    <tr>
                        <th>নং</th>
                        <th>কর্মকর্তার নাম</th>
                        <th>পদবী</th>
                        <th>তারিখ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                         $check = "SELECT * FROM officeoeder  ";
                         $posts_run = mysqli_query($conn, $check);

                         if(mysqli_num_rows($posts_run) >0)
                         {
                            foreach($posts_run as $post)
                            {
                                ?>
                                <tr>
                                <td><?= $post['dutyID'] ?></td>
                                    <td><?= $post['name'] ?></td>
                                    <td><?= $post['designation'] ?></td>
                                    <td>
                                    <?= $post['Datepicker'] ?>
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
            <div>             
            </div>

            
        </div>
    </div>
    </div>
 </div>
</div>
</div></div></div>
                    </br></br></br>
<div>
<button type="button" class="btn btn-success" value="Back to Home"><a href="home.php">Back to Home</a></button>
</div>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'print' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
    </script>

    <script src="https://kit.fontawesome.com/605c1f1072.js" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      
    ></script>
  </body>
</html>
