<?php
namespace App\Core;

use App\Config\Database;

class ResourceModel implements ResourceModelInterface {
    private $table = null;
    private $id = null;
    private $model = null;
    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        // TODO: Implement save() method.
    }

    public function add($model)
    {
        $setCol = '';
        $setVal = '';
        foreach ($model as $col => $val){
            if ($setCol) {
                $setCol .= ",";
            }
            $setCol .=$col;
            if ($setVal) {
                $setVal .= ",";
            }
            $setVal .=":".$col;
        }
        //title, description, created_at, updated_at
        //:title, :description, :created_at, :updated_at
        $sql = "INSERT INTO ".$this->table." (".$setCol.") VALUES (".$setVal.")";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute($model);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM ". $this->table ." WHERE ". $this->id ." =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function update($model, $id) // ['title' => '', 'de' => '' ]
    {
        $set = '';
        foreach ($model as $col => $val) {
            if ($set) {
                $set .= ",";
            }
            $set .= $col .'=:'. $col;
        }
        //title = :title, description = :description
        $sql = "UPDATE " . $this->table. " SET ".$set." WHERE " . $this->id." = ". $id;

        $req = Database::getBdd()->prepare($sql);

        return $req->execute($model);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->table." WHERE ".$this->id." = ". $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

    }
?>
