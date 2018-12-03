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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>الصفحه الرئيسيه</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  
</head>
<body class="main">
 
        <header class="container-fluid py-2 justify-content-middle">
                <div class="row text-center" >
                    <div class="col-md-3">   <form class="form-inline my-2 my-lg-0 mx-5" action="main4.php" method="post">
                                      
              <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
              </form></div>
                 
                  <div class="col-md-6"> <h2 align="center"class="pt-3 pb-2" >اداره نشاط الجواله</h2></div>
                   <div class="col-md-3"> <img src="images/a.jpg" alt="logo" ></div>
                
                </div>
                      
                     </header>
        
<div class="container">
        <div class="tab-content form-content">
                <div class="tab-pane active  px-4 fade show" id="new-competition" role="tabpanel">
                        <form action="" class="mb-3 pb-2">
                                <div class="form-row justify-content-center">
                                        
                                
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-5 ">
                                    <div class="list-group" style="margin-top: 10px;">
                                                
                                        <a href="new_activity4.php" class="list-group-item list-group-item-action list-group-item-info text-center">تسجيل مهرجان او فتره تدريب</a>
                                        <a href="new_student4.php" class="list-group-item list-group-item-action list-group-item-info text-center">تسجيل طالب</a>
                                        <a href="result4-1.php" class="list-group-item list-group-item-action list-group-item-info text-center">  ترتيب الكليات</a>
                                        <a href="serche_student4.php" class="list-group-item list-group-item-action list-group-item-info text-center ">بحث عن بيانات طالب</a>
                                        <a href="serche_activity4.php" class="list-group-item list-group-item-action list-group-item-info text-center">بحث عن مسابقه</a>
                                        
                                        <a href="super_team4.php" class="list-group-item list-group-item-action list-group-item-info text-center"> تسجيل منتخب الجامعه</a>
                                        <a href="result4-2.php" class="list-group-item list-group-item-action list-group-item-info text-center">عرض منتخب الجامعه</a>
                                        
                                        
                                        
                                        
                                        
                                    </div>
                              
                                
                                </div>
                                
                                 </div>
                        </form>   
                </div>
         </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
