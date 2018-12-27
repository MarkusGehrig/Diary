<?php

namespace MarkusGehrig\Diary\Controller;

use MarkusGehrig\Diary\Controller\AbstractViewController;

class DashboardController extends AbstractViewController
{
    public function __construct()
    {
        parent::__construct();    
    }

    public function show()
    {
        return $this->render(null);
    }
}

