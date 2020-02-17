<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class PublisherController extends AbstractController
{
    /**
     * @Route("/publish", name="publish", methods={"POST"})
     * @param Request $request
     * @param Publisher $publisher
     * @return Response
     */
    public function publish(Request $request, Publisher $publisher): Response
    {
        $data = json_decode($request->getContent());

        $update = new Update(
            'http://chat.localhost',
            json_encode(
                [
                    'message' => $data->message
                ]
            )
        );

        // The Publisher service is an invokable object
        $publisher($update);

        return new Response('published!');
    }
}
