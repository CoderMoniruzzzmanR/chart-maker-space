<?php 
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/style.css"></link>
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
            <?php 
                if(isset($_GET['type'])){
                    $chart_id = $_GET['type'];
                    // echo $chart_id;
                    if($chart_id == 1){
                        $get_chart = $chart_id;
                    }
                    // elseif($chart_id == 2){
                    //     $get_chart = $chart_id;
                    // }
                    // elseif($chart_id == 3){
                    //     $get_chart = $chart_id;
                    // }
                    else{
                        echo "some thing wrong";
                    }
                }
                else{
                    echo "some thing wrong";
                }
            ?>
            <div class="content-wrap">
                <form action="" class="form">
                    <div class="left-content">
                        <div class="chart-image">
                            <?php  
                                if(isset($get_chart)){
                                    if($get_chart == 1){
                                        echo '<img src="../src/image/line1.png" />';
                                    }
                                    // elseif($get_chart == 2){
                                    //     echo '<img src="../src/image/barchart2.png"/>';
                                    // }
                                    // elseif($get_chart == 3){
                                    //     echo '<img src="../src/image/barchart3.png"/>';
                                    // }
                                    else{
                                        echo 'Image load error';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="content-main">
                            <div class="form-item">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"/>
                            </div>
                            <div class="form-item">
                                <label>Sub Title</label>
                                <input type="text" class="form-control"
                                name="sub_title"/>
                            </div>
                            <div class="form-item">
                                <label>Vertical label</label>
                                <input type="text" class="form-control"
                                name="vertical_label"/>
                            </div>
                            <div class="form-item">
                                <label>Horizontal label</label>
                                <input type="text" class="form-control"
                                name="horizontal_label"/>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">

                    </div>
                    <div class="button-group">
                        <a href="javascript:history.go(-1)" class="btn">back</a>
                        <button type="submit" class="btn">Next</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>