<?php
namespace App\Common\Permission;
class  Permissions
{
    public static $admin = "admin";
    public static $get = "get";
    public static $create = "create";
    public static $update = "update";
    public static $delete = "delete";

    public static  $user = array(
        "get" => "admin, user-get",
        "create" => "admin, user-create",
        "update" => "admin, user-update",
        "delete" => "admin, user-delete"
    );

    public static $role = array(
        'get' => "admin, role-get",
        'create' => "admin, role-create",
        'update' => "admin, role-update",
        'delete' => "admin, role-delete",
    );

}
