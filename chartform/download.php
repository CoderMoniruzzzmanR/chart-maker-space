<?php
session_start();
require '../database/db.php';

$res_bar_label = $titles = $res_value = $sub_titles = $horizontal_title = $vertical_titles = $get_type_status = $get_chart_type = $user_frame = $res_value_x = Null;

$res_bar = '';
$err_img = '';

if(isset($_SESSION['bars'])){
    $values_array = $_SESSION['bars'];
    $res_bar = json_encode($values_array);
}

$res_line_label = '';
if(isset($_SESSION['barsl'])){
    $values_array = $_SESSION['barsl'];
    $res_line_label = json_encode($values_array);
}

if(isset($_SESSION['values'])){
    $values_array = $_SESSION['values'];
    $res_value = json_encode($values_array);
}

if(isset($_SESSION['colors'])){
    $colors_array = $_SESSION['colors'];
    $res_color = json_encode($colors_array);
}

if(isset($_SESSION['bar_label'])){
    $bar_label= $_SESSION['bar_label'];
    $res_bar_label = json_encode($bar_label);
}

if(isset($_SESSION['bar_title'])){
    $titles = $_SESSION['bar_title'];
    $title = json_encode($titles);
}

if(isset($_SESSION['bar_sub_title'])){
    $sub_titles = $_SESSION['bar_sub_title'];
    $sub_title = json_encode($sub_titles);
}

if(isset($_SESSION['bar_vertical_label'])){
    $vertical_titles = $_SESSION['bar_vertical_label'];
    $vertical_title = json_encode($vertical_titles);
}

if(isset($_SESSION['bar_horizontal_label'])){
    $horizontal_titles = $_SESSION['bar_horizontal_label'];
    $horizontal_title = json_encode($horizontal_titles);
}

if(isset($_SESSION['bar_type'])){
    $get_type_status =  $_SESSION['bar_type'];
}
if(isset($_SESSION['chart_type'])){
    $get_chart_type = $_SESSION['chart_type'];
}

if(isset($_SESSION['x_value'])){
     $x_value_array = $_SESSION['x_value'];
     $res_value_x = json_encode($x_value_array);
 }

// echo '<br>';
// echo $get_type_status;
// echo '<br>';
// echo $get_chart_type;
// echo '<br>';

if(isset($_SESSION['colors'])){
    $colors_array = $_SESSION['colors'];
    $res_color = json_encode($colors_array);
}

if(isset($_SESSION['bg_color'])){
    $bg_color_array = $_SESSION['bg_color'];
    $res_color_bg = json_encode($bg_color_array);
}



if(isset($_SESSION['values_two'])){
    $values_two_array = $_SESSION['values_two'];
    $res_value_two = json_encode($values_two_array);
}


if(isset($_SESSION['values_three'])){
    $values_three_array = $_SESSION['values_three'];
    $res_value_three = json_encode($values_three_array);
}

$d_color = $d_value = $d_value_one = $d_value_two = $d_value_three = $d_bg_color = $line_label = '';

if(isset($res_value)){
    $d_value = $res_value;
}
if(isset($res_color)){
    $d_color = $res_color;
}
if(isset($res_color_bg)){
    $d_bg_color = $res_color_bg;
}
if(isset($res_value_one)){
   $d_value_one = $res_value_one;
}
if(isset($res_value_two)){
    $d_value_two = $res_value_two;
}
if(isset($res_value_three)){
    $d_value_three = $res_value_three;
}

$line_vali = '';
$de_lines = "";
if(isset($_SESSION['line_ara'])){
    $line_vali = $_SESSION['line_ara'];
    //echo "<pre>";
    $de_lines = json_encode($line_vali);
    // print_r($de_lines);
    //echo '</pre>';

   // echo "<pre>";
    // print_r($lo = json_decode($de_lines));
    //echo '</pre>';
}

if(isset($_SESSION['u_id'])){
    $session_eid = '';
    $session_eid = $_SESSION['u_id'];
}

$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);
$target_edvalue = '';
$target_edid ='';
if(isset($session_eid)){
    foreach ($result as $value) {
        if($value['user_id'] == $session_eid){
            $target_edvalue = $value['user_id'];
            $target_edid = $value['id'];
        }
    }
}

$session_id = session_id();

