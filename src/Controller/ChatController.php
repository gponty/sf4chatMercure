<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/", name="chat")
     */
    public function index()
    {
        return $this->render('chat.html.twig');
    }
}
