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
            <!-- <div class="copy-link" style="margin-top:50px;  padding-bottom:50px;">
                <input type="text" id="copy_url" style="padding: 10px 15px; width: 240px;">
                <a>copy link</a>
                <script type="text/javascript"> 
                    document.getElementById("copy_url").value = window.location.href;
                </script>
            </div> -->
            <!-- <iframe src=""></iframe> -->
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = <?php echo $bar_name; ?>;
        const data = {
            labels: labels,
            datasets: [{
            backgroundColor: <?php echo $bar_color; ?>,
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $bar_value; ?>,
            }]
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
            type: 'bar',
            data: data,
            options: {
                animations: {
                    tension: {
                        duration: 30000,
                        easing: 'easeInOutCubic',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales:{
                    x:{
                        title: {
                            display: true,
                            text: <?php echo $horizontal_title;?>,
                            padding: {
                                top: 30,
                            },
                            font: {
                                size: 18
                            }
                        },
                    },
                    y:{
                        title: {
                            display: true,
                            text: <?php echo $vertical_title;?>,
                            padding: {
                                right: 45,
                            },
                            font: {
                                size: 18
                            }
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false
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
