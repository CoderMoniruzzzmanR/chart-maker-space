<?php
session_start();


if(isset($_SESSION['bar_type'])){
    echo"<br>";
    echo $_SESSION['bar_type'];
}

if(isset($_SESSION['chart_type'])){
    echo"<br>";
   echo $_SESSION['chart_type'];
   echo"<br>";
}


if(isset($_POST['next'])){
    $_SESSION['bar_title'] = $_POST['title'];
    $_SESSION['bar_sub_title'] = $_POST['sub_title'];
    $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
    $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label'];
    if(!empty($_POST['bar_label'])){
        $_SESSION['bar_label'] = $_POST['bar_label'];
    }
}



print_r($_SESSION['bar_title']);
echo"<br>";
print_r($_SESSION['bar_sub_title']);
echo"<br>";
print_r($_SESSION['bar_vertical_label']);
echo"<br>";
print_r($_SESSION['bar_horizontal_label']);

echo"<pre>";
print_r(array_values($_SESSION['bar_label']));
echo"</pre>";


if(isset($_POST['nexttwo'])){
    if(!empty($_POST['bar']) && !empty($_POST['value'])&&!empty($_POST['color'])
    ){
        $_SESSION['bars'] = $_POST['bar'];
        $_SESSION['values'] = $_POST['value'];
        $_SESSION['colors'] = $_POST['color'];
    }
  
    if(isset($_SESSION['bars'])){
        echo"<pre>";
        print_r($_SESSION['bars']);
        $values_array = $_SESSION['values'];
        $res = json_encode($values_array);
        echo"</pre>";
    }

    if(isset($_SESSION['values'])){
        echo"<pre>";
        print_r($_SESSION['values']);
        echo"</pre>";
        $values_array = $_SESSION['values'];
        $res = json_encode($values_array);
    }
    if(isset($_SESSION['colors'])){
        echo"<pre>";
        print_r($_SESSION['colors']);
        $colors_array = $_SESSION['colors'];
        $res_color = json_encode($colors_array);
        echo"</pre>";
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
            
            <div class="preview-chart">
                <canvas id="myChart"></canvas>
            </div>
            
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];

        const data = {
            labels: labels,
            datasets: [{
            label: 'My First dataset',
            backgroundColor: <?php echo $res_color; ?>,
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $res; ?>,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                animations: {
                    tension: {
                        duration: 800,
                        easing: 'easeInOutCubic',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        
    </script>
        
</body>
</html>
