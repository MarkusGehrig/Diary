<?php

namespace MarkusGehrig\Diary\Controller;

use MarkusGehrig\Diary\Controller\AbstractController;
use MarkusGehrig\Diary\View\View;

class AbstractViewController extends AbstractController {
    
    private $view;

    private $template = '';

    public function __construct($cache = false)
    {
        parent::__construct();
        $this->template = $this->get_class_name(get_class($this)) . '.twig';
        $this->view = new View($cache);
    }

    public function run()
    {
        return $this->show();
    }

    public function show()
    {

    }

    public function render($parameter) {
        return ($this->view->setTemplate($this->template)->render($parameter));
    }

    function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return $pos;
    }
}