// echo $session_id;
// echo "<br>";
// echo $target_edvalue;
// echo "<br>";

// if(isset($target_edvalue)){
//     if($session_id !== $target_edvalue){
//         // echo "not match";
//         // echo "<br>";
//         $target_edid;
//         // echo "<br>";
//         $target_edvalue;
//     }
// }line_x_axis

$target_value = '';
$target_id ='';

$select_chart_db = "SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);
if(isset($session_id)){
    foreach ($result as $value) {
        if($value['user_id'] == $session_id){
            $target_value = $value['user_id'];
            $target_id = $value['id'];
        }
    }
}

if(isset($_POST['getcode'])){
    if(!empty($target_edvalue)){
        if(empty($_FILES['water-image']['name'])){
            if(isset($target_edid)){
                $select_db = "SELECT * FROM chart WHERE id ='$target_edid'";
                $result = mysqli_query($db_conection,  $select_db);
                if($result){
                    $after_assoc = mysqli_fetch_assoc($result);
                }
            }
            if(isset($after_assoc['water_image'])){
                if($after_assoc['water_image'] !== NULL){
                    $delete_from_location="../uploads/".$after_assoc['water_image'];
                    unlink($delete_from_location);
                }
            }  
            $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$target_edvalue',water_image=NULL,line_x_axis='$res_value_x',line_label='$de_lines' WHERE id='$target_edid'";
            $result = mysqli_query($db_conection, $update);
        }else{
            $uploaded_file = $_FILES['water-image'];
            $after_explode = explode('.', $uploaded_file['name']);
            $extention = end($after_explode);
            $allowed_extention = array('png','svg');
            if(in_array($extention, $allowed_extention)){
                if($uploaded_file['size'] <= 100000){
                    $file_name = $session_id.'.'.$extention;
                    $new_location = '../uploads/'.$file_name;
                    move_uploaded_file($uploaded_file['tmp_name'], $new_location);
                    $image_name = $_SESSION['file_name'] = $file_name;
                    $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$target_edvalue',water_image='$image_name',line_x_axis='$res_value_x',line_label='$de_lines' WHERE id='$target_edid'";
                    $result = mysqli_query($db_conection, $update);
                }
                else{
                    $err_img = "Image Too large";
                }
            }
            else{
                $err_img= "Invalidate image format(Only support png, svg)";
            }
        }
    }
    else{
        if(empty($_FILES['water-image']['name'])){
            if($session_id !== $target_value){
                $insert = "INSERT INTO chart (bar, type, chart_type, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, user_id, line_x_axis, line_label) VALUES ('$res_bar_label','$get_type_status','$get_chart_type','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$d_value','$d_color','$session_id','$res_value_x','$de_lines')";
                $result = mysqli_query($db_conection, $insert);
            }
            else{
                if(isset($target_id)){
                    $select_db = "SELECT * FROM chart WHERE id ='$target_id'";
                    $result = mysqli_query($db_conection,  $select_db);
                    if($result){
                        $after_assoc = mysqli_fetch_assoc($result);
                    }
                }
                if(isset($after_assoc['water_image'])){
                    if($after_assoc['water_image'] !== NULL){
                        $delete_from_location="../uploads/".$after_assoc['water_image'];
                        unlink($delete_from_location);
                    }
                }  
                $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$session_id',water_image=NULL,line_x_axis='$res_value_x',line_label='$de_lines' WHERE id='$target_id'";
                $result = mysqli_query($db_conection, $update);
            }
        }
        else{
            $uploaded_file = $_FILES['water-image'];
            $after_explode = explode('.', $uploaded_file['name']);
            $extention = end($after_explode);
            $allowed_extention = array('png','svg');
            if(in_array($extention, $allowed_extention)){
                if($uploaded_file['size'] <= 100000){
                    $file_name = $session_id.'.'.$extention;
                    $new_location = '../uploads/'.$file_name;
                    move_uploaded_file($uploaded_file['tmp_name'], $new_location);
                    $image_name = $_SESSION['file_name'] = $file_name;
                    if($session_id !== $target_value){
                        $insert = "INSERT INTO chart (bar, type, chart_type, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, user_id, water_image, line_x_axis, line_label) VALUES ('$res_bar_label','$get_type_status','$get_chart_type','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$d_value','$d_color','$session_id','$image_name','$res_value_x','$de_lines')";
                        $result = mysqli_query($db_conection, $insert);
                    }
                    else{
                        $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$session_id',water_image='$image_name',line_x_axis='$res_value_x',line_label='$de_lines' WHERE id='$target_id'";
                        $result = mysqli_query($db_conection, $update);
                    }
                }
                else{
                    $err_img = "Image Too large";
                }
            }
            else{
                $err_img= "Invalidate Image format(Only support png, svg)";
            }

        }
    }
}


