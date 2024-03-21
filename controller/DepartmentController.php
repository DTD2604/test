<?php 
require 'model/DepartmentModel.php';
$m = trim($_GET['m'] ?? 'index'); // neu ton tai no se tra ve chinh no con khong no se tra ve index va trim dung de xoa khoang trang 
$m = strtolower($m);
switch($m) {
    case 'index':
        index();
        break;
    case 'add':
        Add();
        break;
    case 'handle-add':
        handleAdd();
        break;
    case 'delete':
        handleDelete();
        break;
    default:
        index();
        break;
}
function handleDelete(){
    $id = trim($_GET['id'] ?? null);
    $delete = deleteDepartmentById($id);
    if($delete){
        header("Location:index.php?c=department&state=delete_success");
    }
    else{
        header("Location:index.php?c=department&state=delete_failure");
    }
}
function handleAdd(){
    if (isset($_POST['btnSave'])){
        $name =trim($_POST['name']??null);
        $name = strip_tags($name);

        $leader = trim($_POST['leader']?? null);
        $leader = strip_tags($leader);

        $status = trim($_POST['status']?? null);
        $status = $status === '0' || $status === '1' ? $status : 0;

        $beginningDate = trim($_POST['beginning_date']?? null);
        $beginningDate = date('Y-m-d', strtotime($beginningDate));
        //check du lieu 
        $_SESSION['error_department'] = [];
        // Tiến hành upload logo của khoa 
        $logo= null;
        $_SESSION['error_department'] ['logo'] = null;
        if(!empty($_FILES['logo']['tmp_name'])) {
            // người dùng thực sự muốn upload logo
            $logo = uploadFile($_FILES['logo'] , 'public/uploads/images/' , ['image/png', 'image/jpg' ,'image/jpeg','image/svg'] , 3*1024*1024);
            if (empty($logo)) {
                $_SESSION['error_department'] ['logo'] = 'Type file is allow .png, .jpg, .jpeg, .svg and size file <= 3Mb';
            }
            else {
                $_SESSION ['error_department'] ['logo']=null;
            }
        }
        if (empty($name)){
            $_SESSION['error_department']['name'] = 'Enter name, please';
        }
        else {
            $_SESSION['error_department']['name']  = null;
        }
        if(empty($leader)){
            $_SESSION['error_department']['leader'] = "Enter name's leader, please";
        }
        else {
            $_SESSION['error_department']['leader'] = null;
        }
        if(!empty( $_SESSION['error_department']['name'])||!empty($_SESSION['error_department']['leader'])||!empty($_SESSION['error_department']['logo'])) {
            //co loi - thong bao ve lai form add
            header("Location:index.php?c=department&m=add&state=fail");
        }
        else {
            //insert vao database
            if(isset($_SESSION['error_department'])) {
                unset($_SESSION['error_department']);
            }
            $insert =insertDepartment($name, $leader , $status , $beginningDate , $logo);
            if ($insert=true) {
                header("Location:index.php?c=department&state=success");
            }
            else {
                header("Location:index.php?c=department&m=add&state=error");
            }
        }
    }
}
function Add(){
    require APP_PATH_VIEW .'departments/add_view.php';
}
function index(){ 
    $department = getAllDataDepartments();
    
    require APP_PATH_VIEW . 'departments/index_view.php';
}