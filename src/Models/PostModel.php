<?php

namespace App\Models;

use App\db\connection;

class Post
{
  public $id;
  public $title;
  public $body;
  public $last_name;
  public $creator_id;
  public $created_at;

  public function id($id)
  {
    $this->id = $id;
  }

  public function title($title)
  {
    $this->title = $title;
  }

  public function body($body)
  {
    $this->body = $body;
  }

  public function last_name($last_name)
  {
    $this->last_name = $last_name;
  }

  public function creator_id($creator_id)
  {
    $this->creator_id = $creator_id;
  }

  public function created_at()
  {
    $this->created_at = date_default_timezone_set('UTC');
  }

  public function save()
  {
    $db = connection\createConnection();

    $db->exec('INSERT INTO post (id, title, body, last_name, creator_id, created_at) 
        VALUES ($this->id($this->id), $this->title($this->title), $this->body($this->body), 
        $this->last_name($this->last_name), $this->creator_id($this->creator_id), $this->created_at())');
  }

  public function all()
  {
    $db = connection\createConnection();
    return $db->exec('SELECT * FROM User');
  }

  public function findOne($id = false)
  {
    $db = connection\createConnection();
    if ($id === null) {
      return $db->exec('');
    }
    return $db->exec('SELECT FROM User WHERE id = $id AND $id != null');
  }

  public function delete($id = false)
  {
    $db = connection\createConnection();
    return $db->exec('DELETE FROM User WHERE id = $id AND $id != false');
  }
}
