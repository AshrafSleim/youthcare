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
<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="123456";
$dbname="youthcare";
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$connection->set_charset("utf8");
if(mysqli_connect_errno()){
    die("database not connect".mysqli_connect_error()."(".mysqli_connect_errno().")");
}

?>
<?php 
if (isset($_POST['save'])){
    $name=$_POST['student_name'];
    $card_id1=$_POST['card_id'];
    $css=(string)$card_id1;
    $phone1=$_POST['phone'];
    $addres=$_POST['address'];
    $coldg=$_POST['faculty'];
    $year=$_POST['level'];
    
   $query1="SELECT `id` , `flag` FROM `student` WHERE card_id='$css'";
     $res_1 = mysqli_query($connection, $query1);
    if (mysqli_num_rows($res_1) > 0) {
        $flagid=mysqli_fetch_assoc($res_1);
        $id1=$flagid['id'];
        $flag1=$flagid['flag'];
        if($flag1==0){
            $query2="UPDATE `student` SET `flag`= '1' WHERE id='$id1'";
            $res_2 = mysqli_query($connection, $query2);
            $mass="لقد تم التسجيل بنجاح";
            echo "<script type ='text/javascript'>alert('$mass');</script>";
        }elseif($flag1==1){
             $mass="هذا الطالب قام بالتسجيل من قبل";
            echo "<script type ='text/javascript'>alert('$mass');</script>";
        }
             }else{
        $query3="INSERT INTO `student`(`name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `flag`) VALUES ('$name','$css','$coldg','$year',$phone1,'$addres',1)";
        $res_3 = mysqli_query($connection, $query3);
            $mass="لقد تم التسجيل بنجاح";
            echo "<script type ='text/javascript'>alert('$mass');</script>";
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

                     <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  المسابقات
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item " href="new_activity4.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item " href="serche_activity4.php">البحث عن مسابقه</a>
                         </div>
                              </li>

                              <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      الطلاب
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item active" href="new_student4.php">تسجيل طالب </a>
                                      <a class="dropdown-item" href="serche_student4.php">البحث عن بيانات طالب</a>
                                  </div>
                                  </li>
                                  
                            <li class="nav-item ">
                                <a class="nav-link" href="result4-1.php">ترتيب الكليات</a>
                              </li>
                                  <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      منتخب الجامعه
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item  " href="super_team4.php" > اضافه طالب</a>
                                      <a class="dropdown-item " href="result4-2.php"> عرض منتخب الجامعه </a>
                                  </div>     
                                  </li>
                      <li class="nav-item ">
                      <a class="nav-link" href="main4.php">القائمه الرئيسيه</a>
                    </li>
                    
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" 
action="new_student4.php" method="post">
                    
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

    <div class="container">
      
            <div class="form-content">
            <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="new_student4.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="name"> اسم الطالب </label>
                            <input type="text" placeholder="اسم الطالب رباعى" class="form-control" id="student_name" name="student_name" required onkeyup="lettersOnly(this)">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="card_id">رقم البطاقه</label>
                            <input type="number" placeholder="14 رقم" class="form-control" id="card_id" min="10000000000000" max="99999999999999" name="card_id" required onkeyup="lettersOnly2(this)">
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                          <label for="phone">رقم الهاتف</label>
                                    <input type="tel" placeholder="مثل 01000000000" class="form-control" id="phone" name="phone" required onkeyup="lettersOnly2(this)">
                        </div>
                    </div>
                  
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="address"> العنوان </label>
                            <input type="text" placeholder="اكتب العنوان كاملا" class="form-control" id="address" placeholder="المكان" name="address" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                             <label for="faculty">الكليه</label>
                            <select name="faculty" id="faculty" class="form-control" required >
                                <option disabled selected value="">اختر الكليه.....</option>
                                <option value="كليه الحاسبات">كليه الحاسبات</option>
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
                                <option value="الثانيه">الثانيه</option>
                                <option value="الثالثه">الثالثه</option>
                                <option value="الرابعه">الرابعه</option>
                            </select>
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