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

$title_err = $sub_title_err = $vertical_label_err = $horizontal_label_err  = NULL;
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
    if (!empty($_POST["sub_title"])) {
        if(strlen($_POST['sub_title']) > 100){
            $sub_title_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_sub_title'] = $_POST['sub_title'];
        }
    }
    if (!empty($_POST["vertical_label"])) {
        if(strlen($_POST['vertical_label']) > 100){
            $vertical_label_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
        }
    }
    if (!empty($_POST["horizontal_label"])) {
        if(strlen($_POST['horizontal_label']) > 100){
            $horizontal_label_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label'];
        }
    }
    if($flag) {
        echo "ok";
        header('location:post_data_barchart.php');
    }
}

// echo "<br>";
// echo "<br>";
// echo $get_type_status;
// echo "<br>";
// echo "<br>";
// echo $get_chart_type;


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
                                if(isset($get_type_status)){
                                    if($get_type_status == 1){
                                        echo '<img src="../src/image/barchart1.png"/>';
                                    }
                                    elseif($get_type_status == 2){
                                        echo '<img src="../src/image/barchart2.png"/>';
                                    }
                                    elseif($get_type_status == 3){
                                        echo '<img src="../src/image/barchart3.png"/>';
                                    }
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
                            <div class="form-item">
                                <label>Vertical label</label>
                                <input type="text" name="vertical_label" class="form-control" value="<?php
                                if(isset( $_SESSION['bar_vertical_label'])){
                                    print_r($_SESSION['bar_vertical_label']);
                                }
                                ?>"/>
                                <?php
                                if(isset($vertical_label_err)){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo  $vertical_label_err;
                                    echo '</span>';
                                }?>
                            </div>
                            <div class="form-item">
                                <label>Horizontal label</label>
                                <input type="text" name="horizontal_label" class="form-control" value="<?php
                                if(isset( $_SESSION['bar_horizontal_label'])){
                                    print_r($_SESSION['bar_horizontal_label']);
                                }
                                ?>"/>
                                <?php
                                if(isset($horizontal_label_err)){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $horizontal_label_err;
                                    echo '</span>';
                                }?>
                            </div>
                        </div>
                    </div>
                    <div class="button-group">
                        <a href="javascript:history.go(-1)" class="btn">back</a>
                        <input type="submit" name="next" class="btn" value="next"/>
                    </div>
                </form>
            </div>
        </main>
    </div>

     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        
        
       
        // var count = 2;
        // $("#addRow").click(function () {
        //     var html = '';
        //     html += '<div id="inputFormRow">';
        //     html += '<div class="input-group mb-3">';
        //     html +='<label id="counter">Bar '+ count +' label</label>';
        //     html += '<input type="text" name="bar_label[]" class="form-control" autocomplete="off">';
        //     html += '<div class="input-group-append">';
        //     html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        //     html += '</div>';
        //     html += '</div>';
        //     $('#myDivCout').append(html);
        //     count++;
        // });
        // $(document).on('click', '#removeRow', function () {
        //     $(this).closest('#inputFormRow').remove();
        //     count--;
        // });

        // let numb = document.getElementById("myDivCout").children.length;
        // if(numb !== null){
        //     var count_num = numb;
        //     $(document).on('click', '#removeRowInput', function (event) {
        //         event.preventDefault();
        //         count_num--;
        //         if(count_num >0){
        //             console.log(count_num);
        //             $(this).closest('#inputFormBar').remove();
        //         }
        //         else{
        //             count_num = 1;
        //         }
        //         document.getElementById("demo").innerHTML = count_num;
                
        //     });
        // }
    </script>
</body>
</html>
