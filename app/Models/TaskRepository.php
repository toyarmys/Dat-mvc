<?php
    namespace App\Models;
    use App\Models\TaskResourceModel;
    class TaskRepository{
        public $resouceModel = null;
        public function __construct()
        {
            $this->resouceModel = new TaskResourceModel();
        }

        public function add($model) {
            return $this->resouceModel->add($model);
        }

        public function getAll() {
            return $this->resouceModel->getAll();
        }
        public function get($id) {
            return $this->resouceModel->get($id);
        }
        public function update($model, $id) {
            return $this->resouceModel->update($model, $id);
        }
        public function delete($id) {
            return $this->resouceModel->delete($id);
        }

    }
?>