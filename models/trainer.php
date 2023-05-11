<?php

class Trainer
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }



    public function insert(MySQLConnector $db)
    {
        $db->query("INSERT INTO trainer (name) VALUES ('$this->name')");
        $this->id = $db->getLastInsertedId();
    }

    static function getAll(MySQLConnector $db)
    {
        $list = [];
        $req = $db->query('SELECT * FROM trainer');

        while ($item = $req->fetch_assoc()) {
            $list[] = new Trainer($item['id'], $item['name']);
        }

        return $list;
    }


    static function get($id, MySQLConnector $db)
    {
        $req = $db->query("SELECT * FROM trainer WHERE id = $id");
        $item = $req->fetch_assoc();

        return new Trainer($item['id'], $item['name']);
    }
}
