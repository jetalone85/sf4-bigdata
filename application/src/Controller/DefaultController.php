<?php

namespace App\Controller;

use App\Domain\Resource;
use App\Domain\User\Wallet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route(path="/", name="default_index")
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig', []);
    }
}