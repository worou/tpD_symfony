<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController{

    /**
     * @Route("/", name="home_page")
     */
    public function default(){
        return new Response('Hello!');
    }
}