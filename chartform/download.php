<?php
session_start();
require '../database/db.php';

$res_bar_label = $titles = $res_value = $sub_titles = $horizontal_title = $vertical_titles = $get_type_status = $get_chart_type = Null;

$res_bar = '';

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

if(isset($_SESSION['value_one'])){
    $values_one_array = $_SESSION['value_one'];
    $res_value_one = json_encode($values_one_array);
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

$session_id = session_id();

$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);
if(isset($_POST['getcode'])){
    // echo '<br>';
    // echo $get_type_status;
    // echo '<br>';
    // echo $get_chart_type;
    // echo '<br>';
    // echo  "this is title =>".$title;
    // echo '<br>';
    // echo  "this is sub title =>".$sub_title;
    // echo '<br>';
    // echo  "this is vertical =>".$vertical_title;
    // echo '<br>';
    // echo  "this is horizontal =>". $horizontal_title;
    // echo '<br>';
    // echo  "this is bar =>".$res_bar;
    // echo '<br>';
    // echo  "this is value =>".$d_value;
    // echo '<br>';
    // echo  "this is color =>". $d_color;
    // echo '<br>';
    // echo  "this is line label =>".$res_line_label;
    // echo '<br>';
    // echo  "this is line bg =>".$d_bg_color;
    // echo '<br>';
    // echo "this is line value one =>".$res_value_one;
    // echo '<br>';
    // echo "this is line value two =>".$d_value_two;
    // echo '<br>';
    // echo "this is line value three =>".$d_value_three;
    // echo '<br>';
    // echo "this is seesion id =>".$session_id;
    // echo '<br>';
    
    if(empty($_FILES['water-image']['name'])){
            
        if(isset($session_id)){
            $target_value = '';
            $target_id ='';
            foreach ($result as $value) {
                if($value['user_id'] == $session_id){
                    $target_value = $value['user_id'];
                    $target_id = $value['id'];
                }
            }
        }
        
        if($session_id !== $target_value){
            $insert = "INSERT INTO chart (bar, type, chart_type, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, user_id,values_two,values_three,bg_color,value_one,line_label) VALUES ('$res_bar_label','$get_type_status','$get_chart_type','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$d_value','$d_color','$session_id','$d_value_two','$d_value_three','$d_bg_color','$d_value_one','$res_line_label')";
            $result = mysqli_query($db_conection, $insert);
            // if($result){
            //     echo "ok";
            // }
            // else{
            //     echo "no";
            // }

        }
        else{
            if(isset($target_id)){
                $select_db = "SELECT * FROM chart WHERE id = $target_id";
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

            $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$session_id',water_image=NULL,values_two='$d_value_two',values_three='$d_value_three',bg_color='$d_bg_color',value_one='$d_value_one',line_label='$res_line_label' WHERE id=$target_id";
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
                if(isset($session_id)){
                    $target_value = '';
                    $target_id ='';
                    foreach ($result as $value) {
                        if($value['user_id'] == $session_id){
                            $target_value = $value['user_id'];
                            $target_id = $value['id'];
                        }
                    }
                }
                if($session_id !== $target_value){
                    $insert = "INSERT INTO chart (bar, type, chart_type, title, sub_title, horizontal_title, vertical_title, bar_name, bar_value, bar_color, user_id, water_image, values_two,values_three, bg_color, value_one, line_label) VALUES ('$res_bar_label','$get_type_status','$get_chart_type','$titles','$sub_titles','$horizontal_title','$vertical_titles','$res_bar','$d_value','$d_color','$session_id','$image_name','$d_value_two','$d_value_three','$d_bg_color','$d_value_one','$res_line_label')";
                    $result = mysqli_query($db_conection, $insert);
                }
                else{
                    // echo $target_id;
                    $update = "UPDATE chart SET bar='$res_bar_label',type='$get_type_status',chart_type='$get_chart_type',title='$titles',sub_title='$sub_titles',horizontal_title='$horizontal_title',vertical_title='$vertical_titles',bar_name='$res_bar',bar_value ='$d_value',bar_color='$d_color',user_id='$session_id',water_image='$image_name',values_two='$d_value_two',values_three='$d_value_three',bg_color='$d_bg_color',value_one='$d_value_one',line_label='$res_line_label' WHERE id=$target_id";
                    $result = mysqli_query($db_conection, $update);
                    // echo 'ok';
                }
            }
            else{
                header('location:download.php?water_image=File Too large');
            }
        }
        else{
            header('location:download.php?water_image=Invalidate file format(Only support png, svg)');
        }
    }
}


$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);

$get_iframe_id = '';
$get_iframe_target_id = '';
foreach ($result as $value) {
    if($value['user_id'] == $session_id){
        $get_iframe_id = $value['user_id'];
        $get_iframe_target_id = $value['id'];
    }
}

if(isset($get_iframe_target_id)){
    $select_db = "SELECT * FROM chart WHERE id = $get_iframe_target_id";
    $result = mysqli_query($db_conection,  $select_db);
    if($result){
        $after_assoc = mysqli_fetch_assoc($result);
    }
}

