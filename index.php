<?php
// require_once('domain_object/node_role.php');
require_once 'model/role_model.php';
session_start();

// $obj_Role = [];
// $obj_Role[] = new Role(1,"super admin","mengatur admin",1);
// $obj_Role[] = new Role(2,"admin","mengatur kasir",0);
// $obj_Role[] = new Role(3,"kasir","mengatur uang",1);
// $obj_Role[] = new Role(4,"customer","beli barang",1);

// include 'views/role_list.php';

// foreach ($obj_Role as $role){
//     echo "id role :".$role->role_id."<br>";
//     echo "nama role : ".$role->role_name."<br>";
//     echo "nama desc : ".$role->role_desc."<br>";
//     echo "nama status : ".$role->role_status."<br>";
//     echo "<br>";
// }

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}


switch ($modul) {
    case 'dashboard':
        include 'views/kosong.php';
        break;
    case 'role':
        $modelRole = new modelRole();
        if (isset($_GET['fitur'])) {
            $fitur = $_GET['fitur'];
        } else {
            $fitur = null;
        }
        switch ($fitur) {
            case 'add':
                $role_name = $_POST['role_name'];
                $role_desc = $_POST['role_desc'];
                $role_status = $_POST['role_status'];
                $modelRole->addRole($role_name, $role_desc, $role_status);
                header('location:index.php?modul=role');
                break;

            case 'edit':
                if (isset($_GET['role_id'])) {
                    $role_id = $_GET['role_id'];
                    $role = $modelRole->getRoleById($role_id);
                    if ($role === null) {
                        echo "Role dengan ID tersebut tidak ditemukan.";
                        exit; // atau arahkan ke halaman lain
                    }
                    include 'views/role_update.php';
                }
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $role_id = $_POST['role_id'];
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    $modelRole->updateRole($role_id, $role_name, $role_desc, $role_status);
                    header('location:index.php?modul=role');
                }
                break;

            case 'delete':
                if (isset($_GET['role_id'])) {
                    $role_id = $_GET['role_id'];
                    $modelRole->deleteRole($role_id);
                    header('location:index.php?modul=role');
                }
                break;
                
            default:
                $obj_Role = $modelRole->getAllRoles();
                include 'views/role_list.php';
                break;
        }
}
