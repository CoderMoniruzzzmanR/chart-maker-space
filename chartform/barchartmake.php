<?php
session_start();
if(isset($_GET['type'])){
    $_SESSION['bar_type'] = $_GET['type'];
}

if(isset($_GET['type_name'])){
    $_SESSION['chart_type'] = $_GET['type_name'];
}

// if(isset($_POST['next'])){

//     if(empty($_POST['title']) && empty($_POST['bar_label'])){
//         header('location:barchartmake.php?mess=hi');
//     }
//     else{
//         $_SESSION['bar_title'] = $_POST['title'];
//         $_SESSION['bar_sub_title'] = $_POST['sub_title'];
//         $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
//         $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label']; 
//         $_SESSION['bar_label'] = $_POST['bar_label'];   
//     }
   
//     //$bar_label = array("june", "july", "August");
//     // // $value = array($bar_label, "my_data");
//     // $_SESSION['bar_label'] = $bar_label;
//     // print_r();
    

// }
// print_r($_SESSION['bar_type']);
// print_r($_SESSION['chart_type']);

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
                if(isset($_SESSION['bar_type'])){
                    $chart_id = $_SESSION['bar_type'];
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
            ?>
            <!-- //post_data_barchart.php -->
            <div class="content-wrap">
                <form action="post_data_barchart.php" class="form" method="POST">
                    <div class="left-content">
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
                    </div>
                    
                    <input type="hidden" name="type" class="form-control" value="<?php if(isset($get_chart)){echo $get_chart;}?>"/>

                    <div class="right-content">
                        <div class="content-main">
                            <div class="form-item">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="<?php
                                if(isset( $_SESSION['bar_title'])){
                                    print_r($_SESSION['bar_title']);
                                }?>"/>


                                <?php
                                if(isset( $_GET['title_err'])){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $_GET['title_err'];
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
                                if(isset( $_GET['sub_title_err'])){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $_GET['sub_title_err'];
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
                                if(isset( $_GET['vertical_label_err'])){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $_GET['vertical_label_err'];
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
                                if(isset( $_GET['horizontal_label_err'])){
                                    echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                    echo $_GET['horizontal_label_err'];
                                    echo '</span>';
                                }?>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <?php 
                            if(isset($_SESSION['bar_label'])){
                                $count =1;
                                foreach ($_SESSION['bar_label'] as $bar_label){
                                    echo' <div class="form-item">';
                                    echo'<label>Bar '. $count++ .' label</label>';
                                    echo '<input type="text" name="bar_label[]" class="form-control m-input"';
                                    if(isset($bar_label)){
                                        echo 'value="'.$bar_label.'"';
                                    }
                                    echo '>';
                                    //print $bar_label;
                                    echo'</div>';
                                }
                            }
                            else{
                                echo '<div class="form-item">';
                                echo"<label>Bar 1 label</label>";
                                echo' <input type="text" name="bar_label[]" class="form-control m-input">';
                                echo '</div>';
                            }
                            if(isset($_GET['bar_label_er'])){
                                echo '<span style="color:red; padding-bottom:10px; display:block;">';
                                echo $_GET['bar_label_er'];
                                echo '</span>';
                            }
                        ?>
                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-trans">+ Add More Bars</button>
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
        var count = 2;
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html +='<label id="counter">Bar '+ count +' label</label>';
            html += '<input type="text" name="bar_label[]" class="form-control" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';
            $('#newRow').append(html);
            count++;
        });
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
            count--;
        });
    </script>
</body>
</html>
