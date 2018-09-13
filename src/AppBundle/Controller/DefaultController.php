<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="homepage")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function indexAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
