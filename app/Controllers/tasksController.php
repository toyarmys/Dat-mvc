<?php
namespace App\Controllers;

require "../vendor/autoload.php";

use App\Core\Controller;
use App\Models\Task ;
use App\Models\TaskModel;
use App\Models\TaskRepository;

class tasksController extends Controller
{
    private $taskRepository = null;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    function index()
    {
        $tasks = $this->taskRepository->getAll();

        $d['tasks'] = $tasks;
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            if ($this->taskRepository->add([
                'title' => $_POST["title"],
                'description' => $_POST["description"]
            ]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        // require(ROOT . 'app/Models/Task.php');

        $d["task"] = $this->taskRepository->get($id);

//        $pẻopẻtie = $task->getProperties(); // ['id' => 1, 'task' => task1, ///]


        if (isset($_POST["title"]))
        {
            if ($this->taskRepository->update([
                'title' => $_POST["title"],
                'description' => $_POST["description"]
            ], $id))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
    //    require(ROOT . 'app/Models/Task.php');

        if ($this->taskRepository->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>