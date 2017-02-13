<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class DefaultController extends FOSRestController
{
    /**
     * @return mixed
     * @Rest\Get("/app/profile")
     */
    public function profileAction()
    {
        $ctx = new Context();
        $ctx->setGroups(['default']);
        $view = $this->view($this->getUser(),200);
        $view->setContext($ctx);
        return $this->handleView($view);
    }
}
