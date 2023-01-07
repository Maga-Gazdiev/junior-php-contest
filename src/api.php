<?php

namespace App;

use App\Models\User;
use App\Models\Post;
use App\db\DB;
use App\db\connection;

require_once 'Models/PostModel.php';
require_once 'Models/UserModel.php';

class Api
{
    public function connection()
    {
        if($_SERVER['REQUEST_URI'] === "/show/$this->id" && $_SERVER['REQUEST_METHOD'] === "GET") {
            return $this->show($this->id);
        } 
        if($_SERVER['REQUEST_URI'] === "/store" && $_SERVER['REQUEST_METHOD'] === "PUT"){
            return $this->store();
        }
    }

    public function show($id)
    {
        $db = connection\createConnection();
        return $db->exec('SELECT $id FROM Post');
    }

    public function store()
    {
        $db = new User();
        $response = file_get_contents('php://input');
        $connect = json_decode($response,true);
        $db->email($connect["email"]);
        $db->first_name($connect["first_name"]);
        $db->last_name($connect["last_name"]);
        $db->password($connect["password"]);
        $db->save();
        return $db->findOne($response["id"]);
    }
}
