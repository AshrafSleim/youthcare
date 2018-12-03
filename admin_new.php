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
    if (isset($_POST['button1'])) {
    session_unset();
    session_destroy();
    redirect("index.php");
    header('Cache-Control: no cache');
    exit();
    }
    elseif (isset($_POST['save'])) {
        $name= $_POST['name1'];
        $password1=htmlspecialchars( $_POST['pass1']);
        $password2=htmlspecialchars( $_POST['pass2']);
        $type1= $_POST['type'];
        
        if($password1==$password2){
            $sql_u ="SELECT `name`, `password` FROM `login` WHERE name ='$name' and password ='$password1'";
            $res_u = mysqli_query($connection, $sql_u);
             if (mysqli_num_rows($res_u) > 0) {
                  $mass="هذا الاسم والرقم السرى مستخدم من قبل برجاء تغير الرقم السرى";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
             }else{
                 $sql_e="INSERT INTO `login`(`name`, `password`, `department`) VALUES ('$name','$password1','$type1')";
                 mysqli_query($connection, $sql_e);
                  $mass="لقد تم التسجيل بنجاح";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
             }
        }else{
            $mass="لرقم السرى الثانى غير مطابق للرقم السرى الثانى برجاء ادخاله مره اخرى";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
        }
        
        

    }

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
   
    <title>تسجيل موظف جديد</title>
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
                      <a class="nav-link" href="admin_new.php">تسجيل موظف جديد<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="admin2.php">تعديل او مسح بيانات موظف</a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="main_admin.php">القائمه الرئيسيه</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="admin_new.php" method="post">
                     
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

    <div class="container">
      
        <div class="tab-content form-content">
            <div class="tab-pane active  px-4 fade show" id="new-competition" role="tabpanel">
               
                <form  class="mb-3 pb-2" action="admin_new.php" method="post">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="name"> اسم الموظف</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="text" placeholder="ادخل الاسم" class="form-control" id="name" name="name1" required>
                            </div>

                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="pass1">ادخل الرقم السرى</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="password" placeholder="الرقم السرى" class="form-control" name="pass1" id="pass1"  required>
                            </div>

                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="pass2">اعد ادخال الرقم السرى</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="password" placeholder="الرقم السرى مرع اخرى" class="form-control" name="pass2" id="pass2" required >
                            </div>

                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="excution-kind">القسم</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                        <select name="type" id="excution-kind" class="form-control" required>
                            <option disabled selected value="">اختر القسم.....</option>
                            <option value="اداره النشاط الثقافى">اداره النشاط الثقافى</option>
                            <option value="اداره النشاط الاجتماعى">اداره النشاط الاجتماعى</option>
                            <option value="اداره الفن">اداره الفن</option>
                            <option value="اداره الجواله">اداره الجواله</option>
                            
                        </select>
                    </div>
                        </div>
                        <div class="form-row justify-content-center mt-5"  >
                                <button class="btn btn-info mx-2" type="submit" name="save">حفظ</button>
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
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>