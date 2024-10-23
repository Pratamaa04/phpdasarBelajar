<?php
require_once('domain_object/node_role.php');

$obj_Role = [];
$obj_Role[] = new Role(1,"super admin","mengatur admin",1);
$obj_Role[] = new Role(2,"admin","mengatur kasir",0);
$obj_Role[] = new Role(3,"kasir","mengatur uang",1);
$obj_Role[] = new Role(4,"customer","beli barang",1);

include 'views/role_list.php';

foreach ($obj_Role as $role){
    echo "id role :".$role->role_id."<br>";
    echo "nama role : ".$role->role_name."<br>";
    echo "nama desc : ".$role->role_desc."<br>";
    echo "nama status : ".$role->role_status."<br>";
    echo "<br>";
}
?>