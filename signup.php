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

//======================================================================= UPLOADING     
if (isset($_POST['signup']))
{
  if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK)
  {


      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $npass = $_POST['npass'];
      $cpass = $_POST['cpass'];

    // get details of the uploaded file
    $fileTmpPath = $_FILES['logo']['tmp_name'];
    $fileName = $_FILES['logo']['name'];
    $fileSize = $_FILES['logo']['size'];
    $fileType = $_FILES['logo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = 'img/new/company_logos/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        // $message ='File is successfully uploaded.';
        if ($npass==$cpass) {
            $sel = $con->prepare("SELECT * FROM systemusers WHERE (systemusers.Phone='$phone' OR systemusers.Email='$email') AND systemusers.Status=1");
            $sel->execute();
            if ($sel->rowCount()>=1) {
                $message = 'Emplooyee with these information already exists.';
            }else{
                $ins = $con->prepare("INSERT INTO systemusers(Names,Phone,Email,Password,Logo,Type) VALUES(?,?,?,?,?,?)");
                $ins->bindValue(1,$name);
                $ins->bindValue(2,$phone);
                $ins->bindValue(3,$email);
                $ins->bindValue(4,md5($npass));
                $ins->bindValue(5,$newFileName);
                $ins->bindValue(6,'employee');
                $ok = $ins->execute();
                if ($ok) {
                    $message = "Successful recorded !";
                }else{
                    $message = "Failed, Try again later.";
                }
            }
        }else{
            $message = "Passwords don't match.";
        }

      }else{
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
$_SESSION['message'] = $message;
echo "<script>window.location='signup?sign=1'</script>";
}

// header("Location: signup");

?>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid" style="margin-top: -30px">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Sign Up</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid" style="margin-top: -30px">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" style="margin: 0 auto;"><span class="bg-secondary pr-3">Employee  || Create account </span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5" style="margin: 0 auto;margin-top: -20px">
                <div class="contact-form bg-light p-30">
                    <div id="success" class="alert alert-<?=$type?>" style="font-weight: bolder;text-align: center;"><?=$_SESSION['message'];?></div>
                    <form novalidate="novalidate" style="margin-top: -20px" action = "" method = "POST" enctype = "multipart/form-data">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Company Name"
                                required="required" data-validation-required-message="Please enter your username" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone number"
                                required="required" data-validation-required-message="Please enter your Phone number" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label style="font-weight: bold;margin-top: -30px">Company's Logo: </label>
                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Company Logo"
                                required="required" data-validation-required-message="Please upload your company's logo" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="npass" name="npass" placeholder="New Password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="cpass" name="cpass" placeholder="confirm Password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="signup" name="signup">Sign Up</button>
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
<!--     <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script> -->

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>