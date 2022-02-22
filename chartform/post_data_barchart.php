<?php
session_start();

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

if(isset($_SESSION['bar_type'])){
    echo $_SESSION['bar_type'];
}

if(isset($_SESSION['chart_type'])){
   echo $_SESSION['chart_type'];
}


if(isset($_POST['next'])){
    $_SESSION['bar_title'] = $_POST['title'];
    $_SESSION['bar_sub_title'] = $_POST['sub_title'];
    $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
    $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label'];
    if(!empty($_POST['bar_label'])){
        $_SESSION['bar_label'] = $_POST['bar_label'];
    }
    //$bar_label = array("june", "july", "August");
    // // $value = array($bar_label, "my_data");
    // $_SESSION['bar_label'] = $bar_label;
    // print_r();
    

}

// $_SESSION['bar_title'] = $_POST['title'];
// $_SESSION['bar_sub_title'] = $_POST['sub_title'];
// $_SESSION['bar_vertical_label'] = $_POST['vertical_label'];
// $_SESSION['bar_horizontal_label'] = $_POST['horizontal_label'];
// if(!empty($_POST['bar_label'])){
//     $_SESSION['bar_label'] = $_POST['bar_label'];
// }

print_r($_SESSION['bar_title']);
echo"<br>";
print_r($_SESSION['bar_sub_title']);
echo"<br>";
print_r($_SESSION['bar_vertical_label']);
echo"<br>";
print_r($_SESSION['bar_horizontal_label']);

echo"<pre>";
print_r(array_values($_SESSION['bar_label']));
echo"</pre>";

  



if(isset($_POST['nexttwo'])){
    if(!empty($_POST['bar']) && !empty($_POST['value'])&&!empty($_POST['color'])
    ){
        $_SESSION['bars'] = $_POST['bar'];
        $_SESSION['values'] = $_POST['value'];
        $_SESSION['colors'] = $_POST['color'];
    }
  
    if(isset($_SESSION['bars'])){
        echo"<pre>";
        print_r($_SESSION['bars']);
        echo"</pre>";
    }
    if(isset($_SESSION['values'])){
        echo"<pre>";
        print_r($_SESSION['values']);
        echo"</pre>";
    }
    if(isset($_SESSION['colors'])){
        echo"<pre>";
        print_r($_SESSION['colors']);
        echo"</pre>";
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
                <form action="download.php" class="form" method="POST">
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
                                    </div>
                                    <div class="form-item m-2">
                                        <?php
                                         if(isset( $_SESSION['bars'])){
                                            foreach ($_SESSION['bars'] as $bar){
                                                echo'<input type="text" name="bar[]" class="form-control m-input" placeholder="Enter title" autocomplete="off" value="'.$bar.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="text" name="bar[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';

                                        }
                                        ?>
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
                                            foreach ($_SESSION['values'] as $value){
                                                echo'<input type="number" name="value[]" class="form-control m-input" placeholder="Enter title" autocomplete="off" value="'.$value.'">';
                                            }
                                        }
                                        else{
                                            echo '<input type="number" name="value[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
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
                                        <!-- <input type="color" name="color[]" class="form-control" value="<?php
                                            // if(isset( $_SESSION['colors'])){
                                            //     foreach ($_SESSION['colors'] as $color){
                                            //         echo $color;
                                            //     }
                                            // }?>"
                                        /> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-row" id="newRow"></div>

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

