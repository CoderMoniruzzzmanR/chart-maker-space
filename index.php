<?php 
session_start();
session_regenerate_id();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/css/style.css"></link>
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
            <div class="tab-content"> 
                <div class="chart-heading">
                    <h2>Bar Graphs</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <a href="./chartform/barchartmake.php?type=1&&type_name=bar" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/barchart1.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                       Bar chart
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="column">
                        <a href="./chartform/barchartmake.php?type=2&&type_name=bar" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/barchart2.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                        Bar chart render
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="column">
                        <a href="./chartform/barchartmake.php?type=3&&type_name=bar" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/barchart3.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                       3D Bar chart
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chart-heading">
                    <h2>Line Graphs</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <a href="./chartform/linechartform.php?type=1&&type_name=line" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/line1.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                        Column with driildown
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chart-heading">
                    <h2>Gause Graphs</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <a href="./chartform/piechartform.php?type=3&&type_name=pie" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/pie3.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                       pie chart
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="column">
                        <a href="./chartform/piechartform.php?type=1&&type_name=polarArea" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/pie1.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                        polarArea chart
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="column">
                        <a href="./chartform/piechartform.php?type=2&&type_name=doughnut" class="content-wrap">
                            <div class="card">
                                <div class="chart-image">
                                    <img src="./src/image/pie2.png"/>
                                </div>
                                <div class="card-footer">
                                    <h3>
                                        Doughnut Chart
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php 



?>