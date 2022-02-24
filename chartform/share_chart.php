<?php
session_start();
// if(isset($_SESSION['bar_type'])){
//     echo"<br>";
//     echo $_SESSION['bar_type'];
// }
// // echo session_id();
// if(isset($_SESSION['chart_type'])){
//     echo"<br>";
//    echo $_SESSION['chart_type'];
//    echo"<br>";
// }

require '../database/db.php';

if(isset($_GET['id'])){
    $get_id = $_GET['id'];
}

if(isset($_SESSION['bars'])){
    $values_array = $_SESSION['bars'];
    echo "<br>";
    echo "<br>";
    echo $res_bar = json_encode($values_array);
}

if(isset($_SESSION['values'])){
    $values_array = $_SESSION['values'];
    echo "<br>";
    echo "<br>";
    echo $res_value = json_encode($values_array);
}

if(isset($_SESSION['colors'])){
    $colors_array = $_SESSION['colors'];
    echo "<br>";
    echo "<br>";
    echo $res_color = json_encode($colors_array);
}

if(isset($_SESSION['bar_title'])){
    echo "<br>";
    echo "<br>";
    echo $titles = $_SESSION['bar_title'];
    // $title = json_encode($titles);
}

if(isset($_SESSION['bar_sub_title'])){
    echo "<br>";
    echo "<br>";
    echo $sub_titles = $_SESSION['bar_sub_title'];
    // $sub_title = json_encode($sub_titles);
}

if(isset($_SESSION['bar_vertical_label'])){
    echo "<br>";
    echo "<br>";
    echo $vertical_titles = $_SESSION['bar_vertical_label'];
    // $vertical_title = json_encode($vertical_titles);
}

if(isset($_SESSION['bar_horizontal_label'])){
    echo "<br>";
    echo "<br>";
    echo $horizontal_title = $_SESSION['bar_horizontal_label'];
    // $horizontal_title = json_encode($horizontal_titles);
}

if(isset($_SESSION['bar_label'])){
    $bar_label= $_SESSION['bar_label'];
    echo "<br>";
    echo "<br>";
    echo $res_bar_label = json_encode($bar_label);
}

if(isset($_SESSION['file_name'])){
    echo "<br>";
    echo "<br>";
    echo $file_name = $_SESSION['file_name'];
}
else{
    echo "<br>";
    echo "<br>";
    echo "no";
}

$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);

if(isset($get_id)){
    echo "<br>";
    echo "<br>";
    echo "all session id:";
    echo "<br>";
    $target_value = '';
    foreach ($result as $value) {
        if($value['session_id'] == $get_id){
            $target_value = $value['session_id'];
        }
        echo $value['session_id'];
        echo "<br>";
    }

    if($get_id !== ""){
        if($get_id == $target_value){
            echo "<br>";
            echo "<br>";
            echo "Do update". $target_value;
            echo "<br>";
            echo "<br>";
        }
        else{
            if(isset($file_name)){
                $insert = "INSERT INTO chart (bar, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, session_id, water_image) VALUES ('$res_bar_label','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$res_value','$res_color','$get_id','$file_name')";
                $result = mysqli_query($db_conection, $insert);
                // if($result){
                //     echo "<br>";
                //     echo "<br>";
                //     echo "successfully to sent data";
                //     echo "<br>";
                //     echo "<br>";
                // }
            }
            else{
                $insert = "INSERT INTO chart (bar, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, session_id) VALUES ('$res_bar_label','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$res_value','$res_color','$get_id')";
                $result = mysqli_query($db_conection, $insert);
                // if($result){
                //     echo "<br>";
                //     echo "<br>";
                //     echo "successfully to sent data";
                //     echo "<br>";
                //     echo "<br>";
                // }
            }
        }
    }
}



?>