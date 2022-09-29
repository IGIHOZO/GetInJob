<?php require("../header22.php");?>

<?php
//======================= SAVE Profession

if (isset($_POST['save'])) {
        $dept = $_POST['dept'];
        $profession = $_POST['profession'];
        if ($profession!='' AND $dept!='') {
            $sel = $con->prepare("SELECT * FROM profession WHERE profession.ProfessionName='$profession' AND profession.DepartmentId='$dept' AND profession.ProfessionStatus=1");
            $sel->execute();
            if ($sel->rowCount()<1) {
                $ins = $con->prepare("INSERT INTO profession(ProfessionName,DepartmentId) VALUES('$profession','$dept')");
                $ok = $ins->execute();
                if ($ok) {
                echo "<script>window.location='profession'</script>";
                }
            }
        }
}

?>
    <!-- Navbar End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3" id="recent">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Available Candidates</span></h2>
        <div class="row px-xl-5">
            <div class="container-fluid">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;font-weight: bolder;">
  Add New
</button>
<!-- NEW Category MODEL -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 1200px;margin-left: -68%">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register New Candidate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action = "" method = "POST" name="sentMessage" id="contactForm" novalidate="novalidate">

      <div class="modal-body">
        <div class="container-fluid">
            <div class="row px-xl-12">
                <div class="col-lg-6 col-sm-12 ">
                    <div class="control-group">
                        <h3 for="" style="font-weight: bold;">Personal Information:</h3><hr>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="candidateNames" name="candidateNames" placeholder="Candidates Names" required="required" data-validation-required-message="Please enter Candidates Names">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="candidatePhone" name="candidatePhone" placeholder="Phone Number" required="required" data-validation-required-message="Please enter Phone Number">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="candidateEmail" name="candidateEmail" placeholder="Email" required="required" data-validation-required-message="Please enter Email">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <div class="row">
                            <div class="col-6">
                                <label style="font-weight: bolder;">ID/Passport Number:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="candidateEmail" name="candidateEmail" placeholder="ID Number" required="required" data-validation-required-message="Please enter ID Number">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="row">
                            <div class="col-6">
                                <label style="font-weight: bolder;">Date of Birth:</label>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" id="candidateEmail" name="candidateEmail" placeholder="Email" required="required" data-validation-required-message="Please enter Email">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="row">
                            <div class="col-6">
                                <label style="font-weight: bolder;">Sex:</label>
                            </div>
                            <div class="col-6">
                                <select class="form-control" name="dept" id="dept">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="row">
                            <div class="col-4">
                                <select class="form-control" name="dept" id="dept">
                                    <option>Select Category</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="dept" id="dept">
                                    <option>Select Department</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="dept" id="dept">
                                    <option>Select Profession</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 ">
                    <div class="control-group">
                        <h3 for="" style="font-weight: bold;">Documents:</h3><hr>
                    </div>
                    <div class="control-group">
                        <label for="" style="font-weight: bold;">Passport Photo:</label>
                        <input type="file" class="form-control" id="candidateEmail" name="candidateEmail" required="required" data-validation-required-message="Please enter CV/Resume">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="" style="font-weight: bold;">CV/Resume:</label>
                        <input type="file" class="form-control" id="candidateEmail" name="candidateEmail" required="required" data-validation-required-message="Please enter CV/Resume">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="" style="font-weight: bold;">Diploma/Certificate:</label>
                        <input type="file" class="form-control" id="candidateEmail" name="candidateEmail" required="required" data-validation-required-message="Please enter CV/Resume">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                                <label for="" style="font-weight: bold;">Any Other Document:</label>
                        <div class="row">
                            <div class="col-6">
                                <label for="" style="font-weight: lighter;"> Document Name:</label>
                            </div>
                            <div class="col-6">
                                <label for="" style="font-weight: lighter;">Upload File:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" id="candidateEmail" name="candidateEmail" placeholder="Name of the document">
                            </div>
                            <div class="col-6">
                                 <input type="file" class="form-control" id="candidateEmail" name="candidateEmail">
                            </div>
                        </div>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="save" name="save">Save changes</button>
      </div>
                    </form>

    </div>
  </div>
</div>
<!-- END OF NEW CATEGORY MODEL -->
                        <table class="table table-dark table-hover text-center" style="margin: 0 auto;width: 100%">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Names</th>
                                <th scope="col">Picture</th>
                                <th scope="col">Department</th>
                                <th scope="col">Professsion</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $sel = $con->prepare("SELECT * FROM candidates,profession,departments,candidate_documents WHERE candidates.ProfessionId=profession.ProfessionId AND profession.DepartmentId=departments.DepartmentId AND candidates.CandidateId=candidate_documents.CandidateId AND candidates.Status=1");
                                $sel->execute();
                                if ($sel->rowCount()>=1) {
                                    $cnt=1;
                                    while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
                                        switch ($ft_sel['stt']) {
                                            case 1:
                                                $status = "Active";
                                                break;
                                            
                                            default:
                                                $status = "Disabled";
                                                break;
                                        }
                                        echo "<tr>";
                                            echo "<td>".$cnt++."</td>";
                                            echo "<td>".$ft_sel['Names']."</td>";
                                            echo "<td><img src='../img/new/candidates_passports/".$ft_sel['Passport']."' style='width:50px;height:70px'></td>";
                                            echo "<td>".$ft_sel['DepartmentName']."</td>";
                                            echo "<td>".$ft_sel['ProfessionName']."</td>";
                                            echo "<td>".substr($ft_sel['datte'], 0,16)."</td>";
                                            echo "<td> <button class='btn btn-success' style='border-radius: 15%'>More</button> </td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='7'>No data found ...</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor End -->


    <!-- Footer Start -->
<?php require("../footer.php");?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../mail/jqBootstrapValidation.min.js"></script>
    <!-- <script src="../mail/contact.js"></script> -->

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script type="text/javascript">
  $(document).ready(function(){

$("#category").change(function(){
  var categoryId = $("#category").val();
  var DepartmentFromCategory = true;
            $("#dept").html("<option value=''>Select Profession</option>");
      $.ajax({url:"../main/view.php",
        type:"POST",data:{DepartmentFromCategory:DepartmentFromCategory,categoryId:categoryId},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res);
          if (res.found===1) {
            for (const key in res.resp) {
              $("#dept").attr("disabled",false);
              $("#dept").append("<option value='"+res.resp[key].department_id+"'>"+res.resp[key].department_name+"</option>");
            }
          }else{
            $("#dept").attr("disabled",true);
            $("#dept").html("<option value=''>No Department Available ...</option>");
          }
          }
      });
})





});

    </script>
</body>

</html>