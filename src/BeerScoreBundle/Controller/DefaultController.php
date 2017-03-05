<?php

namespace BeerScoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BeerScoreBundle:Default:index.html.twig');
    }
}
