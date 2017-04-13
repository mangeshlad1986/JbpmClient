<?php

namespace Splendoernet\JbpmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SplendoernetJbpmBundle:Default:index.html.twig');
    }
}
