<?php
session_start();
require '../database/db.php';

if(isset($_GET['type'])){
    $_SESSION['bar_type'] = $_GET['type'];
}
if(isset($_GET['type_name'])){
    $_SESSION['chart_type'] = $_GET['type_name'];
}

if(isset($_GET['u_id'])){
    $_SESSION['u_id'] = $_GET['u_id'];
    unset($_SESSION['line_value']);
    unset($_SESSION['line_bars']);
    unset($_SESSION['line_bg']);
    unset($_SESSION['x_value']);
    $sql = "SELECT * FROM chart where user_id = '". $_SESSION['u_id']."' "; 
    $result = mysqli_query($db_conection, $sql);
    if($result){
        $after_assoc = mysqli_fetch_assoc($result);
        $new_valm = json_decode($after_assoc['line_label']);
        $new_line_x_axis = json_decode($after_assoc['line_x_axis']);
        $valm_lenth = '';
        $valm_lenth = count($new_valm);
        $my_gl = '';
        if( $_SESSION['u_id']){
            // session_destroy();
            for($i =0; $i< $valm_lenth; $i++){
                $_SESSION['line_value'][$i] = $new_valm[$i][0];
                $_SESSION['line_bars'][$i] = $new_valm[$i][1];
                $_SESSION['line_bg'][$i] = $new_valm[$i][2];
            }
            for( $x=0; $x < count($new_line_x_axis); $x++){
               $_SESSION['x_value'][$x] = $new_line_x_axis[$x];
            }
          //   echo "<pre>";
          //   print_r($_SESSION['x_value']);
          //   echo "</pre>";
        }
        

        // echo $valm_lenth;
        // echo  $my_gl;
        // echo "<pre>";
        // print_r( $new_valm);
        // echo "</pre>";
    }

}
// echo "<pre>";
// print_r($_SESSION['line_value']);
// echo "</pre>";