$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);

$get_iframe_id = '';
$get_iframe_target_id = '';
foreach ($result as $value) {
    if(empty($_SESSION['u_id'])){
        if($value['user_id'] == $session_id){
            $get_iframe_id = $value['user_id'];
            $get_iframe_target_id = $value['id'];
        }
    }else{
        if($value['user_id'] == $_SESSION['u_id']){
            $get_iframe_id = $value['user_id'];
            $get_iframe_target_id = $value['id'];
        }
    }
    
}

if(isset($get_iframe_target_id)){
    $select_db = "SELECT * FROM chart WHERE id = '$get_iframe_target_id'";
    $result = mysqli_query($db_conection, $select_db);
    if($result){
        $after_assoc = mysqli_fetch_assoc($result);
    }
}

if(isset($after_assoc['user_id'])){
    $user_frame = $after_assoc['user_id'];
}
 
if(isset($_SESSION['u_id'])){
    $prev_ue = $_SESSION['u_id'];
    if($user_frame !== $prev_ue){
        $user_frame = $prev_ue;
    }
}

if(isset($after_assoc['water_image'])){
    if($after_assoc['water_image'] !== NULL){
        $image_path="../uploads/".$after_assoc['water_image'];
    }
}

if(isset( $after_assoc['bar'])){
    $bar_labels =  json_encode($after_assoc['bar']);
}

if(isset( $after_assoc['title'])){
    $title =  json_encode($after_assoc['title']);
}

if(isset( $after_assoc['sub_title'])){
    $sub_title =  json_encode($after_assoc['sub_title']);
}

if(isset( $after_assoc['horizontal_title'])){
    $horizontal_title = $after_assoc['horizontal_title'];
}

if(isset( $after_assoc['vertical_title'])){
    $vertical_title =  json_encode($after_assoc['vertical_title']);
}

if(isset( $after_assoc['bar_name'])){
    $bar_name =  $after_assoc['bar_name'];
}

if(isset( $after_assoc['bar_value'])){
    $bar_value =  $after_assoc['bar_value'];
}

if(isset( $after_assoc['bar_color'])){
    $bar_color =  $after_assoc['bar_color'];
}

$line_x_axis_l = '';
if(isset( $after_assoc['line_x_axis'])){
     $line_x_axis_l =  $after_assoc['line_x_axis'];
}
 
$graph_status = $ghaph_name_type = '';
if(isset( $after_assoc['type'])){
    $graph_status =  $after_assoc['type'];
}

if(isset($after_assoc['chart_type'])){
    $ghaph_name_type =  $after_assoc['chart_type'];
}

