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
    $type1=$_POST['type'];
    $start1=$_POST['date1'];
    $end1=$_POST['date2'];
    $address1=$_POST['excution-place'];
    $supervision1=$_POST['supervision'];
    $query1="SELECT `id` FROM `activity2` WHERE type='$type1' and start_trining='$start1'";
    $res1= mysqli_query($connection, $query1);
    if (mysqli_num_rows($res1) > 0){
        $mass="لقد تم تسجيل هذا " . $type1 . " من قبل برجاء التاكد من البيانات  ";
        echo "<script type ='text/javascript'>alert('$mass');</script>";
    }else{
      $query2="INSERT INTO `activity2`(`type`, `start_trining`, `end_trining`, `address`, `supervisors`) VALUES ('$type1','$start1','$end1','$address1','$supervision1')"; 
       $res2= mysqli_query($connection, $query2);
        $query8="SELECT `id` FROM `activity2` WHERE type = '$type1' and start_trining = '$start1' ";
        $res8= mysqli_query($connection, $query8);
        $flagid=mysqli_fetch_assoc($res8);
        $id8=$flagid['id'];
        $faculty=array("كليه الحاسبات","كليه الهندسه","كليه العلوم","كليه طب بشرى","كليه طب اسنان","كليه طب بيطرى","كليه صيدله","كليه اداب","كليه تربيه","كليه السياحه","كليه تجاره","كليه التمريض","كليه الزراعه");
        foreach($faculty as $coldg){
          $query9="INSERT INTO `team_result`(`name`, `result`, `activity2_id`) VALUES ('$coldg','لم تشترك','$id8')";
            $res9= mysqli_query($connection, $query9);
        }
        
       $mass="لقد تسجيل البيانات بنجاح";
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
                          <a class="dropdown-item active" href="new_activity4.php">تسجيل مسابق جديده</a>
                          <a class="dropdown-item " href="serche_activity4.php">البحث عن مسابقه</a>
                 </div>
                      </li>

                      <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              الطلاب
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="new_student4.php">تسجيل طالب </a>
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
          <form class="form-inline my-2 my-lg-0" action="new_activity4.php" method="post">
           
            <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
          </form>
        </div>
      </nav>
    <div class="container">
        
            <div class="form-content">
                    <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="new_activity4.php" method="post" class="mb-3 pb-2">
                        <div class="form-row justify-content-center">
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="field">اختر النوع</label>
                                    <select name="type" id="field" class="form-control" required>
                                        <option disabled selected value="">اختر النوع.....</option>
                                        <option value="مهرجان">مهرجان </option>
                                        <option value="تدريب">تدريب</option>
                                
                                    </select>
                                </div>
                               
                            </div>
                            <div class="form-row justify-content-center">
                                    <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                            <label for="date"> تاريخ البدء من</label>
                                            <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date" name="date1" required>
                                    </div>
                                    <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                        <label for="date2">الى</label>
                                        <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date2" name="date2" required>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                                            <label for="excution-place">مكان التنفيذ</label>
                                            <input type="text" class="form-control" id="excution-place" placeholder="المكان" name="excution-place" required>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                        
                                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                                <label for="supervision">المشرفين </label>
                                                <input type="text" class="form-control" id="supervision" placeholder="الاشراف" name="supervision" required onkeyup="lettersOnly(this)">
                                            </div>
                                           
                                        </div>
                   
                        <div class="form-row justify-content-center mt-5"  >
                            <button class="btn btn-info mx-2" type="submit" name="save">تسجيل</button>
                            <button class="btn btn-info mx-2" type="reset" value="reset">الغاء</button>
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