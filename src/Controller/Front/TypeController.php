<?php


namespace App\Controller\Front;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController {

     /**
     * @Route("/front/types/", name="front_list_type")
     */
    public function listType(TypeRepository $typeRepository)
    {
        $types = $typeRepository->findAll();

        return $this->render("front/types.html.twig", ['types' => $types]);
    }

    /**
     * @Route("front/type/{id}", name="front_show_type")
     */
    public function showType(TypeRepository $typeRepository, $id)
    {
        $type = $typeRepository->find($id);

        return $this->render("front/type.html.twig", ['type' => $type]);
    }
}