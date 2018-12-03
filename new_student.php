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
    $name=$_POST['student'];
    $card_id=$_POST['card'];
    $css=(string)$card_id;
    $phone=$_POST['tel'];
    $addres=$_POST['address'];
    $coldg=$_POST['faculty'];
    $year=$_POST['level'];
//    $feild1 = $_POST['feild'];
          if(!empty($_POST["feild"])) {
            $query1="SELECT `id`FROM `student` WHERE card_id='$css'";
              $res_1 = mysqli_query($connection, $query1);
             if (mysqli_num_rows($res_1) > 0) {
                 $flagid=mysqli_fetch_assoc($res_1);
                 $x=$flagid['id'];
                 $query2="SELECT `student_id`,`flag` FROM `student_field` WHERE student_id='$x' and flag=1";
                 $res_2 = mysqli_query($connection, $query2);
                 if(mysqli_num_rows($res_2) > 0){
                    $mass="هذا الطالب قام بالتسجيل من قبل لايمكن تسجيله مره اخرى";
                     echo "<script type ='text/javascript'>alert('$mass');</script>"; 
                 }else{
                     $querya="SELECT `id`FROM `student` WHERE card_id='$css'";
              $res_a = mysqli_query($connection, $querya);
                     $flagid=mysqli_fetch_assoc($res_a);
                 $x=$flagid['id'];
                     
//                     $N = count($feild1);
                        foreach($_POST['feild'] as $feild1)
                        {
                           $query3="INSERT INTO `student_field`( `student_id`, `field_name`, `flag`) VALUES ($x,'$feild1',1)";
                            $res_3 = mysqli_query($connection, $query3);
                        }
                     
                      $mass="لقد تم تسجيل الطالب بنجاح";
                     echo "<script type ='text/javascript'>alert('$mass');</script>";
                 }
             }else{
                 $query4="INSERT INTO `student`(`name`, `card_id`, `Faculty`, `level`, `phone`, `address`) VALUES ('$name','$css','$coldg','$year',$phone,'$addres')";
                 $res_4 = mysqli_query($connection, $query4);
                 $query5="SELECT `id` FROM `student` WHERE card_id='$css'";
              $res_5 = mysqli_query($connection, $query1);
                  $flagid=mysqli_fetch_assoc($res_5);
                 $x=$flagid['id'];
                    // $N = count($feild1);
                        foreach($_POST["feild"] as $feild1)
                        {
                           
                          $query6="INSERT INTO `student_field`( `student_id`, `field_name`, `flag`) VALUES ($x,'$feild1',1)";
                            $res_6 = mysqli_query($connection, $query6);
                        }
                  $mass="لقد تم تسجيل الطالب بنجاح";
                     echo "<script type ='text/javascript'>alert('$mass');</script>";
             }
            
          }else{
               $mass="لم تقم بادخال المجال يجب اختيار على الاقل مجال واحد";
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
                                  <a class="dropdown-item" href="new_activity1.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item" href="serche_activity.php">البحث عن مسابقه</a>
                         </div>
                              </li>

                              <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      الطلاب
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item active" href="new_student.php">تسجيل طالب </a>
                                      <a class="dropdown-item" href="serche_student.php">البحث عن بيانات طالب</a>
                                  </div>
                                  </li>
                                  <li class="nav-item ">
                                        <a class="nav-link" href="result1.php">تسجيل النتيجه</a>
                                      </li>
                      <li class="nav-item ">
                      <a class="nav-link" href="main1.php">القائمه الرئيسيه</a>
                    </li>
                    
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="new_student.php" method="post">
                         
                       <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                      </form>
                    </div>
                  </nav>
    <div class="container">
      
            <div class="form-content">
            <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="new_student.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="student_name"> اسم الطالب </label>
                            <input type="text" placeholder="اسم الطالب رباعى" class="form-control" id="student_name" name="student" required onkeyup="lettersOnly(this)">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="card_id">رقم البطاقه</label>
                            <input type="number" placeholder="14 رقم" class="form-control" id="card_id" min="10000000000000" max="99999999999999" name="card" required onkeyup="lettersOnly2(this)">
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="phone">رقم الهاتف</label>
                            <input type="tel" placeholder="مثل 01000000000" class="form-control" id="phone" name="tel" required onkeyup="lettersOnly2(this)">
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
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                    <label for="checkbox">اختر المجالات المفضله لك!</label>
                            </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="شعر عامى">شعر عامى
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="شعر فصيح">شعر فصيح
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="روايه">روايه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="قصه قصيره">قصه قصيره
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="تاليف مسرحى">تاليف مسرحى
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="مقال">مقال
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="مراسل">مراسل
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="مجلات حائط">مجلات حائط
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="مجله مطبوعه">مجله مطبوعه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="قرأن كريم">قرأن كريم
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="ثقافه اسلاميه">ثقافه اسلاميه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="اربعون نوويه">اربعون نوويه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="دينيه">دينيه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="مناسبات وطنيه">مناسبات وطنيه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="توعيه وتثقيف">توعيه وتثقيف
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild[]" value="تقديم مواهب">تقديم مواهب
                            </label>
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