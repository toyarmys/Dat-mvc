<?php

namespace App\Controllers;

require "../vendor/autoload.php";

use App\Core\Controller;
use App\Models\Task;
class tasksController extends Controller
{
    function index()
    {
        require "../cli-config.php";
        $productRepository = $entityManager->getRepository(Task::class);
        $task['tasks'] = $productRepository->findAll();
        $this->set($task);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            require "../cli-config.php";
            $task = new Task();
            $title = $_POST["title"];
            $description = $_POST["description"];
            $task->setTitle($title);
            $task->setDescription($description);
            $task->setCreated_at(date('Y-m-d H:i:s'));
            $entityManager->persist($task);
            if (!$entityManager->flush())
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {  
        require "../cli-config.php";
        $task['task'] = $entityManager->find(Task::class, $id);
        //$task['task']  = (array)$task['task'] ;
        if (isset($_POST["title"]))
        {   
            $task['task']->setTitle($_POST["title"]);
            $task['task']->setDescription($_POST["description"]);
            //$task['task']->setCreated_at(date('Y-m-d H:i:s'));
            $task['task']->setUpdated_at(date('Y-m-d H:i:s'));
           
            if (!$entityManager->flush())
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($task);
        $this->render("edit");
    }

    function delete($id)
    {
        require "../cli-config.php";

        $task = $entityManager->getReference(Task::class, $id);
        $entityManager->remove($task);
        if (!$entityManager->flush())
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>