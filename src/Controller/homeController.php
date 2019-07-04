<?php
/**
 * Created by PhpStorm.
 * User: Brandero
 * Date: 03/07/2019
 * Time: 16:54
 */

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController{

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository){
        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', ['properties' => $properties]);
    }

}