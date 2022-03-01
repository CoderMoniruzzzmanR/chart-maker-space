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
    if($chart_id == 1){
        $get_chart = $chart_id;
    }
    elseif($chart_id == 2){
        $get_chart = $chart_id;
    }
    elseif($chart_id == 3){
        $get_chart = $chart_id;
    }
}
$bar_er = $value_er = $color_er= Null;
$flag = true;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bar_status = $value_status = Null;
    if($_POST['bar']){
        for($i=0; $i < count($_POST['bar']); $i++) {
            if($_POST['bar'][$i] == "") {
                $bar_er = "Please enter bar name";
                $flag = false;
                $_SESSION['bars'] = $_POST['bar'];
            }
            else{
                $_SESSION['bars'] = $_POST['bar'];
                $bar_status = true;
            }
        }
    }
    if($_POST['value']){
        for($i=0; $i < count($_POST['value']); $i++) {
            if($_POST['value'][$i] == "") {
                $value_er = "Please enter value";
                $flag = false;
                $_SESSION['values'] = $_POST['value'];
            }
            else{
                $_SESSION['values'] = $_POST['value'];
                $value_status = true;
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
                        <div class="content-md">
                            <div class="form-row">
                                <div class="form-item" style="margin-right: 30px; width: 220px;">
                                    <label>Bar
                                        <?php
                                            if(isset($bar_er)){
                                                echo '<span id="errorRe" style="color:red; padding-bottom:10px;">';
                                                echo "*";
                                                echo '</span>';
                                            }
                                        ?>
                                    </label>
                                </div>
                                <div class="form-item" style="width:230px; margin-right: 30px;">
                                    <label>Value
                                        <?php
                                            if(isset($value_er)){
                                                echo '<span id="errorRe" style="color:red; padding-bottom:10px;">';
                                                echo "*";
                                                echo '</span>';
                                            }
                                        ?>
                                    </label>
                                </div>
                                <div class="form-item" style="margin-left: 30px; width: 200px;">
                                    <label>color</label>
                                </div>
                            </div>
                                <?php  
                                    if(isset( $_SESSION['bars']) || isset($_SESSION['value']) || isset($_SESSION['colors'])){
                                        foreach ($_SESSION['bars'] as $x=>$bar){
                                            $id_st = '';
                                            if($x>0){
                                                $id_st = "inputFormRow";
                                            }
                                            echo '<div class="form-row" id="'.$id_st.'">';
                                                echo '<div class="form-item" style="margin-right: 30px; width: 220px;">';
                                                    echo '<input type="text" name="bar[]" class="form-control" value="'.$_SESSION['bars'][$x].'"/>';
                                                echo '</div>';

                                                echo '<div class="form-item" style="width:230px; margin-right: 30px;">';
                                                    if(isset($_SESSION['values'])){
                                                        echo '<input type="number" name="value[]" class="form-input-bar number" value="'.$_SESSION['values'][$x].'"/>';
                                                    }
                                                    else{
                                                        echo '<input type="number" name="value[]" class="form-input-bar number"/>';
                                                    }
                                                    
                                                echo '</div>';

                                                echo '<div class="form-item" style="margin-left: 30px; width: 200px; display:flex;">';
                                                    if(isset($_SESSION['colors'])){
                                                        echo '<input type="color" name="color[]"  class="form-control color" value="'.$_SESSION['colors'][$x].'">';
                                                    }
                                                    else{
                                                        echo '<input type="color" name="color[]"  class="form-control color">';
                                                    }
                                                   

                                                    if($x>0){
                                                        echo '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 5px; line-height: 10px;height: 30px;">Remove</button>';
                                                    }
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                ?>

                            <div id="newRow">

                            </div>
                            <div class="form-row">
                                <input type="number" name="row_number" id="row_number" class="form-input-bar number"> 
                                <button id="addRowMore" type="button" class="add-more-btn" onclick="getInputValue();">+ Add Row More</button>
                            </div>
                                <script>
                                    function getInputValue(){
                                        var inputVal = document.getElementById("row_number").value;
                                        if(inputVal !== ''){
                                        var html = '';
                                        for (let i = 0; i < inputVal; i++) {
                                            html += '<div class="form-row" id="inputFormRow">';
                                            
                                            html +='<div class="form-item" style="margin-right: 30px; width: 220px;">';
                                            html += '<input type="text" name="bar[]" class="form-control"/>';
                                            html += '</div>';
                                            
                                            
                                            html +='<div class="form-item" style="width:230px; margin-right: 30px;">';
                                            html += '<input type="number" name="value[]" class="form-input-bar number"/>';
                                            html += '</div>';

                                            
                                            html +='<div class="form-item" style="display:flex; margin-left: 30px; width: 200px;">';
                                            html += '<input type="color" name="color[]"  class="form-control color"/>';

                                            html += '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 5px; line-height: 10px;height: 30px;">Remove</button>';

                                            html += '</div>';

                                           

                                            html += '</div>';

                                        }
                                        $errRe = document.getElementById("errorRe");
                                        if($errRe){
                                            $errRe .remove();
                                        }
                                        document.getElementById("newRow").innerHTML = html;
                                        
                                        document.getElementById("row_number").value = '';
                                    }
                                }
                            </script>
                        </div>        
                        <div class="form-row" style="display: flex; justify-content:end; width:100%;">
                                <div class="button-group">
                                <?php  
                                    echo '<a href="../chartform/barchartmake.php" class="btn">back</a>';
                                ?>
                                <input type="submit" class="btn" name="nexttwo" value="next">
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
            $errRe = document.getElementById("errorRe");
            if($errRe){
                $errRe .remove();
            }
        });
    </script>

    <?php
        if(isset( $_SESSION['colors'])){
            foreach($_SESSION['colors'] as $z=>$color){
                if($z>0){
                    echo '<script type="text/javascript">';
                    echo ' function removData'.$z.'(){';

                    echo 'var barInputId'.$z.' = document.getElementById("inputBarName'.$z.'");';

                    echo 'var valueInputId'.$z.' = document.getElementById("valueInputBar'.$z.'");';

                    echo 'var ColorInputId'.$z.' = document.getElementById("inputBarColor'.$z.'");';

                    echo 'var btnRInputId'.$z.' = document.getElementById("removData'.$z.'");';

                    echo 'barInputId'.$z.'.remove();';
                    echo 'valueInputId'.$z.'.remove();';
                    echo 'ColorInputId'.$z.'.remove();';
                    echo 'barInputId'.$z.'.remove();';
                    echo 'btnRInputId'.$z.'.remove();';

                    echo '}';

                    echo '</script>';
                    echo "<br>";
                }
            }
        }
    ?>

</body>
</html>