// echo "<pre>";
// print_r($_SESSION['line_bg']);
// echo "</pre>";

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

    if($_POST['bar']){
        for($i=0; $i < count($_POST['bar']); $i++) {
            if($_POST['bar'][$i] == "") {
                $bar_er = "Please enter line";
                $flag = false;
                $_SESSION['line_bars'] = $_POST['bar'];
            }
            else{
                $_SESSION['line_bars'] = $_POST['bar'];
                $flag = true;
            }
        }
    }
  
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

    if (!empty($_POST["vertical_label"])) {
        if(strlen($_POST['vertical_label']) > 100){
            $vertical_label_err = "Max character 100";
            $flag = false;
        }
        else{
            $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
        }
    }
    else{
        $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
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
    else{
        $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label'];
    }
    $h = '';
    if(isset($_SESSION['line_bars'])){
        $h = count($_SESSION['line_bars']);
    }
    if(isset($_SESSION['line_bg'])){
        for($i =0; $i<$h; $i++){
            if(!isset($_SESSION['line_bg'][$i])){
                $leg = 6;
                $randomletter = substr(str_shuffle("123478965abcd123478965ef123478965123478965"), 0, $leg);
                $_SESSION['line_bg'][$i] = "#".$randomletter;
            }   
        }
    }
   
    if(!empty($_SESSION['line_value'])){
        // $flag = false;
        for($i =0; $i< $h; $i++){
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
                // $flag = false;
            }
        }
    }
    
    // if(isset($_SESSION['line_value'])){
    //     echo "<pre>";
    //     print_r( $_SESSION['line_value']);
    //     echo "</pre>";
    // }
    
    if($flag) {
        header('location:post_data_linechart.php');
    }
    
    // if($flag) {
    //     $lenu= '';
    //     $get_previous = '';

    //     if(isset($_SESSION['line_bars'])){
    //         $len_s = count($_SESSION['line_bars']);
    //             for($i =0; $i<$len_s; $i++){
    //                 // echo "<pre>";
    //                 if(!isset($_SESSION['line_bg'][$i])){
    //                     $leg = 6;
    //                     $randomletter = substr(str_shuffle("123478965abcd123478965ef123478965123478965"), 0, $leg);
    //                     $_SESSION['line_bg'][$i]="#".$randomletter;
    //                 }
    //                 $to='';
    //                 if(isset($_SESSION['line_value'][$i])){
    //                    $to = count($_SESSION['line_value'][0]);
    //                 }
    //                 if(empty($_SESSION['line_value'][$i])){
    //                     $valy = array();
    //                     // echo $to;
    //                     for($j=0; $j<$to; $j++){
    //                         $valy[] .= 'null';
    //                     }
    //                    $_SESSION['line_value'][$i] = $valy;
    //                 }
    //                 else{
                       
    //                 }
    //                 $_SESSION['line_ara'][$i] = array($_SESSION['line_value'][$i] ,$_SESSION['line_bars'][$i], $_SESSION['line_bg'][$i]);
    //                 // echo "</pre>";
    //                 header('location:post_data_linechart.php');
                  
    //             }
    //         }
    //     }
        
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
            <div class="content-wrap" style="margin-top: 15px;">
                <form action="<?php echo $_SERVER['PHP_SELF'] ;?>?type=<?php echo $get_type_status;?>&&type_name=<?php echo $get_chart_type;?>" class="form" method="POST">
                    <div class="left-content">
                        <div class="chart-image">
                            <?php  
                                if(isset($get_chart_type)){
                                    if($get_chart_type == "line"){
                                        if(isset($get_type_status)){
                                            if($get_type_status == 1){
                                                echo '<img src="../src/image/line1.png"/>';
                                            }
                                            elseif($get_type_status == 2){
                                                echo '<img src="../src/image/line2.png"/>';
                                            }
                                            elseif($get_type_status == 3){
                                                echo '<img src="../src/image/line3.png"/>';
                                            }
                                            else{
                                                echo 'Image load error';
                                            }
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="content">

                        <div>
                            <label>Label line</label>
                        </div>

                        <?php
                            if(isset( $_SESSION['line_bars'])){
                                foreach ($_SESSION['line_bars'] as $x=>$bar){
                                    // echo $x;
                                    $b_id ='';
                                    $b_text = '';
                                    if($x>0){
                                        $b_id = $x;
                                        $b_text = 'id="inputFormRow"';
                                    }
                                    echo '<div class="form-item" '.$b_text.'>';
                                    echo'<input type="text" name="bar[]" class="form-input-bar" placeholder="Enter line" value="'.$bar.'">';
                                    if($x>0){
                                    echo '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 5px; line-height: 10px;height: 30px;">Remove</button>';
                                    }
                                    echo '</div>';
                                }
                            }
                            else{
                                echo ' <div class="form-item">';
                                echo '<input type="text" name="bar[]" class="form-input-bar" placeholder="Enter line"/>';
                                echo '</div>';
                            }
                        ?>
                        <div id="newRow"></div>
                            <?php
                                if(isset($bar_er)){
                                    echo '<span id="errorRe" style="color:red; padding-bottom:10px; display:block;">';
                                    echo $bar_er;
                                    echo '</span>';
                                }
                            ?>
                        <div>
                            <input type="number" name="row_number" id="row_number" class="form-input-bar number"> 
                            <button id="addRowMore" type="button" class="add-more-btn" onclick="getInputValue();">+ Add Row More</button>
                            <script>
                                function getInputValue(){
                                    var inputVal = document.getElementById("row_number").value;
                                    if(inputVal !== ''){
                                        var html = '';
                                        for (let i = 0; i < inputVal; i++) {
                                            html += ' <div class="form-item" id="inputFormRow">';
                                            
                                            html +='<input type="text" name="bar[]" class="form-input-bar" placeholder="Enter line"/>';

                                            html += '<button id="removeRow" class="btn" style="font-size:14px;padding:0px 12px; margin: 5px; line-height: 10px;height: 30px;">Remove</button>';
                                            html += '</div>';

                                        }
                                        $errRe = document.getElementById("errorRe");
                                        if($errRe){
                                            $errRe .remove();
                                        }
                                       
                                        document.getElementById("newRow").innerHTML += html;
                                        
                                        document.getElementById("row_number").value = '';
                                    }
                                }


                            </script>
                        </div>       

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
    <script type="text/javascript">
        
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
            $errRe = document.getElementById("errorRe");
            if($errRe){
                $errRe .remove();
            }
           
        });
    </script>
</body>
</html>
