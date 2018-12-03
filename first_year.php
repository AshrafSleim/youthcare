<?php session_start()?>
<?php require_once("redirection.php");?>
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
if (isset($_POST['logout'])) {
    redirect("index.php");
    
    }
?>
<?php 
$feild= array();
$feild2= array();
$feild3= array();

if (isset($_POST['save'])){
    $name=$_POST['student'];
    $card_id=$_POST['card'];
    $css=(string)$card_id;
    $phone=$_POST['tel'];
    $addres=$_POST['address'];
    $coldg=$_POST['faculty'];
    $year=$_POST['level'];
    //$feild1 = $_POST['feild'];
    //$feild12 = $_POST['feild2'];
   // $feild13 = $_POST['feild3'];
            $query1="SELECT `id`FROM `student` WHERE card_id='$css'";
              $res_1 = mysqli_query($connection, $query1);
              if (mysqli_num_rows($res_1) > 0) {
                   $mass="هذا الطالب قام بالتسجيل من قبل لايمكن تسجيله مره اخرى";
                     echo "<script type ='text/javascript'>alert('$mass');</script>";
              }elseif(!empty($_POST["feild"]) || !empty($_POST["feild2"]) || !empty($_POST["feild3"])) {
                
                    if(!empty($_POST["feild"])){
                 $query4="INSERT INTO `student`(`name`, `card_id`, `Faculty`, `level`, `phone`, `address`) VALUES ('$name','$css','$coldg','$year',$phone,'$addres')";
                 $res_4 = mysqli_query($connection, $query4);
                 $query5="SELECT `id` FROM `student` WHERE card_id='$css'";
              $res_5 = mysqli_query($connection, $query1);
                  $flagid=mysqli_fetch_assoc($res_5);
                 $x=$flagid['id'];
                    // $N = count($feild1);
                        foreach($_POST["feild"] as $feild20)
                        {
                           
                          $query6="INSERT INTO `student_field`( `student_id`, `field_name`, `flag`) VALUES ($x,'$feild20',1)";
                            $res_6 = mysqli_query($connection, $query6);
                        }
                 
             }
                    if(!empty($_POST["feild2"])){
                  $querya="SELECT `id`FROM `student` WHERE card_id='$css'";
              $res_a = mysqli_query($connection, $querya);
             if (mysqli_num_rows($res_a) > 0) {
                  $flagid=mysqli_fetch_assoc($res_a);
                 $x=$flagid['id'];
                        foreach($_POST["feild2"] as $feild21)
                        {
                           $query3="INSERT INTO `student_field`( `student_id`, `field_name`, `flag`) VALUES ($x,'$feild21',2)";
                            $res_3 = mysqli_query($connection, $query3);
                        }
                
             }else{
                 $query4="INSERT INTO `student`(`name`, `card_id`, `Faculty`, `level`, `phone`, `address`) VALUES ('$name','$css','$coldg','$year',$phone,'$addres')";
                 $res_4 = mysqli_query($connection, $query4);
                 $query5="SELECT `id` FROM `student` WHERE card_id='$css'";
              $res_5 = mysqli_query($connection, $query1);
                  $flagid=mysqli_fetch_assoc($res_5);
                 $x=$flagid['id'];
                    
                        foreach($_POST["feild2"] as $feild21)
                        {
                           
                          $query6="INSERT INTO `student_field`( `student_id`, `field_name`, `flag`) VALUES ($x,'$feild21',2)";
                            $res_6 = mysqli_query($connection, $query6);
                        }
                 
             }
              }
                    if(!empty($_POST["feild3"])){
                      $query1="SELECT `id` , `flag` FROM `student` WHERE card_id='$css'";
     $res_1 = mysqli_query($connection, $query1);
    if (mysqli_num_rows($res_1) > 0) {
        $flagid=mysqli_fetch_assoc($res_1);
        $id1=$flagid['id'];
        $flag1=$flagid['flag'];
        if($flag1==0){
            $query2="UPDATE `student` SET `flag`= '1' WHERE id='$id1'";
            $res_2 = mysqli_query($connection, $query2);
          
        }
       
     }else{
        $query3="INSERT INTO `student`(`name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `flag`) VALUES ('$name','$css','$coldg','$year',$phone,'$addres',1)";
        $res_3 = mysqli_query($connection, $query3);
          
    }
                  }
                //  window.print();
                  $mass="لقد تم التسجيل بنجاح";
             echo "<script type ='text/javascript'>alert('$mass');</script>";
           
                
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

        <header class="container-fluid py-2 justify-content-middle">
        <div class="row text-center" >
           <div class="col-md-3"> <img src="images/a.jpg" alt="logo" ></div>
          <div class="col-md-6"> <h2 align="center"class="pt-3 pb-2" >تسجيل طالب جديد</h2></div>
         
          
            <div class="col-md-3" >   <form class="form-inline my-2 my-lg-0 mx-5" action="first_year.php" method="post">
                                      
              <button class="btn btn-info my-2 px-4 mr-sm-4 " type="submit" name="logout" >خروج
                </button>
              </form></div>
          
           
        </div>
              
             </header>

    <div class="container">
      
        <div class="tab-content form-content">
            <div class="tab-pane active  px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="first_year.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                             <label> برجاء قبل الضغط على التسجيل اضغط على زر الطباعه اولا</label>
                        </div>
                    </div>
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
                                <hr/>
                        
                                  <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="غناء">غناء
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="عزف">عزف
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="انشاد دينى">انشاد دينى
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="فنون شعبيه">فنون شعبيه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="فنون تشكيليه">فنون تشكيليه
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" name="feild2[]" value="مسرح">مسرح
                              </label>
                                    <hr/>
                             <label class="checkbox-inline">
                              <input type="checkbox" name="feild3[]" value="جواله">جواله
                                            </label>
                            </div>
                    </div>
                    
                        <div class="form-row justify-content-center mt-5 my-2"  >
                            <button class="btn btn-info mx-2" type="button" onClick="window.print()">طباعه
                </button>
                            <button class="btn btn-info mx-2" type="submit" name="save">تسجيل</button>
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