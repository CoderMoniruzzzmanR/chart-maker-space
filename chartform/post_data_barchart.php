<?php
session_start();

$get_type_status ='';
$get_chart_type = '';

if(isset($_SESSION['bar_type'])){
    $get_type_status =  $_SESSION['bar_type'];
}
if(isset($_SESSION['chart_type'])){
    $get_chart_type = $_SESSION['chart_type'];
}


if(isset($get_type_status)){
    $chart_id = $get_type_status;
    // echo $chart_id;
    if($chart_id == 1){
        $get_chart = $chart_id;
    }
    elseif($chart_id == 2){
        $get_chart = $chart_id;
    }
    elseif($chart_id == 3){
        $get_chart = $chart_id;
    }
    else{
        echo "some thing wrong";
    }
}
else{
    echo "some thing wrong";
}


$bar_er = $value_er = $color_er= Null;
$flag = true;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['bar']){
        for($i=0; $i < count($_POST['bar']); $i++) {
            if($_POST['bar'][$i] == "") {
                echo $bar_er = "Please enter bar name";
                $flag = false;
            }
            else{
                $_SESSION['bars'] = $_POST['bar'];
            }
        }
    }
    if($_POST['value']){
        for($i=0; $i < count($_POST['value']); $i++) {
            if($_POST['value'][$i] == "") {
                echo $value_er = "Please enter value";
                $flag = false;
            }
            else{
                $_SESSION['values'] = $_POST['value'];
            }
        }
    }
    if($_POST['color']){
        for($i=0; $i < count($_POST['color']); $i++) {
            if($_POST['color'][$i] == "") {
                echo $color_er = "Please select color";
                $flag = false;
            }
            else{
                $_SESSION['colors'] = $_POST['color'];
            }
        }
    }
    if ($flag) {
        header('location:download.php');
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
            <div class="content-wrap-full">
            <!-- download.php -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" class="form" method="POST">
                    <div class="form-wrap">
                        <div class="chart-image">
                            <?php  
                                if(isset($get_chart)){
                                    if($get_chart == 1){
                                        echo '<img src="../src/image/barchart1.png"/>';
                                    }
                                    elseif($get_chart == 2){
                                        echo '<img src="../src/image/barchart2.png"/>';
                                    }
                                    elseif($get_chart == 3){
                                        echo '<img src="../src/image/barchart3.png"/>';
                                    }
                                    else{
                                        echo 'Image load error';
                                    }
                                }
                            ?>
                        </div>
                        <div class="form-fields">
                            <div class="form-row">
                                <div class="add-more ">
                                    <div>
                                        <label>Bar</label>
                                        <?php
                                        if(isset($bar_er)){
                                            echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                            echo $bar_er;
                                            echo '</span>';
                                        }?>
                                    </div>
                                    <div class="form-item m-2">
                                        <?php
                                         if(isset( $_SESSION['bars'])){
                                            foreach ($_SESSION['bars'] as $bar){
                                                echo'<input type="text" name="bar[]" class="form-control m-input" placeholder="Enter bar" autocomplete="off" value="'.$bar.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="text" name="bar[]" class="form-control m-input" placeholder="Enter bar" autocomplete="off">';

                                        }
                                        ?>
                                        
                                        <!-- <input type="text" name="bar[]" class="form-control m-input" placeholder="Enter title" autocomplete="off"> -->
                                    </div>
                                </div>

                                <div class="content-main">
                                    <div>
                                        <label>value</label>
                                        <?php
                                        if(isset($value_er)){
                                            echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                            echo $value_er;
                                            echo '</span>';
                                        }?>
                                    </div>
                                    <div class="form-item m-2">
                                        <?php
                                         if(isset( $_SESSION['values'])){
                                            foreach ($_SESSION['values'] as $value){
                                                echo'<input type="number" name="value[]" class="form-control m-input" placeholder="Enter value" autocomplete="off" value="'.$value.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="value[]" class="form-control m-input" placeholder="Enter value" autocomplete="off">';
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="content-main">
                                    <div>
                                        <label>color</label>
                                    </div>
                                    <div class="form-item">
                                        <?php
                                            if(isset( $_SESSION['colors'])){
                                                foreach ($_SESSION['colors'] as $color){
                                                    echo'<input type="color" name="color[]" class="form-control color" value="'.$color.'">';
                                                }
                                            }
                                            else{
                                                echo '<input type="color" name="color[]" class="form-control color">';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row2" id="newRow"></div>

                            <div class="form-row">
                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-trans btn-left">+ Add More</button>
                            </div>
                        </div>
                    </div>
                    <div class="button-group">
                        <a href="javascript:history.go(-1)" class="btn">back</a>
                        <input type="submit" class="btn" name="nexttwo" value="next">
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">


        $("#addRow").click(function () {
            var html = '';
            html += '<div class="in-row" id="inputFormRow">';
            
            html += '<div class="inner-row">';
            
            html +='<div class="add-more"><div class="form-item"><input type="text" name="bar[]" class="form-control m-input" placeholder="Enter title" autocomplete="off"></div> </div>';

            html += '<div class="content-main"> <div class="form-item"><input type="text" name="value[]" class="form-control"/></div></div>';

            html += '<div class="content-main"><div class="form-item"><input type="color" name="color[]" class="form-control color"/></div></div>';
            html += '</div>';

            html += '<div class="input-group-append"><button id="removeRow" type="button" class="btn btn-danger">Remove</button></div>';
    
            html += '</div>';

            $('#newRow').append(html);
        });
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>






</body>
</html>

