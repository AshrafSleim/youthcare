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

$host="localhost";
$dbusername="root";
$dbpassword="123456";
$dbname="youthcare";
$conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);
$conn->set_charset("utf8");
if(mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
}
?>
<?php 
$cost=" ";
$cost1=" ";
$cost2=" ";
if(isset($_POST['search'])){

 $year=$_POST['year1'];
    $query="SELECT   `Faculty` , sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='$year' AND student.type='ذكر'    GROUP BY Faculty   ";
     $res=mysqli_query($conn,$query);
   $query2="SELECT   `Faculty` , sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='$year' AND student.type='انثى'    GROUP BY Faculty   ";
   $res2=mysqli_query($conn,$query2);
    $query3="SELECT    sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='$year' AND student.type='ذكر'";
    $res3=mysqli_query($conn,$query3);
    $finel3=mysqli_fetch_assoc($res3);
    $cost=$finel3['sum(budget)'];
    $query4="SELECT    sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='$year' AND student.type='انثى'";
    $res4=mysqli_query($conn,$query4);
    $finel4=mysqli_fetch_assoc($res4);
    $cost1=$finel4['sum(budget)'];
    $query5="SELECT    sum(budget)  FROM `student_social`  WHERE school_year='$year' ";
    $res5=mysqli_query($conn,$query5);
    $finel5=mysqli_fetch_assoc($res5);
    $cost2=$finel5['sum(budget)'];
    
    
}elseif(isset($_POST['again'])){
    $cost=" ";
$cost1=" ";
$cost2=" ";
 $query="SELECT   `Faculty` , sum('budget')  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='0'  AND student.type='ذكر' AND   student.id='0'  GROUP BY Faculty ";
 $res=mysqli_query($conn,$query);
     $query2="SELECT   `Faculty` , sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='0' AND student.type='انثى'  AND   student.id='0'   GROUP BY Faculty   ";
     $res2=mysqli_query($conn,$query2);
}else{
    $cost=" ";
$cost1=" ";
$cost2=" ";
 $query="SELECT   `Faculty` , sum('budget')  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='0'  AND student.type='ذكر' AND   student.id='0'  GROUP BY Faculty ";
 $res=mysqli_query($conn,$query);
     $query2="SELECT   `Faculty` , sum(budget)  FROM  `student` JOIN `student_social` WHERE student.id = student_social.Studentid  AND school_year='0' AND student.type='انثى'  AND   student.id='0'   GROUP BY Faculty   ";
     $res2=mysqli_query($conn,$query2);
}




?>

<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style2.css">
    
    <title>حساب ميزانيه</title>
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
                                <a class="nav-link" href="new_student3.php"> تسجيل طالب جديد</a>
                              </li>
                              <li class="nav-item active">
                                    <a class="nav-link" href="cost.php"> حساب ميزانيه</a>
                                  </li>
                
                                  <li class="nav-item ">
                                        <a class="nav-link" href="serche_student3.php">البحث عن بيانات طالب</a>
                                      </li>
                      <li class="nav-item ">
                      <a class="nav-link" href="main3.php">القائمه الرئيسيه</a>
                    </li>
                    
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" method="post"  action="cost.php">
                     
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

              <div class="container">
        
                    <div class="form-content">
                            <div class="px-4 fade show" id="new-competition" role="tabpanel">
                                    <form method="post"  action="cost.php" class="mb-3 pb-2">
                                            <div class="form-row justify-content-center">
                                                    <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                            <label for="year">ادخل العام الدراسى</label>
                                                          
                                                    </div>
                                                    <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                            <input type="number" placeholder="عام" class="form-control" id="year" name="year1" min="1990">
                                                        </div>
                                               
                                                </div>
                                                <div class="form-row justify-content-center mt-5"  >
                                                        <button class="btn btn-info mx-2" type="submit" name="search">بحث</button>
                                                        <button class="btn btn-info mx-2" type="reset" value="reset">الغاء</button>
                                                </div>
                                                
                                                <div class="form-row justify-content-center">
                                                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                                <label for="male"> ميزانيه طلبه </label>
                                                                <table class="table table-info table-hover  table-striped mt-5  " style="table-layout:fixed"id="male">
                                                                        <thead class="bg-info">
                                                                          <tr class="text-white" >
                                                                            <th class="text-right"> الكليه</th>
                                                                            <th class="text-right"> الميزانيه</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                             <?php while($row = mysqli_fetch_array( $res)):?>
                            <tr>
                                <td><?php echo $row['Faculty'];?></td>
                                <td><?php echo $row['sum(budget)'];?></td>
                                
                            </tr>
                            <?php endwhile;?>

<!--
                                                                          <tr>
                                                                            <td contenteditable="true"></td>
                                                                            <td  contenteditable="true"></td>
                                                                           
                                                                          </tr>
                                                                          <tr>
                                                                                <td contenteditable="true"></td>
                                                                                <td  contenteditable="true"></td>
                                                                               
                                                                              </tr>
                                                                         
                                                                              <tr>
                                                                                    <td contenteditable="true"></td>
                                                                                    <td  contenteditable="true"></td>
                                                                                   
                                                                                  </tr>
                                                                          </tr>
-->
                                                                        </tbody>
                                                                      </table>

                                                        </div>
                                                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                                <label for="fmale"> ميزانيه طالبات </label>
                                                                <table class="table table-info table-hover  table-striped mt-5  " style="table-layout:fixed" id="fmale">
                                                                        <thead class="bg-info">
                                                                          <tr class="text-white" >
                                                                            <th class="text-right"> الكليه</th>
                                                                            <th class="text-right"> الميزانيه</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while($row = mysqli_fetch_array( $res2)):?>
                            <tr>
                                <td><?php echo $row['Faculty'];?></td>
                                <td><?php echo $row['sum(budget)'];?></td>
                                
                            </tr>
                            <?php endwhile;?>
<!--
                                                                          <tr>
                                                                            <td contenteditable="true"></td>
                                                                            <td  contenteditable="true"></td>
                                                                           
                                                                          </tr>
                                                                          <tr>
                                                                                <td contenteditable="true"></td>
                                                                                <td  contenteditable="true"></td>
                                                                               
                                                                              </tr>
                                                                         
                                                                              <tr>
                                                                                    <td contenteditable="true"></td>
                                                                                    <td  contenteditable="true"></td>
                                                                                   
                                                                                  </tr>
                                                                          </tr>
-->
                                                                        </tbody>
                                                                      </table>

                                                        </div>
                                                </div>
                                                <div class="form-row justify-content-center">
                                                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                            <label for="cost1">اجمالى ميزانيه الطلبه</label>
                                                            <input type="text"  class="form-control" id="cost1" value="<?php echo $cost;?>"readonly >
                                                        </div>
                                                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                                <label for="cost2">اجمالى ميزانيه الطالبات</label>
                                                                <input type="text"  class="form-control" id="cost2" value="<?php echo $cost1;?>"readonly >
                                                        </div>
                                                </div>
                                                <div class="form-row justify-content-center">
                                                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                                            <label for="cost3">الميزانيه الكليه</label>
                                                            <input type="text"  class="form-control" id="cost3"  value="<?php echo $cost2;?>"readonly >
                                                        </div>
                                                        </div>
                                                        <div class="form-row justify-content-center mt-5"  >
                                                                <button class="btn btn-info mx-2" type="submit" name="again">بحث مره اخرى</button>
                                                                <button class="btn btn-info mx-2" type="button" onClick="window.print()">طباعه</button>
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