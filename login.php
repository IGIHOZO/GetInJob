<?php
require("header.php");
if (!isset($_SESSION['message']))  {
    $_SESSION['message'] = '';
    // echo "alert('Hey !!!')";
}
$message = ''; 
if (substr($_SESSION['message'], 0,10) == 'Successful' AND isset($_GET['sign'])) {
    $type = 'success';
}else if (isset($_GET['sign'])) {
    $type = 'danger';
}else{
    $type = 'default';
    $_SESSION['message'] = '';
}


//======================================================================= LOGIN     
if (isset($_POST['login'])){

    $name = $_POST['name'];
    $pass = $_POST['pass'];
    if ($pass!='' AND $name!='') {
    $sel = $con->prepare("SELECT * FROM systemusers WHERE (systemusers.Phone=? OR systemusers.Email=?) AND systemusers.Password=? AND systemusers.Status=1");
    $sel->bindValue(1,$name);
    $sel->bindValue(2,$name);
    $sel->bindValue(3,md5($pass));
    $sel->execute();
    if ($sel->rowCount()==1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        switch ($ft_sel['Type']) {
            case 'employee':
                $_SESSION['getinjob']['user_type'] = "Employee";
                $_SESSION['getinjob']['employee_name'] = $ft_sel['Names'];
                $_SESSION['getinjob']['employee_id'] = $ft_sel['UserId'];
                $_SESSION['getinjob']['employee_phone'] = $ft_sel['Phone'];
                $_SESSION['getinjob']['employee_email'] = $ft_sel['Email'];
                $message = 'Login - Successful!';
                echo "<script>window.location='index'</script>";
                break;
            case 'admin':
                $_SESSION['getinjob']['user_type'] = "Admin";
                $_SESSION['getinjob']['admin_name'] = $ft_sel['Names'];
                $_SESSION['getinjob']['admin_id'] = $ft_sel['UserId'];
                $_SESSION['getinjob']['admin_phone'] = $ft_sel['Phone'];
                $_SESSION['getinjob']['admin_email'] = $ft_sel['Email'];
                $message = 'Login - Successful!';
                echo "<script>window.location='admin/index'</script>";
                break;
            case 'manager':
                $_SESSION['getinjob']['user_type'] = "Manager";
                $_SESSION['getinjob']['manager_name'] = $ft_sel['Names'];
                $_SESSION['getinjob']['manager_id'] = $ft_sel['UserId'];
                $_SESSION['getinjob']['manager_phone'] = $ft_sel['Phone'];
                $_SESSION['getinjob']['manager_email'] = $ft_sel['Email'];
                $message = 'Login - Successful!';
                echo "<script>window.location='manager/index'</script>";
                    break;
            case 'candidate':
                $_SESSION['getinjob']['user_type'] = "Candidate";
                $_SESSION['getinjob']['employee_name'] = $ft_sel['Names'];
                $_SESSION['getinjob']['employee_id'] = $ft_sel['UserId'];
                $_SESSION['getinjob']['employee_phone'] = $ft_sel['Phone'];
                $_SESSION['getinjob']['employee_email'] = $ft_sel['Email'];
                $message = 'Login - Successful!';
                echo "<script>window.location='index'</script>";
                break;
            default:
                # code...
                break;
        }
        

    }else{
        $message = "Wrong Username or Password";
    }
    }else{
        $message = 'Please fill all fields.';
    }

$_SESSION['message'] = $message;
echo "<script>window.location='login?sign=1'</script>";
}

?>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Login</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" style="margin: 0 auto;"><span class="bg-secondary pr-3">Login </span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5" style="margin: 0 auto">
                <div class="contact-form bg-light p-30">
                    <div id="success" class="alert alert-<?=$type?>" style="font-weight: bolder;text-align: center;"><?=$_SESSION['message'];?></div>
                    <form action = "" method = "POST" novalidate="novalidate">
                        <div class="control-group">
                            <label for="" style="font-weight: bold;">Username:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Username"
                                required="required" data-validation-required-message="Please enter your username" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <!-- <input type="email" class="form-control" id="email" placeholder="Your Password"
                                required="required" data-validation-required-message="Please enter your email" /> -->
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label for="" style="font-weight: bold;">Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Your Password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="login" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
<?php require("footer.php");?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>













