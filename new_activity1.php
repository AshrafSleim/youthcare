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
if(isset($_POST['save'])){
$activity1=$_POST['activity'];
$field1=$_POST['field'];
$date1=$_POST['date'];
$excution1=$_POST['excution'];
$kind1=$_POST['kind'];
$adresse1=$_POST['adresse'];
$supervision1=$_POST['supervision'];
$performers1=$_POST['performers'];
$budget1=$_POST['budget'];

$query1="SELECT `id` FROM `activity` WHERE name='$activity1'";    
$res_1 = mysqli_query($connection, $query1);
             if (mysqli_num_rows($res_1) > 0) {
                 $flagid=mysqli_fetch_assoc($res_1);
                 $x=$flagid['id'];
                 $query2="SELECT `id` FROM `fields` WHERE name='$field1' and date='$date1'";
                 $res_2 = mysqli_query($connection, $query2);
                 if (mysqli_num_rows($res_2) > 0){
                       $mass="لقد تم تسجيل هذه المسابقه بنفس التاريخ من قبل برجاء التاكد من البيانات";
                     echo "<script type ='text/javascript'>alert('$mass');</script>";
                 }else{
                    $query3="INSERT INTO `fields`(`name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget`) VALUES ('$field1','$x','$date1','$excution1','$kind1','$adresse1','$supervision1','$performers1',$budget1)"; 
                     $res_3 = mysqli_query($connection, $query3);
                      $query7="SELECT `id` FROM `fields` WHERE name = '$field1' and date = '$date1' ";
                     $res_7 = mysqli_query($connection, $query7);
                     $flagid2=mysqli_fetch_assoc($res_7);
                     $idfield=$flagid2['id'];
                     $query8="SELECT `id` FROM `student_field`WHERE field_name = '$field1' and flag = '1' ";
                     $res_8= mysqli_query($connection, $query8);
                     while($row=mysqli_fetch_assoc($res_8))
                     {
                         $student_field_id=$row['id'];
                         
                         $query9="INSERT INTO `register`(`student_field_id`, `fields_id`, `flag`) VALUES ('$student_field_id','$idfield','1')";
                         $res_3 = mysqli_query($connection, $query9);
                     }
                     
                      $mass="لقد تسجيل بيانات المسابقه بنجاح";
                     echo "<script type ='text/javascript'>alert('$mass');</script>";
                 }
             }else{
                  $query4="INSERT INTO `activity`(`name`) VALUES ('$activity1')";
                  $res_4 = mysqli_query($connection, $query4);
                 $query5="SELECT `id` FROM `activity` WHERE name='$activity1'";    
                 $res_5 = mysqli_query($connection, $query5);
                 $flagid=mysqli_fetch_assoc($res_5);
                 $y=$flagid['id'];
                  $query6="INSERT INTO `fields`(`name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget`) VALUES ('$field1','$y','$date1','$excution1','$kind1','$adresse1','$supervision1','$performers1',$budget1)"; 
                     $res_6 = mysqli_query($connection, $query6);
					  $query7="SELECT `id` FROM `fields` WHERE name = '$field1' and date = '$date1' ";
                 $res_7 = mysqli_query($connection, $query7);
                     $flagid2=mysqli_fetch_assoc($res_7);
                     $idfield=$flagid2['id'];
                     $query8="SELECT `id` FROM `student_field`WHERE field_name = '$field1' and flag = '1' ";
                     $res_8= mysqli_query($connection, $query8);
                     while($row=mysqli_fetch_assoc($res_8))
                     {
                         $student_field_id=$row['id'];
                         
                         $query9="INSERT INTO `register`(`student_field_id`, `fields_id`, `flag`) VALUES ('$student_field_id','$idfield','1')";
                         $res_3 = mysqli_query($connection, $query9);
                     }
                  $mass="لقد تسجيل بيانات المسابقه بنجاح";
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
    <title>تسجيل مسابقة</title>
</head>

<body class="main">
       

        <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top" style="background:#00376d ; " >
                <button class="navbar-toggler text-white"   type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                      </button>  
                      <img src="images/a.jpg" alt="logo" >
               
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">

                     <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  المسابقات
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item active" href="new_activity1.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item" href="serche_activity.php">البحث عن مسابقه</a>
                         </div>
                              </li>

                              <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      الطلاب
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="new_student.php">تسجيل طالب </a>
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
                    <form class="form-inline my-2 my-lg-0 mx-5" action="new_activity1.php" method="post">
                                      
              <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
              </form>
                </div>
              </nav>

             
    <div class="container">
        
        <div class="form-content">
            <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="new_activity1.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="name"> اسم النشاط</label>
                            <select name="activity" id="excution-kind" class="form-control" required >
                                <option disabled selected value="">اختر اسم النشاط.....</option>
                                <option value="مسابقه ادبيه">مسابقه ادبيه</option>
                                <option value="مسابقه اعلاميه">مسابقه اعلاميه</option>
                                <option value="مسابقه دينيه">مسابقه دينيه</option>
                                <option value="دوره تدريبيه">دوره تدريبيه</option>
                                <option value="حفل ثقافى">حفل ثقافى</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="field">المجال</label>
                            <select name="field" id="field" class="form-control" required>
                                <option disabled selected value="">اختر المجال.....</option>
                                <option value="شعر عامى">شعر عامى</option>
                                <option value="شعر فصيح">شعر فصيح</option>
                                <option value="روايه">روايه</option>
                                <option value="قصه قصيره">قصه قصيره</option>
                                <option value="تاليف مسرحى">تاليف مسرحى</option>
                                <option value="مقال">مقال</option>
                                <option value="مراسل">مراسل</option>
                                <option value="مجلات حائط">مجلات حائط</option>
                                <option value="مجله مطبوعه">مجله مطبوعه</option>
                                <option value="قرأن كريم">قرأن كريم</option>
                                <option value="ثقافه اسلاميه">ثقافه اسلاميه</option>
                                <option value="اربعون نوويه">اربعون نوويه</option>
                                <option value="دينيه">دينيه</option>
                                <option value="مناسبات وطنيه">مناسبات وطنيه</option>
                                <option value="توعيه وتثقيف">توعيه وتثقيف</option>
                                <option value="تقديم مواهب">تقديم مواهب</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="date">التاريخ</label>
                            <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date" required name="date">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="excution-field">نطاق التنفيذ</label>
                            <select name="excution" id="excution-field" class="form-control" required>
                                <option disabled selected value="">اختر نطاق.....</option>
                                <option value="داخلى">داخلى</option>
                                <option value="خارجى">خارجى</option>
                                
                            </select>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="excution-kind">نوع التنفيذ</label>
                            <select name="kind" id="excution-kind" class="form-control" required>
                                <option disabled selected value="">اختر نوع.....</option>
                                <option value="مسابق ابداع">مسابق ابداع</option>
                                <option value="اسبوع الشباب">اسبوع الشباب</option>
                                <option value="اسبوع الفتيات">اسبوع الفتيات</option>
                                <option value="مهرجان الاسر">مهرجان الاسر</option>
                                <option value="اخرى">اخرى</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="excution-place">مكان التنفيذ</label>
                            <input type="text" class="form-control" id="excution-place" placeholder="المكان" required name="adresse">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="supervision">الاشراف </label>
                            <input type="text" class="form-control" id="supervision" placeholder="الاشراف" required name="supervision" onkeyup="lettersOnly(this)">
                        </div>
                       
                    </div>
                    <div class="form-row justify-content-center">
                        
                       
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                                <label for="performers">المنفذون</label>
                                <input type="text" class="form-control" id="performers" placeholder="المنفذون" required name="performers" onkeyup="lettersOnly(this)">
    
                            </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                           
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="budget">الميزانية</label>
                                    <input type="number" class="form-control" id="budget" placeholder="الميزانية" name="budget" required onkeyup="lettersOnly2(this)">
        
                                </div>
                        </div>
                        <div class="form-row justify-content-center mt-2"  >
                            <button class="btn btn-info mx-3 my-2" type="submit" name="save">تسجيل</button>
                            <button class="btn btn-info mx-3 my-2" type="reset" value="reset">الغاء</button>
                        </div>

                </form>
            </div>
        </div>
    </div>



<script>
function lettersOnly(input) {
    var regex = /[^أ-ى-a-zءي]/g;
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