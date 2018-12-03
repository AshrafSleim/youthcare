<?php session_start()?>
<?php require_once("redirection.php");?>
<?php  
$user=$_SESSION['name'];
$pass=$_SESSION['password'];
$flag1=$_SESSION['flag1'];
$flag2=$_SESSION['department1'];
$flag3=$_SESSION['id1'];
?>
<?php
 if (isset($_POST['button1'])) {
    session_unset();
    session_destroy();
    redirect("index.php");
    header('Cache-Control: no cache');
    exit();
    }

?>
<?php $host="localhost";
$dbusername="root";
$dbpassword="123456";
$dbname="youthcare";
$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
$conn->set_charset("utf8");
if(mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
} ?>
<?php


if(isset($_POST['save'])){
    
$name=filter_input(INPUT_POST, 'name');
$card_id=filter_input(INPUT_POST, 'card_id');

$tel=filter_input(INPUT_POST, 'tel');
$address=filter_input(INPUT_POST, 'address');
$faculty2=$_POST['ashraf'];   
$faculty=$_POST['faculty'];
$level=filter_input(INPUT_POST, 'level');
$cost=filter_input(INPUT_POST, 'cost');
$year=filter_input(INPUT_POST, 'year');
    
    
    
        $query="SELECT `id` FROM `student` WHERE card_id='$card_id'";
        $res=mysqli_query($conn,$query);
if(mysqli_num_rows($res) > 0){
            $query1="SELECT `id`, `type` FROM `student` WHERE card_id='$card_id'";
            $res1=mysqli_query($conn,$query1);
        if(mysqli_num_rows($res1) > 0){
            $final1=mysqli_fetch_assoc($res1);
            $id=$final1['id'];
            $query2="SELECT `budget`, `school_year` FROM `student_social` WHERE Studentid='$id' AND school_year='$year'";
            $res2=mysqli_query($conn,$query2);
            if(mysqli_num_rows($res2) > 0){
                    $mes="هذا الطالب قام بالتسجيل مره قبل ذلك";
                    echo "<script type='text/javascript'>alert('$mes');</script>";
                }else{
                        $id=$final1['id'];
                        $query3= "INSERT INTO `student_social`(`Studentid`, `budget`, `school_year`) VALUES ('$id','$cost','$year') ";
                    $res3=mysqli_query($conn,$query3);

    
                    }
            }else{
            $query4="SELECT `id` FROM `student` WHERE card_id='$card_id'";
            $res4=mysqli_query($conn,$query4);
            if(mysqli_num_rows($res4) > 0){
                $query5="INSERT INTO `student`(`type`) VALUES ('$faculty2') ";
                $res5=mysqli_query($conn,$query5);
                    $query6="INSERT INTO `student_social`(`Studentid`, `budget`, `school_year`) VALUES ('$id','$cost','$year')";
                $res6=mysqli_query($conn,$query6);
   }
    
    
}
}else{
   
   $query7= "INSERT INTO `student`( `name`, `card_id`, `Faculty`, `level`, `phone`, `address`,`type`) VALUES ('$name','$card_id','$faculty','$level',$tel,'$address','$faculty2')";
    $res7=mysqli_query($conn,$query7); 
    $query8="SELECT `id` FROM `student` WHERE card_id='$card_id'";
    $res8=mysqli_query($conn,$query8);
    $final8=mysqli_fetch_assoc($res8);
    $id=$final8['id']; 
     $query9="INSERT INTO `student_social`(`Studentid`, `budget`, `school_year`) VALUES (' $id','$cost','$year')";
       $res9=mysqli_query($conn,$query9);
     $message="لقد تم حفظ البيانات بنجاح";
    echo "<script type='text/javascript'>alert('$message');</script>";
  
}

    
    
    
}

?>






<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>تسجيل طالب جديد</title>
</head>

