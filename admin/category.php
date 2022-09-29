<?php require("../header2.php");?>

<?php
//======================= SAVE Category

if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if ($name!='') {
            $sel = $con->prepare("SELECT* FROM categories WHERE categories.CategoryName='$name' AND categories.CategoryStatus=1");
            $sel->execute();
            if ($sel->rowCount()<1) {
                $ins = $con->prepare("INSERT INTO categories(CategoryName) VALUES('$name')");
                $ok = $ins->execute();
                if ($ok) {
                echo "<script>window.location='category'</script>";
                }
            }
        }
}

?>
    <!-- Navbar End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3" id="recent">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">AVAILABLE Categories</span></h2>
        <div class="row px-xl-5">
            <div class="container-fluid">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;font-weight: bolder;">
  Add New
</button>
<!-- NEW Category MODEL -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action = "category" method = "POST" name="sentMessage" id="contactForm" novalidate="novalidate">

      <div class="modal-body">
                        <div class="control-group">
                            <label for="" style="font-weight: bold;">Category Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Category Name"
                                required="required" data-validation-required-message="Please enter caategory name" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div>
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
                                <th scope="col">Category Name</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Status</th>
                            </thead>
                            <tbody>
                                <?php
                                $sel = $con->prepare("SELECT * FROM categories WHERE categories.CategoryStatus=1 ORDER BY categories.CategoryName");
                                $sel->execute();
                                if ($sel->rowCount()>=1) {
                                    $cnt=1;
                                    while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
                                        switch ($ft_sel['CategoryStatus']) {
                                            case 1:
                                                $status = "Active";
                                                break;
                                            
                                            default:
                                                $status = "Disabled";
                                                break;
                                        }
                                        echo "<tr>";
                                            echo "<td>".$cnt++."</td>";
                                            echo "<td>".$ft_sel['CategoryName']."</td>";
                                            echo "<td>".substr($ft_sel['CategoryDate'], 0,16)."</td>";
                                            echo "<td>".$status."</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='4'>No data found ...</td></tr>";
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
</body>

</html>