if(isset($after_assoc['user_id'])){
    $user_frame = $after_assoc['user_id'];
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

$graph_status = $ghaph_name_type = '';
if(isset( $after_assoc['type'])){
    $graph_status =  $after_assoc['type'];
}

if(isset( $after_assoc['chart_type'])){
    $ghaph_name_type =  $after_assoc['chart_type'];
}
$count_line_label = '';

if(isset( $after_assoc['value_one'])){
    $ghaph_value_one =  $after_assoc['value_one'];
    if( $ghaph_value_one){
        $count_line_label = count(json_decode($ghaph_value_one));
    }
}
    

if(isset( $after_assoc['values_two'])){
    $ghaph_values_two =  $after_assoc['values_two'];
}

if(isset( $after_assoc['values_three'])){
    $ghaph_values_three =  $after_assoc['values_three'];
}

if(isset( $after_assoc['bg_color'])){
    $ghaph_bg_color =  $after_assoc['bg_color'];
    $bg_color_line = json_decode($ghaph_bg_color);
    $dataCount = '';
    if($bg_color_line){
        $dataCount = count($bg_color_line);
    }
    $new_bg_color1 =  $new_bg_color1 =  $new_bg_color1 = '';
    for ($i=0; $i < $dataCount; $i++) {
        $new_bg_color1 = $bg_color_line[0];
        $new_bg_color2 = $bg_color_line[1];
        $new_bg_color3 = $bg_color_line[2];
    }
    $new_bg_color1;
    $new_bg_color2;
    $new_bg_color3;
}

if(isset( $after_assoc['line_label'])){
    $ghaph_line_label =  $after_assoc['line_label'];
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
                            if(isset( $_GET['water_image'])){
                                echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                echo $_GET['water_image'];
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
                        <a href="#" class="btn">Exit</a>
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
                <textarea style="width: 500px;" rows="6" id="myInputCopy">
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
                        navigator.clipboard.writeText(copyText.value);
                    }

                    function myFunctionCopy() {
                        var copyText = document.getElementById("myInputCopy");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        navigator.clipboard.writeText(copyText.value);
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
            if(isset($ghaph_values_two)){
                $count_all_value = '';
                $all_value_two = '';
                $all_value_two = json_decode($ghaph_values_two);
                if($all_value_two){
                    $count_all_value = count($all_value_two);
                    for($i=0; $i < $count_all_value; $i++) {
                        if($all_value_two[$i] == "") {
                            echo "null";
                        }
                        else{
                            echo "ok";
                        }
                    }
                }
                
            }
        ?>
    <script>
        const labels = <?php if($ghaph_name_type == "line"){echo "''";}else{echo $bar_name;}?>;
        const data = {
            labels: <?php if($ghaph_name_type == "line"){
                if(isset($ghaph_line_label)){
                    echo $ghaph_line_label;
            //     $counts_label = 0;
            //     echo "[";
            //     // for($i=0; $i < $count_line_label; $i++){
            //     //     echo '"'.$counts_label +=10;
            //     //     echo '"';
            //     //     echo ",";
            //     // }
            //    echo "'June'";
            //     echo "]";
            }}else{echo "labels";}?>,
            datasets: [
                <?php 
                    if($ghaph_name_type == "line"){
                     
                        if(isset($ghaph_value_one)){
                            echo "{";
                            echo "data:$ghaph_value_one,";
                            echo "borderColor: '$new_bg_color1',";
                            echo "backgroundColor: '$new_bg_color1',";
                            echo "fill: false";
                            echo "},";
                        }
                        if(isset($ghaph_values_two)){
                            $count_all_value = '';
                            $all_value_two = '';
                            $all_value_two = json_decode($ghaph_values_two);
                            $count_all_value = count($all_value_two);
                            $is_true = true;
                            for($i=0; $i < $count_all_value; $i++) {
                                if($all_value_two[$i] == "") {
                                    $is_true = false;
                                }
                                else{
                                    $is_true = true;
                                }
                            }
                            if($is_true){
                                echo "{";
                                echo "data:$ghaph_values_two,";
                                echo "borderColor: '$new_bg_color2',";
                                echo "backgroundColor:'$new_bg_color2',";
                                echo "fill: false";
                                echo "},";
                            }
                        }
                        if(isset( $ghaph_values_three)){

                            $count_all_value_three = '';
                            $all_value_three = '';
                            $all_value_three = json_decode($ghaph_values_three);
                            $count_all_value_three = count($all_value_three);
                            $is_true = true;
                            for($i=0; $i < $count_all_value_three; $i++) {
                                if($all_value_three[$i] == "") {
                                    $is_true = false;
                                }
                                else{
                                    $is_true = true;
                                }
                            }
                            if($is_true ){
                                echo "{";
                                echo "data:$ghaph_values_three,";
                                echo "borderColor: '$new_bg_color3',";
                                echo "backgroundColor:'$new_bg_color3',";
                                echo "fill: false";
                                echo "}";
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
                    ctx.drawImage(logo, (ctx.canvas.offsetWidth - 300), (ctx.canvas.offsetHeight - 300), 200, 200);
                }
            }
        }
        var delayed;
        const config = {
            type: '<?php echo $ghaph_name_type;?>',
            data: data,
            options: {
                animations: {
                    tension: {
                        duration: 3000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                }
                <?php  
                    // $ghaph_name_type = "bar";
                    if($ghaph_name_type == "bar"){
                        echo ",scales:{";
                        echo " x:{";
                        echo " stacked: true,";
                        echo " title: {";
                        echo "display: true, text: $horizontal_title, padding: {top: 30}, font: {size: 18},";
                        echo " },"; 
                        echo "},";
                        echo "y:{";
                        echo " stacked: true,";
                        echo " title: {";
                        echo "display: true, text: $vertical_title, padding: {right: 45,}, font: {size: 18},";
                        echo " },";   
                        echo "},";
                        echo " }";
                    }
                 
                ?>,
                plugins: {
                    legend: {
                        <?php  
                        if($ghaph_name_type == "bar" || $ghaph_name_type == "line"){
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
                            bottom: 15,
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
