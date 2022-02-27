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
                        <div class="form-fields">
                            <div class="form-row row2">
                            <?php
                                // if(isset( $_SESSION['bars'])){
                                //         function mybar($mybar){
                                //             echo $mybar;
                                //         }
                                //         foreach ($_SESSION['bars'] as $x=>$bar){
                                //            mybar($bar);   
                                //         }
                                //     }
                                ?>
                            </div>
                            <div class="form-row row2">
                                <div  class="in-row">
                                    <div class="inner-row">
                                    <div class="add-more ">
                                    <div>
                                        <label>Bar</label>
                                    </div>
                                    <div class="form-item m-2">
                                        <?php
                                         if(isset( $_SESSION['bars'])){
                                            foreach ($_SESSION['bars'] as $x=>$bar){
                                                // echo $x;
                                                $b_id ='';
                                                $b_text = '';
                                                if($x>0){
                                                    $b_id = $x;
                                                    $b_text = 'id="inputBarName'.$b_id.'"';
                                                }
                                                echo'<input '.$b_text.'type="text" name="bar[]" class="form-control m-input" placeholder="Enter bar" autocomplete="off" value="'.$bar.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="text" name="bar[]" class="form-control m-input" placeholder="Enter bar" autocomplete="off">';
                                        }
                                        ?>
                                        <?php
                                        if(isset($bar_er)){
                                            echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                            echo $bar_er;
                                            echo '</span>';
                                        }?>
                                        <!-- <input type="text" name="bar[]" class="form-control m-input" placeholder="Enter title" autocomplete="off"> -->
                                    </div>
                                </div>
                                <div class="content-main">
                                    <div>
                                        <label>value</label>
                                    </div>
                                    <div class="form-item m-2">
                                        <?php
                                         if(isset( $_SESSION['values'])){
                                            foreach ($_SESSION['values'] as $y=>$value){
                                                $v_id ='';
                                                $v_text = '';
                                                if($y>0){
                                                    $v_id = $y;
                                                    $v_text = 'id="valueInputBar'.$v_id.'"';
                                                }
                                                echo'<input '.$v_text.' type="number" name="value[]" class="form-control m-input" placeholder="Enter value" autocomplete="off" value="'.$value.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="value[]" class="form-control m-input" placeholder="Enter value" autocomplete="off">';
                                        }
                                        ?>
                                         <?php
                                        if(isset($value_er)){
                                            echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                            echo $value_er;
                                            echo '</span>';
                                        }?>
                                    </div>
                                </div>
                                <div class="content-main">
                                    <div>
                                        <label>color</label>
                                    </div>
                                    <div class="form-item">
                                        <?php
                                            if(isset( $_SESSION['colors'])){
                                                foreach ($_SESSION['colors'] as $z=>$color){
                                                    $c_id ='';
                                                    $c_text = '';
                                                    if($x>0){
                                                        $c_id = $z;
                                                        $c_text = 'id="inputBarColor'.$c_id.'"';
                                                    }
                                                    echo '<div style="display:flex; width:150px;">';
                                                    echo'<input '.$c_text.' type="color" name="color[]" class="form-control color" value="'.$color.'">';
                                                    if($z>0){
                                                        echo '<a href="javascript:void(0)" class="btn" id="removData'.$z.'" style="display:inline-block;font-size:14px; padding:0px 15px; margin: 5px; line-height: 30px;
                                                        height: 30px;" onClick="removData'.$z.'()">Remove</a>';
                                                    }
                                                    echo '</div>';
                                                }
                                            }
                                            else{
                                                echo '<div style="display:flex; width:150px;">';
                                                echo '<input type="color" name="color[]" class="form-control color">';
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                
                                <div class="delete">
                                  <?php
                                    // if(isset( $_SESSION['values'])&&isset( $_SESSION['bars'])){
                                    //     foreach ($_SESSION['values'] as $y=>$value){}
                                    //     echo '<button class="btn" style="margin-left: 15px;">remove</button>';
                                    // }
                                        
                                    ?>
                                  
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
                                                    
                                                    html +='<div class="add-more"><div class="form-item"><input type="text" name="bar[]" class="form-control m-input" placeholder="Enter bar" autocomplete="off"></div> </div>';

                                                    html += '<div class="content-main"> <div class="form-item"><input type="number" placeholder="Enter value" name="value[]" class="form-control"/></div></div>';
                                                  
                                                    html += '<div class="content-main">';

                                                    html += '<div class="form-item">';
                                                    html += '<div style="display:flex; width:150px;">';

                                                    html += '<input type="color" name="color[]" class="form-control color"/>';
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
                                <div id="newRow"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-group">
                        <?php  
                            $base_url="http://".$_SERVER['SERVER_NAME'];
                            echo '<a href="'.$base_url.'/chart-maker-Spec/chartform/barchartmake.php" class="btn">back</a>';
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

