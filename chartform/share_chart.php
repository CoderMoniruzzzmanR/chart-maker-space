<?php
require '../database/db.php';
$get_id ='';
if(isset($_GET['id'])){
    $get_id = $_GET['id'];
}
$select_chart_db = " SELECT * FROM chart";
$result = mysqli_query($db_conection, $select_chart_db);
$get_user_sesion_id ='';
$get_user_id ='';
foreach ($result as $value) {
    if($value['user_id'] == $get_id){
        $get_user_id = $value['id'];
    }
}
if(isset($get_user_id)){
    $select_db = "SELECT * FROM chart WHERE id = $get_user_id";
    $result = mysqli_query($db_conection,  $select_db);
    if($result){
        $after_assoc = mysqli_fetch_assoc($result);
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
        $horizontal_title =  $after_assoc['horizontal_title'];
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
    if(isset( $after_assoc['user_id'])){
        $user_id =  $after_assoc['user_id'];
    }
    if(isset( $after_assoc['water_image'])){
        $water_image =  $after_assoc['water_image'];
        if( $water_image !==NULL){
            $image_path="../uploads/".$water_image;
        }
       
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
        $count_line_label = count(json_decode($ghaph_value_one));
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
        $dataCount = count($bg_color_line);
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css"></link>
    <title>Document</title>
</head>
<body>

    <div class="main">
        <main class="content-share">
            <div class="preview-chart-share" style="border-top: 5px solid #33CC66; background-color: #ebfaf0;">
                <canvas id="myChart"></canvas>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = <?php if($ghaph_name_type == "line"){echo "''";}else{echo $bar_name;}?>;
        const data = {
            labels: <?php if($ghaph_name_type == "line"){
                if(isset($ghaph_line_label)){
                echo $ghaph_line_label;
            }}else{echo "labels";}?>,
            datasets: [<?php 
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

                            
                            echo "{";
                            echo "data:$ghaph_values_two,";
                            echo "borderColor: '$new_bg_color2',";
                            echo "backgroundColor:'$new_bg_color2',";
                            echo "fill: false";
                            echo "},";
                        }
                        if(isset( $ghaph_values_three)){
                            echo "{";
                            echo "data:$ghaph_values_three,";
                            echo "borderColor: '$new_bg_color3',";
                            echo "backgroundColor:'$new_bg_color3',";
                            echo "fill: false";
                            echo "}";
                        }
                    } 
                    else{
                        echo "{backgroundColor: $bar_color,borderColor:  $bar_color,data: $bar_value,}";
                    }
                ?>,
            ]
        };
        const logo = new Image();
        logo.src = '<?php if(isset($image_path)){echo $image_path;}else{echo ' ';} ?>';
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
        const config = {
            type: '<?php echo $ghaph_name_type;?>',
            data: data,
            options: {
                animations: {
                    tension: {
                        duration: 3000,
                        easing: 'easeInOutCubic',
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

    </script>
        
</body>
</html>
