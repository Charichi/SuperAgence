<?php
/**
 * Created by PhpStorm.
 * User: Brandero
 * Date: 03/07/2019
 * Time: 16:54
 */

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class propertyController extends AbstractController{

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(){

        $property = $this->repository->findAllVisible();
        dump($property);

        return $this->render('property/index.html.twig',
            ['current_menu' => 'properties']);
    }

    /**
     * @param $id
     * @return Response
     * @Route("/biens/{slug}-{id}", name="property.view", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function view(Property $property, string $slug){
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.view',
                [
                    'id' => $property->getId(),
                    'slug' => $property->getSlug()
                ]
            );
        }
        return $this->render('property/view.html.twig',
            [
                'property' => $property,
                'current_menu' => 'properties'
            ]);
    }

}