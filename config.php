<?php
session_start();
    $dbname = 'getinjob';
    $user = 'root';
    $pass = '';

    // $dbname = 'thefar27_getinjob';
    // $user = 'thefar27';
    // $pass = 'Faith@!RideNew';


    $con = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
    
if (isset($_SESSION['getinjob'])) {
    switch ($_SESSION['getinjob']['user_type']) {
        case 'Employee':
           $_SESSION['getinjob_name'] = $_SESSION['getinjob']['employee_name'];
           $_SESSION['getinjob_id'] = $_SESSION['getinjob']['employee_id'];
           $_SESSION['getinjob_phone'] = $_SESSION['getinjob']['employee_phone'];
           $_SESSION['getinjob_email'] = $_SESSION['getinjob']['employee_email'];
            break;
        case 'Admin':
           $_SESSION['getinjob_name'] = $_SESSION['getinjob']['admin_name'];
           $_SESSION['getinjob_id'] = $_SESSION['getinjob']['admin_id'];
           $_SESSION['getinjob_phone'] = $_SESSION['getinjob']['admin_phone'];
           $_SESSION['getinjob_email'] = $_SESSION['getinjob']['admin_email'];
            break;
        case 'Manager':
           $_SESSION['getinjob_name'] = $_SESSION['getinjob']['manager_name'];
           $_SESSION['getinjob_id'] = $_SESSION['getinjob']['manager_id'];
           $_SESSION['getinjob_phone'] = $_SESSION['getinjob']['manager_phone'];
           $_SESSION['getinjob_email'] = $_SESSION['getinjob']['manager_email'];
            break;
        
        default:
            # code...
            break;
    }
}




function Greetings()              //============================ Greetings
{   $hours = date("H");
    if ($hours >= 0 && $hours <= 12) {
        return "Good Morning";
    } else {
        if ($hours > 12 && $hours <= 17) {
            return "Good Afternoon";
        } else {
            if ($hours > 17 && $hours <= 20) {
                return "Good Evening";
            } else {
                return "Good Night";
            }
        }
    }
}

?>