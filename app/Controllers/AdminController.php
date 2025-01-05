<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Config\Database;

class AdminController 
{
   private $AdminModel;
    public function __construct() {
        $database = new Database();
        $this->AdminModel = new AdminModel($database);
    }
    public function index()
    {
        print_r("hello admin");
    }

    public function delete_user($id_user){
        $this->AdminModel->deleteUser($id_user);
        print_r("user deleted ".$id_user);


    }
}