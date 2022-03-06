<?php
session_start();
require '../database/db.php';
$get_type_status ='';
$get_chart_type = '';

// if(isset( $_SESSION['u_id'])){
//     $sql = "SELECT * FROM chart where user_id = '". $_SESSION['u_id']."' "; 
//     $result = mysqli_query($db_conection, $sql);
//     if($result){
//         $after_assoc = mysqli_fetch_assoc($result);
//         $new_valm = json_decode($after_assoc['line_label']);
//         $valm_lenth = '';
//         $valm_lenth = count($new_valm);
//         $my_gl = '';
//         if($_SESSION['u_id']){
//             for($i =0; $i< $valm_lenth; $i++){
//                 echo "<pre>";
//                 print_r($_SESSION['line_value'][$i] = $new_valm[$i][0]);
//                 echo "</pre>";
    
//                 echo "<pre>";
//                 print_r( $_SESSION['line_bars'][$i] = $new_valm[$i][1]);
//                 echo "</pre>";
    
//                 echo "<pre>";
//                 print_r($_SESSION['line_bg'][$i] = $new_valm[$i][2]);
//                 echo "</pre>";
    
//             }
//         }
//         echo  $my_gl;
//     }
// }

$lin_counts = '';
if(isset($_SESSION['line_bars'])){
    $lin_counts = count($_SESSION['line_bars']);
}

if(!empty($_SESSION['line_value'])){
    for($i =0; $i< $lin_counts; $i++){
        $to='';
        if(isset($_SESSION['line_value'][$i])){
            $to = count($_SESSION['line_value'][0]);
        }
        if(empty($_SESSION['line_value'][$i])){
            $valy = array();
            for($j=0; $j< $to; $j++){
                $valy[] .= ' ';
            }
            $_SESSION['line_value'][$i] = $valy;
        }
    }
}

// if(!empty($_SESSION['line_value'])){
//     // echo "<pre>";
//     // print_r($_SESSION['line_value']);
//     // echo "</pre>";
// }

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

// print_r($_SESSION['line_bars']);
$flag = true;
$_SESSION['line_ara'] = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['bg_color'])){
        $_SESSION['line_bg'] = $_POST['bg_color'];
    }
    if(isset($_POST['bg_color'])){
        $_SESSION['line_bg'] = $_POST['bg_color'];
    }
    $et = ''; 
    for($i =0; $i<$lin_counts; $i++){
        if(empty($_POST['line_value'.($i+1).''])){
            $et = "please input value";
        }
        else{
            $_SESSION['line_value'][$i] = $_POST['line_value'.($i+1).''];
            for($j=0; $j<count($_POST['line_value'.($i+1).'']); $j++){
                if(!empty($_POST['line_value'.($i+1).''][$j])){

                    echo "<pre>";
                    print_r($_POST['line_value'.($i+1).''][$j]);
                    echo "</pre>";
                    $flag = true;
                }
                else{
                    $et = "Please input value";
                    $flag = false;
                }
            }
        }
    }
    echo $et;
    if($flag){
        for($i =0; $i<$lin_counts; $i++){
            $_SESSION['line_ara'][$i] = array($_SESSION['line_value'][$i],$_SESSION['line_bars'][$i],$_SESSION['line_bg'][$i]);
        }
        header('location:download.php');
    }
    // echo "<pre>";
    // print_r( $_SESSION['line_ara']);
    // echo "</pre>";
}




// // if(isset($_SESSION['line_bars'])){
// //    echo count($_SESSION['line_bars']);
// // }



