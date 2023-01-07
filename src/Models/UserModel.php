<?php

namespace App\Models;

use App\db\connection;

class User
{
  public $id;
  public $email;
  public $first_name;
  public $last_name;
  public $password;

  public function id($id)
  {
    $this->id = $id;
  }

  public function email($email)
  {
    $this->email = $email;
  }

  public function title($title)
  {
    $this->title = $title;
  }

  public function first_name($first_name)
  {
    $this->first_name = $first_name;
  }

  public function last_name($last_name)
  {
    $this->last_name = $last_name;
  }

  public function password($password)
  {
    $this->password = $password;
  }

  public function created_at()
  {
    $this->created_at = date_default_timezone_set('UTC');
  }

  public function save()
  {
    $db = connection\createConnection();

    $email = $this->email($this->email);
    $first_name = $this->first_name($this->first_name);
    $last_name = $this->last_name($this->last_name);
    $password = $this->password($this->password);
    $created_at = $this->created_at();

    $users = <<<HEREDOC
    INSERT INTO users (email, first_name, last_name, password, created_at) 
    VALUES ($email, $first_name, $last_name, $password, $created_at);
    HEREDOC;

    $db->exec($users);
  }

  public function all()
  {
    $db = connection\createConnection();
    return $db->exec('SELECT * FROM Post');
  }

  public function findOne($id = null)
  {
    $db = connection\createConnection();
    if ($id === null) {
      return $db->exec('');
    }
    return $db->exec('SELECT FROM Post WHERE id = $id AND $id != null');
  }

  public function delete($id = false)
  {
    $db = connection\createConnection();
    return $db->exec('DELETE FROM Post WHERE id = $id AND $id != false');
  }
}
