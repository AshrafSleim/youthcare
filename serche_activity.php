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
$id1=" ";
$date1=" ";
$name="المجال";
$Activity_name="النشاط";
$date="dd/mm/yyyy";
$execution_area="النطاق";
$execution_type="النوع";
$address="المكان";
$montors="الاشراف";
$execution_members="المنفذون";
$budget="الميزانية";

$required="required";
$hidden="hidden";
$hidden2=" ";
$hidden3="hidden";
$readonly="readonly";
if(isset($_POST['search'])){
    $hidden=" ";
   $ashraf=$_POST['field'];
    $data2=$_POST['date'];
    
       $query1="SELECT `id`, `name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget` FROM `fields` WHERE name = '$ashraf' and date = '$data2'";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
			 $id147=$flagid['Activity_id'];
             $date1=$flagid['date'];
             $name=$flagid['name'];
             
             
             $execution_area=$flagid['execution_area'];
             $execution_type=$flagid['execution_type'];
             $address=$flagid['address'];
             $montors=$flagid['montors'];
             $execution_members=$flagid['execution_members'];
             $budget=$flagid['budget'];
             $query2="SELECT `name` FROM `activity` WHERE id=$id147";
              $res_2=mysqli_query($connection, $query2);
             $flagid2=mysqli_fetch_assoc($res_2);
             $Activity_name= $flagid2['name'];
             $required=" ";
             $hidden2="hidden";
             
         }else{
             $mass="لا يوجد بيانات لهذه المسابقه برجاء التاكد من المجال و التاريخ";
          echo "<script type ='text/javascript'>alert('$mass');</script>"; 
            
         }
    
}elseif(isset($_POST['search2'])){
    $required="required";
    redirect("serche_activity.php");
}elseif(isset($_POST['update'])){
    $readonly=" ";
    $id2=$_POST['id1'];
    $query1="SELECT `id`, `name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget` FROM `fields` WHERE id = '$id2' ";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
			 $id147=$flagid['Activity_id'];
             $date1=$flagid['date'];
             $name=$flagid['name'];
             
             
             $execution_area=$flagid['execution_area'];
             $execution_type=$flagid['execution_type'];
             $address=$flagid['address'];
             $montors=$flagid['montors'];
             $execution_members=$flagid['execution_members'];
             $budget=$flagid['budget'];
             $query2="SELECT `name` FROM `activity` WHERE id=$id147";
              $res_2=mysqli_query($connection, $query2);
             $flagid2=mysqli_fetch_assoc($res_2);
             $Activity_name= $flagid2['name'];
              $required=" ";
             $hidden2="hidden";
             $hidden3=" ";
         }
}elseif(isset($_POST['save'])){
    $upd1=$_POST['date2'];
    $upd2=$_POST['excution-place'];
    $upd3=$_POST['supervision'];
    $upd4=$_POST['performers'];
    $upd5=$_POST['budget'];
    $id2=$_POST['id1'];
     $query5="UPDATE `fields` SET `date`='$upd1',`address`='$upd2',`montors`='$upd3',`execution_members`='$upd4',`budget`= $upd5 WHERE id = '$id2'";
     $res_5=mysqli_query($connection, $query5);
   $query1="SELECT `id`, `name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget` FROM `fields` WHERE id = '$id2' ";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
			 $id147=$flagid['Activity_id'];
             $date1=$flagid['date'];
             $name=$flagid['name'];
             $execution_area=$flagid['execution_area'];
             $execution_type=$flagid['execution_type'];
             $address=$flagid['address'];
             $montors=$flagid['montors'];
             $execution_members=$flagid['execution_members'];
             $budget=$flagid['budget'];
             $query2="SELECT `name` FROM `activity` WHERE id=$id147";
              $res_2=mysqli_query($connection, $query2);
             $flagid2=mysqli_fetch_assoc($res_2);
             $Activity_name= $flagid2['name']; 
              $required=" ";
             $hidden2="hidden";
         }
    $readonly="readonly";
    $hidden=" ";
    $hidden3="hidden";
}elseif(isset($_POST['cancel'])){
    $id2=$_POST['id1'];
     $query1="SELECT `id`, `name`, `Activity_id`, `date`, `execution_area`, `execution_type`, `address`, `montors`, `execution_members`, `budget` FROM `fields` WHERE id = '$id2' ";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
			 $id147=$flagid['Activity_id'];
             $date1=$flagid['date'];
             $name=$flagid['name'];
             
             
             $execution_area=$flagid['execution_area'];
             $execution_type=$flagid['execution_type'];
             $address=$flagid['address'];
             $montors=$flagid['montors'];
             $execution_members=$flagid['execution_members'];
             $budget=$flagid['budget'];
             $query2="SELECT `name` FROM `activity` WHERE id=$id147";
              $res_2=mysqli_query($connection, $query2);
             $flagid2=mysqli_fetch_assoc($res_2);
             $Activity_name= $flagid2['name'];
             $required=" ";
             $hidden2="hidden";
             
         }
     $readonly="readonly";
    $hidden=" ";
    $hidden3="hidden";
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
    <title>البحث عن مسابقه</title>
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
                                  <a class="dropdown-item" href="new_activity1.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item active" href="serche_activity.php">البحث عن مسابقه</a>
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
                  <form class="form-inline my-2 my-lg-0" action="serche_activity.php" method="post">
                   
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

    <div class="container">
       
            <div class="form-content">
                    <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="serche_activity.php" method="post" class="mb-3 pb-2">
                        <div class="form-row justify-content-center" <?php echo $hidden2;?>>
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="field">المجال</label>
                            <select name="field" id="field" class="form-control" <?php echo $required; ?>>
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
                                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date" name="date" <?php echo $required; ?>>
                                </div>
                            </div>

                            <div class="form-row justify-content-center mt-5"  <?php echo $hidden2;?> >
                                    <button class="btn btn-info mx-2" type="submit" name="search">بحث</button>
                                    <button class="btn btn-info mx-2" type="reset" value="reset">الغاء</button>
                                </div>


                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label <?php echo $hidden3;?>>لا يمكن التعديل على اسم النشاط واسم المجال و نطاق التنفيذ و نوعه</label><br>
                            <label for="name"> اسم النشاط</label>
                            <input type="text" class="form-control" id="activty" placeholder="النشاط" name="activty" value="<?php echo $Activity_name;?>" readonly>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="field2">المجال</label>
                            <input type="text" class="form-control" id="faild2" placeholder="المجال" name="faild2" value="<?php echo $name;?>" readonly>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="date">التاريخ</label>
                            <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date2" name="date2" value="<?php echo  $date1;?>" <?php echo $readonly;?>> 
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="excution-field">نطاق التنفيذ</label>
                            <input type="text" class="form-control" id="area" placeholder="النطاق" name="area" value="<?php echo $execution_area;?>" readonly>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="excution-kind">نوع التنفيذ</label>
                            <input type="text" class="form-control" id="type" placeholder="النوع" name="type" value="<?php echo $execution_type;?>" readonly>
                        </div>
                    </div>
                   

                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="excution-place">مكان التنفيذ</label>
                            <input type="text" class="form-control" id="excution-place" placeholder="المكان" name="excution-place" value="<?php echo $address;?>" <?php echo $readonly;?>>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="supervision">الاشراف </label>
                            <input type="text" class="form-control" id="supervision" placeholder="الاشراف" name="supervision" value="<?php echo $montors;?>" <?php echo $readonly;?> onkeyup="lettersOnly(this)">
                        </div>
                       
                    </div>
                    <div class="form-row justify-content-center">
                        
                       
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                                <label for="performers">المنفذون</label>
                                <input type="text" class="form-control" id="performers" placeholder="المنفذون" name="performers" value="<?php echo $execution_members;?>" <?php echo $readonly;?> onkeyup="lettersOnly(this)">
    
                            </div>
                    </div>
                    <div class="form-row justify-content-center">
                        
                           
                            <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="budget">الميزانية</label>
                                    <input type="number" class="form-control" id="budget" placeholder="الميزانية" name="budget" value="<?php echo $budget;?>" <?php echo $readonly;?> onkeyup="lettersOnly2(this)">
        
                                </div>
                        </div>
                        <div class="form-row justify-content-center mt-5"  >
                            
                             <button class="btn btn-info mx-2" type="submit" name="search2" <?php echo $hidden;?>>بحث مره اخرى</button>
                                <button class="btn btn-info mx-2" type="submit" name="update"<?php echo $hidden;?>>تعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name="save" <?php echo $hidden3;?>>حفظ التعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name="cancel" <?php echo $hidden3;?>>الغاء</button>
                             <input type="text"  class="form-control" id="level"  name="id1" hidden value="<?php echo $id1;?>">
                            <input type="text"  class="form-control" id="level"  name="id2" hidden  value="<?php echo $date1;?>">
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