// if(isset($_SESSION['line_bars'])){
// $len_s = count($_SESSION['line_bars']);
//     for($i =0; $i<$len_s; $i++){
//         // echo "<pre>";
//         if(!isset($_SESSION['line_bg'][$i])){
//             $leg = 6;
//             $randomletter = substr(str_shuffle("123478965abcd123478965ef123478965123478965"), 0, $leg);
//             $_SESSION['line_bg'][$i]="#".$randomletter;
//         }
//         $to='';
//         if(isset($_SESSION['line_value'][$i])){
//             $to = count($_SESSION['line_value'][0]);
//         }
//         if(empty($_SESSION['line_value'][$i])){
//             $valy = array();
//             // echo $to;
//             for($j=0; $j<$to; $j++){
//                 $valy[] .= 'null';
//             }
//             $_SESSION['line_value'][$i] = $valy;
//         }
//         else{
//            $_SESSION['line_ara'][$i] = array($_SESSION['line_value'][$i] ,$_SESSION['line_bars'][$i], $_SESSION['line_bg'][$i]);
           
//             // header('location:post_data_linechart.php');
//         }
        
//     }
// }

// $bar_er = $value_er = $color_er= Null;
// $flag = true;

// $_SESSION['line_ara'] = array();
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $flag = true;
//     if(isset($_SESSION['line_bars'])){
//         $len_s = count($_SESSION['line_bars']);
//         for($i =0; $i<$len_s; $i++){
//             if(isset($_POST['line_value'.($i+1).''])){
//                 $er = '';
//                 foreach ($_POST['line_value'.($i+1).''] as $key => $value) {
//                     if(empty($value)){
//                         $er = "Values can't be fill up";
//                         $flag = false;
//                         $_SESSION['line_ara'][$i] = $_POST['line_value'.($i+1).''];
//                     }
//                     else{
//                         $_SESSION['line_ara'][$i] = $_POST['line_value'.($i+1).''];
//                     }
//                 }
//                 // if($flag){
//                     echo "<pre>";
//                     $_SESSION['line_ara'][$i] = array($_SESSION['line_value'][$i] = $_POST['line_value'.($i+1).''],$_SESSION['line_bars'][$i],$_SESSION['line_bg'][$i]=$_POST['bg_color'][$i]);
//                     echo "</pre>";
//                     if($_SESSION['line_value'][$i] !== ''){
//                         foreach ($_SESSION['line_value'][$i] as $key => $value) {
//                             if($value == null){
//                                 $er = "Values can't be fill up";
//                                 $flag = false;
//                             }
//                             else{
//                                if($flag == true){
//                                     header('location:download.php');
//                                }
//                             }
//                         }
//                     }
                   
//                 // }
//             }
//             else{
//                 $bar_er = "Please enter values";
//             }
//         }
//     }

// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/style.css"></link>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
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
                    <div class="form-wrap w-100" style="max-width:100%;">
                        <?php
                            if(isset($et)){
                                echo '<span id="errorRe" style="color:red; padding-bottom:10px;">';
                                echo $et;
                                echo '</span>';
                            }
                        ?>
                        <div class="form-fields" style="max-width:100%;">

                            <div class="form-row row2" style="padding-left: 0px;">
                                <?php
                                    for($i=0; $i < $lin_counts; $i++){
                                        echo '<div class="content-main" style="width:85px;">';
                                        echo "<label>value".($i+1)."</label>";
                                        //start color
                                        echo '<div style="display:flex;">';
                                            if(isset($_SESSION['line_bg'])){
                                                echo '<input type="color" name="bg_color[]" class="form-control color" value="'.$_SESSION['line_bg'][$i].'">';
                                            }
                                            else{
                                                $leg = 6;
                                                $randomletter = substr(str_shuffle("123478965abcd123478965ef123478965123478965"), 0, $leg);
                                                echo '<input type="color" name="bg_color[]" class="form-control color" value="#'.$randomletter.'">';
                                            }

                                        echo '</div>';
                                        //end
                                        echo '</div>';
                                    }
                                ?>
                                <?php 
                                    // echo $lin_counts;
                               
                                $wec_r = $wec_c= '';   
                                if(!empty($_SESSION['line_value'][0])){
                                    $wec_r = count($_SESSION['line_value'][0]);
                                    if(isset($lin_counts)){
                                        $wec_c= $lin_counts;
                                    }
                                }
                                if(!empty($_SESSION['line_value'])){
                                    // echo $wec_r;
                                    // echo $wec_c;
                                    for ($row = 0; $row < $wec_r; $row++) {  
                                        echo '<div class="content-main" style="width:100%; display:flex;" id="inputFormRow">';
                                        for ($col = 0; $col < $wec_c; $col++) {
                                            echo '<div class="form-item" style="width:85px;">';
                                                echo'<input type="number" name="line_value'.($col+1).'[]" class="form-input-bar numbers" value="'.$_SESSION['line_value'][$col][$row].'">';
                                            echo '</div>';
                                           
                                        }
                                        if($row >0){
                                            echo '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 6px; line-height: 10px;height: 30px;">remove</button>';
                                        }
                                        echo '</div>';
                                    }
                                }
                                else{
                                    echo '<div class="content-main" style="width:100%; display:flex;">'; 

                                    for($i=0; $i < $lin_counts; $i++){
                                        echo '<div class="form-item" style="width:85px;">';

                                        echo'<input type="number" name="line_value'.($i+1).'[]" class="form-input-bar numbers">';

                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                               
                                ?>
                            </div>
                           
                            <div class="form-row row2" id="newRow" style="padding-left: 0px;"></div>
                            <div class="form-row" style="padding-left: 0px;">
                                <div>
                                    <input type="number" name="col_number" id="row_number" class="form-input-bar number"> 

                                    <input type="hidden" name="row_number" id="col_number" class="form-input-bar number" value="<?php if(isset($_SESSION['line_bars'])){echo count($_SESSION['line_bars']);}?>"> 

                                    <button id="addRowMore" type="button" class="add-more-btn" onclick="getInputValue();">+ Add Row More</button>
                                    <script>
                                        function getInputValue(){
                                            var inputValCol = document.getElementById("col_number").value;
                                            var inputVal = document.getElementById("row_number").value;

                                            var html = '';

                                            for(var j = 0; j < inputVal; j++) {
                                                html += '<div class="content-main" style="width:100%; display:flex;" id="inputFormRow">';

                                                for(var i = 0; i < inputValCol; i++) {
                                                    html += '<div class="form-item" id="inrow'+i+'" style="width:85px;">';
                                                    html += '<input type="number" name="line_value'+(i+1)+'[]" class="form-input-bar numbers" >'; 
                                                    html += '</div>';
                                                    //
                                                }
                                                
                                                html += '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 6px; line-height: 10px;height: 30px;">remove</button></div>';
                                            }

                                            document.getElementById("newRow").innerHTML += html;

                                            document.getElementById("row_number").value = '';
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
 
    <script type="text/javascript">
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
            
        });
       
      
    </script>

    <?php
        // if(isset( $_SESSION['value_one'])){
        //     foreach($_SESSION['value_one'] as $z=>$value){
        //         if($z>0){
        //             echo '<script type="text/javascript">';
        //             echo ' function removData'.$z.'(){';

        //             echo 'var barInputId'.$z.' = document.getElementById("inputBarName'.$z.'");';

        //             echo 'var valueInputId'.$z.' = document.getElementById("valueInputTwoBar'.$z.'");';

        //             echo 'var valueInputTwoId'.$z.' = document.getElementById("valueInputBar'.$z.'");';

        //             echo 'var valueInputThreeId'.$z.' = document.getElementById("valueInputThreeBar'.$z.'");';

        //             echo 'var btnRInputId'.$z.' = document.getElementById("removData'.$z.'");';

        //             echo 'barInputId'.$z.'.remove();';
        //             echo 'valueInputId'.$z.'.remove();';
        //             echo 'valueInputTwoId'.$z.'.remove();';
        //             echo 'valueInputThreeId'.$z.'.remove();';
        //             echo 'barInputId'.$z.'.remove();';
        //             echo 'btnRInputId'.$z.'.remove();';

        //             echo '}';

        //             echo '</script>';
        //             echo "<br>";
        //         }
        //     }
        // }
    ?>








</body>
</html>