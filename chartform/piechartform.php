<?php
session_start();
if(isset($_GET['type'])){
    $_SESSION['bar_type'] = $_GET['type'];
}
if(isset($_GET['type_name'])){
    $_SESSION['chart_type'] = $_GET['type_name'];
}
$get_type_status ='';
$get_chart_type = '';

if(isset($_SESSION['bar_type'])){
    $get_type_status =  $_SESSION['bar_type'];
}
if(isset($_SESSION['chart_type'])){
    $get_chart_type = $_SESSION['chart_type'];
}

$title_err = $sub_title_err = NULL;
$flag = true;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST["title"])) {
        if(strlen($_POST['title']) > 100){
            $title_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_title'] = $_POST['title'];
        }
    }
    else{
        $_SESSION['bar_title'] = $_POST['title'];
    }
    if (!empty($_POST["sub_title"])) {
        if(strlen($_POST['sub_title']) > 100){
            $sub_title_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_sub_title'] = $_POST['sub_title'];
        }
    }
    else{
        $_SESSION['bar_sub_title'] = $_POST['sub_title'];
    }
   
    if($flag) {
        echo "ok";
        header('location:post_data_piechart.php');
    }
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

            <!-- //post_data_barchart.php -->
            <div class="content-wrap">
                <form action="<?php echo $_SERVER['PHP_SELF'] ;?>?type=<?php echo $get_type_status;?>&&type_name=<?php echo $get_chart_type;?>" class="form" method="POST">
                    <div class="left-content">
                        <div class="chart-image">
                            <?php  
                                if(isset($get_chart_type)){
                                    if($get_chart_type == "pie" || $get_chart_type == "doughnut" || $get_chart_type == "polarArea"){
                                        if(isset($get_type_status)){
                                            if($get_type_status == 1){
                                                echo '<img src="../src/image/pie1.png"/>';
                                            }
                                            elseif($get_type_status == 2){
                                                echo '<img src="../src/image/pie2.png"/>';
                                            }
                                            elseif($get_type_status == 3){
                                                echo '<img src="../src/image/pie3.png"/>';
                                            }
                                            else{
                                                echo 'Image load error';
                                            }
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class="right-content">
                        <div class="content-main">
                            <div class="form-item">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="<?php
                                if(isset( $_SESSION['bar_title'])){
                                    print_r($_SESSION['bar_title']);
                                }?>"/>
                                <?php
                                if(isset($title_err)){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $title_err;
                                    echo '</span>';
                                }?>
                            </div>
                            <div class="form-item">
                                <label>Sub Title</label>
                                <input type="text" name="sub_title" class="form-control"
                                value="<?php
                                if(isset( $_SESSION['bar_sub_title'])){
                                    print_r($_SESSION['bar_sub_title']);
                                }
                                ?>"/>

                                <?php
                                if(isset($sub_title_err)){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $sub_title_err;
                                    echo '</span>';
                                }?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="button-group">
                        <?php  
                            $base_url="http://".$_SERVER['SERVER_NAME'];
                            echo '<a href="../" class="btn">back</a>';
                        ?>
                        
                        <input type="submit" name="next" class="btn" value="next"/>
                    </div>
                </form>
            </div>
        </main>
    </div>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>
</html>
