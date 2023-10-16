<?php

namespace PG\MSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Predis\Client;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $redisHost = $this->container->getParameter('redis_host');
        $redisPort = $this->container->getParameter('redis_port');

        // Initialize a Predis client
        $redis = new Client([
            'scheme' => 'tcp',
            'host' => $redisHost,
            'port' => $redisPort,
        ]);
	
	// Send a message to a Redis channel or key
	
        $redis->publish('"greeting"_ack', $name);

        return $this->render('PGMSBundle:Default:index.html.twig', array('name' => $name));
    }
}
