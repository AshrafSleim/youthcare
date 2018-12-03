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
$tage="hidden";
$tage2=" ";
$lapel=" برجاء ادخال بيانات الموظف الذى تريد التعديل على بياناته";
$user="";
$password1="";
$type="";
if (isset($_POST['logout'])) {
         session_unset();
    session_destroy();
    redirect("index.php");
    header('Cache-Control: no cache');
    exit();
    }
    elseif (isset($_POST['update'])) {
         $user=$_POST['name1'];
        $password1=$_POST['pass1'];
        $type=$_POST['type'];
        $query1="SELECT  `name`, `password`, `department` FROM `login` WHERE name ='$user' and password ='$password1' and department='$type' ";
        $res_u=mysqli_query($connection, $query1);
        
         if (mysqli_num_rows($res_u) > 0) {
            $tage=" ";     
            $tage2="hidden";
            $lapel="قم بتعديل البيانات ثم اضغط حفظ البيانات";
             
            
         }else{
             $mass="لا يوجد موظف بهذه البيانات برجاء ادخال البيانات صحيحه";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
        
         }
   

    }elseif (isset($_POST['save'])) {
         $user=$_POST['a1'];
        $password1=$_POST['a2'];
        $type=$_POST['a3'];
         if(isset($_POST['type']) && isset($_POST['pass1']) && isset($_POST['pass2']))
{
        $user2=$_POST['name1'];
        $password21=$_POST['pass1'];
        $type21=$_POST['type'];
        $password22=$_POST['pass2'];
       

        if($password21==$password22){
            
            $sql_u ="SELECT `name`, `password` FROM `login` WHERE name ='$user2' and password ='$password21'";
      
      $res_u = mysqli_query($connection, $sql_u);
                    if (mysqli_num_rows($res_u) > 0){
                   $mass="هذا الاسم و الرقم السرى مستخدم من قبل برجاء قم بتغيرهم";
                  echo "<script type ='text/javascript'>alert('$mass');</script>";
                    }else{
                   $sql_x ="UPDATE `login` SET `name` = '$user2', `password` = '$password21', `department` = '$type21' WHERE name ='$user' and password ='$password1' and department='$type'";
                    $res_x = mysqli_query($connection, $sql_x);
                    $tage="hidden";
                    $tage2=" ";
                    $lapel=" برجاء ادخال بيانات الموظف الذى تريد التعديل على بياناته";
                    $user="";
                    $password1="";
                    $mass="لقد تم تعديل بيانات الموظف";
                  echo "<script type ='text/javascript'>alert('$mass');</script>";
              }
          
   }else{
            $mass="برجاء التاكد من ادخال الرقم السرى فى المره الثانيه مطابقا للمره الاولى";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
        }
         }else{
              $mass="برجاء التاكد من ادخال القسم المنتسب اليه  الموظف";
                  echo "<script type ='text/javascript'>alert('$mass');</script>";
         }
    }elseif (isset($_POST['delete'])) {
        $user=$_POST['name1'];
        $password1=$_POST['pass1'];
        $type=$_POST['type'];
        $query1="SELECT `id` FROM `login` WHERE name ='$user' and password ='$password1' and department='$type' ";
        $res_u=mysqli_query($connection, $query1);
        
         if (mysqli_num_rows($res_u) > 0) {
             $flagid=mysqli_fetch_assoc($res_u);
             $x=$flagid['id'];
             $sql_x ="DELETE FROM `login` WHERE `login`.`id` = $x";
           $res_x = mysqli_query($connection, $sql_x);
             $mass="لقد تم حذف البيانات";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
            $user="";
            $password1="";
         }else{
             $mass="لا يوجد موظف بهذه البيانات برجاء ادخال البيانات صحيحه";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
         
         }
    }elseif (isset($_POST['cancel2'])) {
//        $tage="hidden";
//$tage2=" ";
//$lapel=" برجاء ادخال بيانات الموظف الذى تريد التعديل على بياناته";
//$user="";
//$password1="";
//$type="";
         redirect("admin2.php");
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
   
    <title>تعديل او مسح بيانات</title>
</head>

<body class="main">

        <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top" style="background:#00376d ; " >
                <button class="navbar-toggler text-white"   type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                      </button>  
                      <img src="images/a.jpg" alt="logo" >
               
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                      <a class="nav-link" href="admin_new.php">تسجيل موظف جديد<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="admin2.php">تعديل او مسح بيانات موظف</a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="main_admin.php">القائمه الرئيسيه</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="admin2.php" method="post">
                      
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="logout">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

    <div class="container">
      
        <div class="tab-content form-content">
            <div class="tab-pane active  px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="admin2.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center mt-5"  >
                        <label for="name"> <?php echo $lapel;?></label>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="name"> اسم الموظف</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="text" placeholder="ادخل الاسم" class="form-control" id="name" name="name1" value="<?php echo $user;?>" >
                            </div>

                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="debd"> القسم</label>
                              
                        </div>
                       <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                        <select name="type" id="excution-kind" class="form-control"   >
                             <option disabled selected value="">اختر القسم.....</option>
                            <option value="اداره النشاط الثقافى">اداره النشاط الثقافى</option>
                            <option value="اداره النشاط الاجتماعى">اداره النشاط الاجتماعى</option>
                            <option value="اداره الفن">اداره الفن</option>
                            <option value="اداره الجواله">اداره الجواله</option>
                            
                        </select>
                    </div>

                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="pass1" > الرقم السرى</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="password" placeholder="الرقم السرى" class="form-control" id="pass1"  name="pass1" value="<?php echo $password1;?>">
                            </div>

                    </div>
                    
                    <div class="form-row justify-content-center">
                        <div class="col-sm-4 mt-2 col-md-4 col-lg-2 ">
                                <label for="pass2"  <?php echo $tage; ?>>اعد ادخال الرقم السرى</label>
                              
                        </div>
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="password" placeholder="الرقم السرى مرع اخرى" class="form-control" id="pass2" name="pass2" <?php echo $tage; ?>>
                            </div>

                    </div>
                   <div class="form-row justify-content-center mt-5"  >
                                <button class="btn btn-info mx-2" type="submit" name="update"  <?php echo $tage2; ?>>تعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name="save"  <?php echo $tage; ?>>حفظ التغير</button>
                                <button class="btn btn-info mx-2" type="submit" name="delete" <?php echo $tage2; ?>>مسح موظف</button>
                                <button class="btn btn-info mx-2" type="reset" value="reset" name="cancel" <?php echo $tage2; ?>>الغاء</button>
                        <button class="btn btn-info mx-2" type="submit" name="cancel2" <?php echo $tage; ?>>الغاء</button>
                               
                            </div>
                    <div class="form-row justify-content-center">
                        
                        <div class="col-sm-8 mt-2 col-md-8 col-lg-4 ">
                                <input type="text" placeholder="الرقم السرى" class="form-control" id="pass1"  name="a1" value="<?php echo $user;?>" hidden>
                            <input type="text" placeholder="الرقم السرى" class="form-control" id="pass1"  name="a2" value="<?php echo $password1;?>" hidden>
                            <input type="text" placeholder="الرقم السرى" class="form-control" id="pass1"  name="a3" value="<?php echo $type;?>" hidden>
                            </div>

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