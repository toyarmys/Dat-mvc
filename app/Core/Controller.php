<?php
namespace App\Core;

    class Controller
    {
        var $vars = [];
        var $layout = "default";

        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

     
        function render($filename)
        {
            extract($this->vars);
            ob_start();
            require(ROOT . "app/Views/" . ucfirst(str_replace('Controller', '', substr(strrchr(get_class($this), "\\"), 1))) . '/' . $filename . '.php');
            //strrchr(get_class($this), "\\") phan tu cuoi sau dau \ ... kq: \tasksController
            //substr(strrchr(get_class($this), "\\"), 1) loai bo dau \ .. kq: tasksController
            //str_replace('Controller', '', substr(strrchr(get_class($this), "\\"), 1)) thay the 'Controller' = '' ... kq: tasks
            //ucfirst : viet hoa chu cai dau ... kq : Tasks

            $content_for_layout = ob_get_clean();

            if ($this->layout == false)
            {
                $content_for_layout;
            }
            else
            {
                require(ROOT . "app/Views/Layouts/" . $this->layout . '.php');
            }
        }

        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }

    }
?>