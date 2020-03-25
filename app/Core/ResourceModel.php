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
        $Column = '';
        $Value = '';
        foreach ($model as $col => $val){
            if ($Column) {
                $Column .= ",";
            }
            $Column .=$col;
            if ($Value) {
                $Value .= ",";
            }
            $Value .=":".$col;
        }
        //title, description, created_at, updated_at
        //:title, :description, :created_at, :updated_at
        $sql = "INSERT INTO ".$this->table." (".$Column.") VALUES (".$Value.")";

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
        $update = '';
        foreach ($model as $col => $val) {
            if ($update) {
                $update .= ",";
            }
            $update .= $col .'=:'. $col;
        }
        //title = :title, description = :description
        $sql = "UPDATE " . $this->table. " SET ".$update." WHERE " . $this->id." = ". $id;

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
