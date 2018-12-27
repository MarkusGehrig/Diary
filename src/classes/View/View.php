<?php

namespace MarkusGehrig\Diary\View;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class View {
    private $path = "template";

    private $twig;

    private $template;

    public function __construct($cache = false) {
        $loader = new Twig_Loader_Filesystem($path);
        $loader->addPath($this->path, '__main__');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => $cache,
        ));
    }

    public function setTemplate($file) {
        $this->template = $this->twig->load($file);
        return $this;
    }

    public function render($parameter) {
        return $this->template->render((array) $parameter);
    }
}