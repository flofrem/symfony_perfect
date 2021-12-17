<?php


namespace App\Controller\Front;

use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController {

     /**
     * @Route("/front/brands/", name="front_list_brand")
     */
    public function listbrand(BrandRepository $brandRepository)
    {
        $brands = $brandRepository->findAll();

        return $this->render("front/brands.html.twig", ['brands' => $brands]);
    }

    /**
     * @Route("front/brand/{id}", name="front_show_brand")
     */
    public function showBrand(BrandRepository $brandRepository, $id)
    {
        $brand = $brandRepository->find($id);
        return $this->render("front/brand.html.twig", ['brand' => $brand]);
    }
}