if(isset($after_assoc['line_label'])){
    $ghaph_line = $after_assoc['line_label'];
    //echo "<pre>";
    // print_r(json_decode($ghaph_line ));
    //echo "</pre>";
    // echo "ok";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css"></link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <main class="content">
            <div class="tab-nav">
                <ol class="nav">
                    <li class="nav-item">
                        1. Choose Chart Type
                    </li>
                    <li class="nav-item">
                        2. Enter Labels
                    </li>
                    <li class="nav-item">
                        3. Enter Data
                    </li>
                    <li class="nav-item">
                    4. Download
                    </li>
                </ol>
            </div>
            <div class="form-get">
                <form class="form" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
                    <div class="form-item">
                        <input type="file" name="water-image" class="form-control">
                        <?php
                            if(isset($err_img)){
                                echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                echo $err_img;
                                echo '</span>';
                            }
                        ?>
                        <input type="submit" class="btn" name="getcode" value="generate preview and code">
                    </div>
                </form>
            </div>
        
            <div class="preview-chart" style="border-top: 5px solid #33CC66; background-color: #ebfaf0; margin-bottom:100px;">
                <canvas id="myChart"></canvas>
            </div>
                <?php 
                    if(isset($user_frame)){
                        echo '<button class="btn" onClick="download()">Download as Image</button>';

                        echo '<button class="btn" id="downloadPdf">Download as pdf</button>';
                       
                        $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

                        echo '<input type="text" style="margin-left:15px;" value="'.$base_url.'share_chart.php?id='.$user_frame.'" id="urlInputCopy">';
                        echo '<button class="btn" onclick="myUrlCopy()">copy to share</button>';
                    }
                ?>
            <div class="btn-main">
                <div class="button-group">
                    <?php  
                        $base_url="http://".$_SERVER['SERVER_NAME'];
                        if($get_chart_type == "pie" || $get_chart_type == "doughnut" || $get_chart_type == "polarArea"){
                            echo '<a href="../chartform/post_data_piechart.php" class="btn">back</a>';
                        }
                        if($get_chart_type == "bar"){
                            echo '<a href="../chartform/post_data_barchart.php" class="btn">back</a>';
                        }
                        if($get_chart_type == "line"){
                            echo '<a href="../chartform/post_data_linechart.php" class="btn">back</a>';
                        }
                    ?>
                    
                </div>
            </div>
            <div  class="copy_area">
                <div class="btn-main">
                    <a href="../view_chart_list.php" class="btn">
                        Chart list 
                    </a>
                </div>
            </div>
            <div class="copy_area">
                <div class="btn-main">
                    <div>
                        <a href="javascript:void()" class="btn" onclick="myFunctionCopy()" onmouseout="outFunc()">
                            <span class="tooltiptext" id="myTooltip">
                                copy html
                            </span>
                        </a>
                    </div>
                </div>
                <textarea style="max-width: 500px; width:100%;" rows="6" id="myInputCopy">
                    <?php 
                      $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
                        if(isset($user_frame)){
                            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">';
                            echo '<div class="embed-responsive embed-responsive-16by9">';
                            echo '<iframe class="embed-responsive-item" src="'. $base_url.'share_chart.php?id='.$user_frame.'">';
                            echo '</iframe>';
                            echo '</div>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>';
                        }
                    ?>
                </textarea>
                <script>
                    function myUrlCopy() {
                        var copyText = document.getElementById("urlInputCopy");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        document.execCommand("copy");
                        // navigator.clipboard.writeText(copyText.value);
                    }

                    function myFunctionCopy() {
                        var copyText = document.getElementById("myInputCopy");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        document.execCommand("copy");
                        // navigator.clipboard.writeText(copyText.value);
                    }
                    // function outFunc() {
                    //     var tooltip = document.getElementById("myTooltip");
                    //     tooltip.innerHTML = "Copy to clipboard";
                    // }
                </script>
            </div>    
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
        <?php 
        //    if(isset($after_assoc['line_label'])){
        //         $ghaph_line = $after_assoc['line_label'];
        //         $s = '';
        //         $col_size ='';
        //         $s = json_decode($ghaph_line);
        //         foreach($s as $key=>$val){
        //             if($key == 0){
        //                 foreach($val as $key=>$kal){
        //                     if($key == 0){
        //                         // echo "<pre>";
        //                         // print_r($kal);
        //                         // echo "</pre>";
        //                         $col_size = count($kal);
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     echo $col_size;
        ?>
    <script>
        const labels = <?php if($ghaph_name_type == "line"){echo "''";}else{echo $bar_name;}?>;
        const data = {
            labels: <?php if($ghaph_name_type == "line"){
                    if(isset($after_assoc['line_x_axis'])){
                         echo $after_assoc['line_x_axis'];

                    //     $ghaph_line = $after_assoc['line_label'];
                    //     $s = '';
                    //     $col_size ='';
                    //     $s = json_decode($ghaph_line);
                    //     foreach($s as $key=>$val){
                    //         if($key == 0){
                    //             foreach($val as $key=>$kal){
                    //                 if($key == 0){
                    //                     $col_size = count($kal);
                    //                 }
                    //             }
                    //         }
                    //     }
                    //     $counts_label = 0;
                    //     echo "[";
                    //     for($i=0; $i < $col_size; $i++){
                    //         echo '"'.$counts_label +=10;
                    //         echo '"';
                    //         echo ",";
                    //     }
                    //     echo "]";
                    }
                }else{echo "labels";}?>
            ,
            datasets: [
                <?php 
                    if($ghaph_name_type == "line"){
                        if(isset($after_assoc['line_label'])){
                            $ghaph_line = $after_assoc['line_label'];
                            $s = '';
                            $l = '';
                            $s = json_decode($ghaph_line);
                            $l = count($s);
                            $u = 0;
                            foreach($s as $key=>$ful){
                                // $u++;
                                // echo $u;
                                echo "{";
                                foreach($ful as $key=>$val){
                                    if($key == 1){
                                        echo "label:'".$val."',";
                                    }
                                    if($key == 0){
                                        echo "data:".json_encode($val).",";
                                    }
                                    if($key == 2){
                                        echo "backgroundColor: '".$val."',";
                                        echo "borderColor:'".$val."',";
                                        echo "fill: false";
                                    }
                                }
                                echo "},";
                            }
                        }

                    } 
                    else{
                        echo "{backgroundColor: $bar_color,borderColor:  $bar_color,data: $bar_value,}";
                    }
                ?>
                
            ]
        };

        const logo = new Image();
        logo.src = '<?php if(isset($image_path)){echo $image_path;}else{echo '  ';} ?>';

        const logoImage = {
            id : 'logoImage',
            afterDraw(chart, args, options){
                const {ctx, chartArea:{top, bottom, left, right}} = chart;
                ctx.save();
                if(logo.complete){
                    ctx.drawImage(logo, (ctx.canvas.offsetWidth - 100), (ctx.canvas.offsetHeight - 600), 70, 70);
                }
            }
        }
        var delayed;
        const config = {
            type: '<?php echo $ghaph_name_type;?>',
            data: data,
            options: {
                maintainAspectRatio :false,
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        delay: 1000,
                    }
                }
                <?php  
                    // $ghaph_name_type = "bar";
                    if($ghaph_name_type == "bar"){
                        echo ",scales:{";
                        echo " x:{";
                        echo " stacked: true,";
                        echo " title: {";
                        echo "display: true, text: $horizontal_title, padding: {top: 30}, font: {size: 15},";
                        echo " },"; 
                        echo "},";
                        echo "y:{";
                        echo " stacked: true,";
                        echo " title: {";
                        echo "display: true, text: $vertical_title, padding: {right: 45,}, font: {size: 15},";
                        echo " },";   
                        echo "},";
                        echo " }";
                    }
                 
                ?>,
                plugins: {
                    legend: {
                        <?php  
                        if($ghaph_name_type == "bar" ){
                            echo "display: false";
                        }
                        else{
                            echo "display: true"; 
                        }
                        ?>,
                    },
                    title: {
                        display: true,
                        text: <?php echo $title;?>,
                        padding: {
                            top: 10,
                            bottom: 10,
                        },
                        font: {
                            size: 18
                        }
                    },
                    subtitle: {
                        display: true,
                        text: <?php echo $sub_title;?>,
                        padding: {
                            bottom: 30,
                        }
                    }
                }
            }
            <?php if(isset($image_path)) { echo ",plugins:[logoImage]";}?>,
            
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        function download(){
            const imageLink = document.createElement('a');
            const canvas = document.getElementById('myChart');
            imageLink.href = canvas.toDataURL('image/png', 1);
            imageLink.download = 'my_chart.png';
            imageLink.click();
            //console.log(canvas);
            // console.log(ctx.canvas.offsetHeight);
        }
        
        $('#downloadPdf').click(function(event) {
        // get size of report page
        var reportPageHeight = $('#myChart').innerHeight();
        var reportPageWidth = $('#myChart').innerWidth();
        
        // create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight
        });
        
        // keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 0;
        var pdfctxY = 0;
        var buffer = 100;
        
        // for each chart.js chart
        $("canvas").each(function(index) {
            // get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();
            
            // draw the chart into the new canvas
            pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            pdfctxX += canvasWidth + buffer;
            
            // our report page is in a grid pattern so replicate that in the new canvas
            if (index % 2 === 1) {
            pdfctxX = 0;
            pdfctxY += canvasHeight + buffer;
            }
        });
        
        // create new pdf and add our new canvas as an image
        var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
        pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
        
        // download the pdf
        pdf.save('mychart.pdf');
        });
    </script>
        
</body>
</html>
