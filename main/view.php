<?php
require("../config.php");
//========================== DepartmentFromCategory
if (isset($_POST['DepartmentFromCategory'])) {
    $cat = $_POST['categoryId'];
    $sel = $con->prepare("SELECT * FROM departments WHERE departments.CategoryId='$cat' AND departments.DepartmentStatus=1");
    $sel->execute();
    if ($sel->rowCount()>=1) {
        $cnt = 0;
        while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
            $arr['found'] = 1;
            $arr['resp'][$cnt]['department_id'] = $ft_sel['DepartmentId'];
            $arr['resp'][$cnt]['department_name'] = $ft_sel['DepartmentName'];
            $cnt++;
        }
    }else{
        $arr['found'] = 0;
    }
    return print(json_encode($arr));
}

?>