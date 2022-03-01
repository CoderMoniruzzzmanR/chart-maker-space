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
    if($_POST['line_label']){
        for($i=0; $i < count($_POST['line_label']); $i++) {
            if($_POST['line_label'][$i] == "") {
                $bar_er = "Please enter label";
                $flag = false;
                $_SESSION['barsl'] = $_POST['line_label'];
            }
            else{
                $_SESSION['barsl'] = $_POST['line_label'];
                $bar_status = true;
            }
        }
    }

    if($_POST['value_one']){
        for($i=0; $i < count($_POST['value_one']); $i++) {
            if($_POST['value_one'][$i] == "") {
                $value_er = "*";
                $flag = false;
                $_SESSION['value_one'] = $_POST['value_one'];
            }
            else{
                $_SESSION['value_one'] = $_POST['value_one'];
                $value_status = true;
            }
        }
    }

    if($_POST['values_two']){
        for($i=0; $i < count($_POST['values_two']); $i++) {
            if($_POST['values_two'][$i] == "") {
                $_SESSION['values_two'] = $_POST['values_two'];
                $value_status = true;
            }
            else{
                $_SESSION['values_two'] = $_POST['values_two'];
                $value_status = true;
            }
        }
    }

    if($_POST['values_three']){
        for($i=0; $i < count($_POST['values_three']); $i++) {
            if($_POST['values_three'][$i] == "") {
                $_SESSION['values_three'] = $_POST['values_three'];
                $value_status = true;
            }
            else{
                $_SESSION['values_three'] = $_POST['values_three'];
                $value_status = true;
            }
        }
    }
    
    if($_POST['bg_color']){
        for($i=0; $i < count($_POST['bg_color']); $i++) {
            if($_POST['bg_color'][$i] == "") {
                echo $color_er = "Please select color";
                $flag = false;
            }
            else{
                $_SESSION['bg_color'] = $_POST['bg_color'];
            }
        }
    }
    if ($flag) {
        header('location:download.php');
    }
}
 if(isset( $_SESSION['bg_color'])){
    $dataCount = count($_SESSION['bg_color']);
    $new_bg_color1 =  $new_bg_color1 =  $new_bg_color1 = '';
    for ($i=0; $i < $dataCount; $i++) {
        $new_bg_color1 = $_SESSION['bg_color'][0];
        $new_bg_color2 = $_SESSION['bg_color'][1];
        $new_bg_color3 = $_SESSION['bg_color'][2];
    }
    $new_bg_color1;
    $new_bg_color2;
    $new_bg_color3;
    
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
                                        echo '<img src="../src/image/line1.png"/>';
                                    }
                                    elseif($get_chart == 2){
                                        echo '<img src="../src/image/line2.png"/>';
                                    }
                                    elseif($get_chart == 3){
                                        echo '<img src="../src/image/line3.png"/>';
                                    }
                                    else{
                                        echo 'Image load error';
                                    }
                                }
                            ?>
                        </div>
                        <div class="form-fields">
                            <div class="form-row row2">
                            </div>
                            <div class="form-row row2">
                                <div  class="in-row">
                                    <div class="inner-row">
                                    <div class="add-more ">
                                    <div>
                                        <label>Line Label</label>
                                    </div>
                                    <div class="form-item">
                                        <?php
                                         if(isset( $_SESSION['barsl'])){
                                            foreach ($_SESSION['barsl'] as $x=>$bar){
                                                // echo $x;
                                                $b_id ='';
                                                $b_text = '';
                                                if($x>0){
                                                    $b_id = $x;
                                                    $b_text = 'id="inputBarName'.$b_id.'"';
                                                }
                                                echo'<input '.$b_text.'type="text" name="line_label[]" class="form-control bar-input" placeholder="Enter label name" autocomplete="off" value="'.$bar.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="text" name="line_label[]" class="form-control bar-input" placeholder="Enter label name" autocomplete="off">';
                                        }
                                        ?>
                                        <?php
                                        if(isset($bar_er)){
                                            echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                            echo $bar_er;
                                            echo '</span>';
                                        }?>
                                    </div>
                                </div>
                                <div class="content-main" style="width:85px;">
                                    <label>
                                        value-1
                                        <?php
                                        if(isset($value_er)){
                                            echo '<span style="color:red;">';
                                            echo $value_er;
                                            echo '</span>';
                                        }?>
                                    </label>
                                    <div style="display:flex;">
                                        <input type="color" name="bg_color[]" class="form-control color" value ="<?php if(isset($new_bg_color1)){echo $new_bg_color1;}?>">
                                    </div>
                                    <div class="form-item">
                                        <?php
                                         if(isset( $_SESSION['value_one'])){
                                            foreach ($_SESSION['value_one'] as $y=>$value){
                                                $v_id ='';
                                                $v_text = '';
                                                if($y>0){
                                                    $v_id = $y;
                                                    $v_text = 'id="valueInputBar'.$v_id.'"';
                                                }
                                                echo'<input '.$v_text.' type="number" name="value_one[]" class="form-control value-input" autocomplete="off" value="'.$value.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="value_one[]" class="form-control value-input" autocomplete="off">';
                                        }
                                        ?>
                                         
                                    </div>
                                </div>
                                <div class="content-main" style="width:85px;">
                                    <label>value-2</label>
                                    <div style="display:flex;">
                                        <input type="color" name="bg_color[]" class="form-control color" value ="<?php if(isset($new_bg_color1)){echo $new_bg_color2;}?>">
                                    </div>
                                    <div class="form-item">
                                        <?php
                                         if(isset( $_SESSION['values_two'])){
                                            foreach ($_SESSION['values_two'] as $y=>$value){
                                                $v_id ='';
                                                $v_text = '';
                                                if($y>0){
                                                    $v_id = $y;
                                                    $v_text = 'id="valueInputTwoBar'.$v_id.'"';
                                                }
                                                echo'<input '.$v_text.' type="number" name="values_two[]" class="form-control value-input" autocomplete="off" value="'.$value.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="values_two[]" class="form-control value-input" autocomplete="off">';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="content-main" >
                                    <label>value-3</label>
                                    <div style="display:flex; width:150px;">
                                        <input type="color" name="bg_color[]" class="form-control color" value ="<?php if(isset($new_bg_color1)){echo $new_bg_color3;}?>">
                                    </div>
                                    <div class="form-item">
                                        <?php
                                         if(isset( $_SESSION['values_three'])){
                                            foreach ($_SESSION['values_three'] as $y=>$value){
                                                $v_id ='';
                                                $v_text = '';
                                                if($y>0){
                                                    $v_id = $y;
                                                    $v_text = 'id="valueInputThreeBar'.$v_id.'"';
                                                }
                                                echo '<div style="display:flex; width:150px;">';
                                                echo'<input '.$v_text.' type="number" name="values_three[]" class="form-control value-input" autocomplete="off" value="'.$value.'">';
                                                if($y>0){
                                                    echo '<a href="javascript:void(0)" class="btn" id="removData'.$y.'" style="display:inline-block;font-size:14px; padding:0px 15px; margin: 5px; line-height: 30px;
                                                    height: 30px;" onClick="removData'.$y.'()">Remove</a>';
                                                }
                                                echo '</div>';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="values_three[]" class="form-control value-input" autocomplete="off">';
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                               
                                
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row2" id="newRow"></div>
                            <div class="form-row">
                               
                                <div>
                                    <input type="number" name="row_number" id="row_number" class="form-control m-input"> 
                                    <button id="addRowMore" type="button" class="btn btn-trans btn-left" onclick="getInputValue();">+ Add Row More</button>
                                    <script>
                                        function getInputValue(){
                                            var inputVal = document.getElementById("row_number").value;
                                            if(inputVal !== ''){
                                                var html = '';
                                                for (let i = 0; i < inputVal; i++) {
                                                    html += '<div class="in-row" id="inputFormRow">';
                                                    html += '<div class="inner-row">';
                                                    
                                                    html +='<div class="add-more"><div class="form-item"><input type="text" name="line_label[]" class="form-control m-input" placeholder="Enter label" autocomplete="off"></div> </div>';

                                                    html += '<div class="content-main" style="width:85px;"> <div class="form-item"><input type="number" name="value_one[]" class="form-control value-input"/></div></div>';

                                                    html += '<div class="content-main" style="width:85px;"> <div class="form-item"><input type="number" name="values_two[]" class="form-control value-input"/></div></div>';
                                                  
                                                    html += '<div class="content-main">';

                                                    html += '<div class="form-item">';
                                                    html += '<div style="display:flex; width:150px;">';

                                                    html += '<input type="number" name="values_three[]" class="form-control value-input"/>';
                                                    html += '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 5px; line-height: 10px;height: 30px;">Remove</button>';
                                                    html += '</div>';

                                                    html += '</div>';
                                                    html += '</div>';
                                                    html += '</div>';
                                                    html += '</div>';

                                                }
                                                document.getElementById("newRow").innerHTML = html;
                                                
                                                document.getElementById("row_number").value = '';
                                            }
                                        }
                                    </script>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="button-group">
                        <?php  
                            $base_url="http://".$_SERVER['SERVER_NAME'];
                            echo '<a href="../chartform/linechartform.php" class="btn">back</a>';
                        ?>
                        
                        <input type="submit" class="btn" name="nexttwo" value="next">
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

    <?php
        if(isset( $_SESSION['value_one'])){
            foreach($_SESSION['value_one'] as $z=>$value){
                if($z>0){
                    echo '<script type="text/javascript">';
                    echo ' function removData'.$z.'(){';

                    echo 'var barInputId'.$z.' = document.getElementById("inputBarName'.$z.'");';

                    echo 'var valueInputId'.$z.' = document.getElementById("valueInputTwoBar'.$z.'");';

                    echo 'var valueInputTwoId'.$z.' = document.getElementById("valueInputBar'.$z.'");';

                    echo 'var valueInputThreeId'.$z.' = document.getElementById("valueInputThreeBar'.$z.'");';

                    echo 'var btnRInputId'.$z.' = document.getElementById("removData'.$z.'");';

                    echo 'barInputId'.$z.'.remove();';
                    echo 'valueInputId'.$z.'.remove();';
                    echo 'valueInputTwoId'.$z.'.remove();';
                    echo 'valueInputThreeId'.$z.'.remove();';
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