<body class="main">

 <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top" style="background:#00376d ; " >
                <button class="navbar-toggler text-white"   type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                      </button>  
                      <img src="images/a.jpg" alt="logo" >
               
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">

                        <li class="nav-item active">
                                <a class="nav-link" href="new_student3.php"> تسجيل طالب جديد</a>
                              </li>
                              <li class="nav-item ">
                                    <a class="nav-link" href="cost.php"> حساب ميزانيه</a>
                                  </li>
                
                                  <li class="nav-item ">
                                        <a class="nav-link" href="serche_student3.php">البحث عن بيانات طالب</a>
                                      </li>
                      <li class="nav-item ">
                      <a class="nav-link" href="main3.php">القائمه الرئيسيه</a>
                    </li>
                    
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" method="post"  action="new_student3.php">
                     
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

        
    <div class="container">
        
            <div class="form-content">
                    <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form method="post"  action="new_student3.php" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="name"> اسم الطالب </label>
                            <input type="text"   name="name" placeholder="اسم الطالب رباعى" class="form-control" id="student_name"  min="10000000000000" max="99999999999999" required onkeyup="lettersOnly(this)">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="card_id">رقم البطاقه</label>
                            <input type="number" name="card_id" placeholder="14 رقم" class="form-control" id="card_id" min="10000000000000" max="99999999999999" onkeyup="lettersOnly2(this)">
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="typeaaa">النوع</label>
                            <select name="ashraf" id="typeaaa" class="form-control" required>
                                    <option disabled selected value="">اختر النوع.....</option>
                                    <option value="ذكر">ذكر</option>
                                    <option value="انثى">انثى</option>
                                   
                                </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="tel" name="tel" placeholder="مثل 01000000000" class="form-control" id="phone"  required onkeyup="lettersOnly2(this)">
                            </div>
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                              
                            </div>
                        </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="address"> العنوان </label>
                            <input type="text"  name="address"placeholder="اكتب العنوان كاملا" class="form-control" id="address" placeholder="المكان" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="faculty">الكليه</label>
                            <select name="faculty" id="faculty" class="form-control" required>
                                <option disabled selected value="">اختر الكليه.....</option>
                                <option value="كلية الحاسبات">كلية الحاسبات</option>
                                <option value="كليه الهندسه">كليه الهندسه</option>
                                <option value="كليه العلوم">كليه العلوم</option>
                                <option value="كليه طب بشرى">كليه طب بشرى</option>
                                <option value="كليه طب اسنان">كليه طب اسنان</option>
                                <option value="كليه طب بيطرى">كليه طب بيطرى</option>
                                <option value="كليه صيدله">كليه صيدله</option>
                                <option value="كليه اداب">كليه اداب</option>
                                <option value="كليه تربيه">كليه تربيه</option>
                                <option value="كليه السياحه">كليه السياحه</option>
                                <option value="كليه تجاره">كليه تجاره</option>
                                <option value="كليه التمريض">كليه التمريض</option>
                                <option value="كليه الزراعه">كليه الزراعه</option>
                                
                            </select>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="level">الفرقه</label>
                            <select name="level" id="level" class="form-control" required>
                                <option disabled selected value="">اختر الفرقه.....</option>
                                <option value="اعدادى">اعدادى</option>
                                <option value="الاولى">الاولى</option>
                                <option value="التانيه">التانيه</option>
                                <option value="الثالثه">الثالثه</option>
                                <option value="الرابعه">الرابعه</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="cost">المبلغ</label>
                                    <input type="number" name="cost"  class="form-control" id="cost"min="0"  required onkeyup="lettersOnly2(this)">
                            </div>
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="year">العام الدراسى

                                    </label>
                                    <input type="number" name="year" class="form-control" id="year"min="1990" required onkeyup="lettersOnly2(this)">
                            </div>
                        </div>
                    
                        <div class="form-row justify-content-center mt-5"  >
                            <button class="btn btn-info mx-2" type="submit" name="save">حفظ </button>
                            <button class="btn btn-info mx-2" type="reset" value="reset">الغاء</button>
                            
                        </div>

                </form>
            </div>
        </div>
    </div>

<script>
function lettersOnly(input) {
    var regex = /[^أ-ىa-zءي]/g;
    input.value = input.value.replace(regex, "");
}
    function lettersOnly2(input) {
    var regex = /[^0-9]/g;
    input.value = input.value.replace(regex, "");
}
</script>


    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    </body>
</html>