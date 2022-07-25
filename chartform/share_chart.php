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

    
    // if(isset( $after_assoc['line_label'])){
    //     $ghaph_line_label =  $after_assoc['line_label'];
    // }

    if(isset($after_assoc['line_label'])){
        $ghaph_line = $after_assoc['line_label'];
        //echo "<pre>";
        // print_r(json_decode($ghaph_line ));
        //echo "</pre>";
        // echo "ok";
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
        const labels = <?php if($ghaph_name_type == "line"){ echo '""';}else {echo $bar_name;}?>;
        const data = {
            labels: <?php if($ghaph_name_type == "line"){
                    if(isset($after_assoc['line_label'])){
                        $ghaph_line = $after_assoc['line_label'];
                        $s = '';
                        $col_size ='';
                        $s = json_decode($ghaph_line);
                        foreach($s as $key=>$val){
                            if($key == 0){
                                foreach($val as $key=>$kal){
                                    if($key == 0){
                                        $col_size = count($kal);
                                    }
                                }
                            }
                        }
                        $counts_label = 0;
                        echo "[";
                        for($i=0; $i < $col_size; $i++){
                            echo '"'.$counts_label +=10;
                            echo '"';
                            echo ",";
                        }
                        echo "]";
                    }
                } else{echo "labels";}?>,
            datasets: [<?php 
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
        logo.src = '<?php if(isset($image_path)){echo $image_path;}else{echo ' ';} ?>';
        const logoImage = {
            id : 'logoImage',
            afterDraw(chart, args, options){
                const {ctx, chartArea:{top, bottom, left, right}} = chart;
                ctx.save();
                if(logo.complete){
                    ctx.drawImage(logo, (ctx.canvas.offsetWidth -100), (ctx.canvas.offsetHeight - 600), 70, 70);
                }
            }
        }
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
                        if($ghaph_name_type == "bar"){
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

        // window.addEventListener('640', () => {
        //     myChart.resize(600, 600);
        // });
    </script>
        
</body>
</html>
