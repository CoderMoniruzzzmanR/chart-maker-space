<?php 
require './database/db.php';
$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/css/style.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></link>
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"></link>
    <script type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
   


</head>
<body>
    <div class="main">
        <main class="content">
            <div class="tab-nav">
                <h1>Chart-list</h1>
            </div>
            <div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Chart-id</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i=1; foreach ($result as $value) {?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $value['user_id'];?></td>
                                <td><?php echo $value['title'];?></td>
                                <td><?php echo $value['chart_type'];?></td>
                                <td>
                                    <?php 
                                       echo $date = $value['created_at'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if($value['chart_type'] == 'bar'){
                                            echo '<a href="./chartform/barchartmake.php?type='.$value['type'].'&&type_name='.$value['chart_type'].'&&u_id='.$value['user_id'].'" target="_blank" class="btn btn-warning">Edit</a>';
                                        }

                                        if($value['chart_type'] == 'line'){
                                            echo '<a class="btn btn-warning" href="./chartform/linechartform.php?type='.$value['type'].'&&type_name='.$value['chart_type'].'&&u_id='.$value['user_id'].'" target="_blank">Edit</a>';
                                        }

                                         if($value['chart_type'] == 'pie'){
                                            echo '<a class="btn btn-warning" href="./chartform/piechartform.php?type='.$value['type'].'&&type_name='.$value['chart_type'].'&&u_id='.$value['user_id'].'" target="_blank">Edit</a>';
                                        }
                                        
                                    ?>
                                    <a href="./chartform/share_chart.php?id=<?php echo $value['user_id'];?>" class="btn btn-info" target="_blank">Get code </a>
                                   
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                    
                </table>
            </div>
           
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>
</html>