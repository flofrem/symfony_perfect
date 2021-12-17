<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Form\BrandType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminBrandController extends AbstractController
{
        /**
        * @Route("/admin/brands/", name="admin_list_brand")
        */
       public function listBrand(BrandRepository $brandRepository)
       {
           $brands= $brandRepository->findAll();
   
           return $this->render("admin/brands.html.twig", ['brands' => $brands]);
       }
   
       /**
        * @Route("admin/brand/{id}", name="admin_show_brand")
        */
       public function showBrand(BrandRepository $brandRepository, $id)
       {
           $brand = $brandRepository->find($id);
   
           return $this->render("admin/brand.html.twig", ['brand' => $brand]);
       }
       /**
     * @Route("admin/update/brand/{id}", name="brand_update")
     */
    public function UpdateBrand($id,BrandRepository $brandRepository, EntityManagerInterface $entityManagerInterface, Request $request)
   {
       $brand = $brandRepository->find($id);
       $brandForm = $this->createForm(BrandType::class, $brand);

       $brandForm->handleRequest($request);
       if ( $brandForm->isSubmitted() && $brandForm->isValid()) {
           $entityManagerInterface->persist($brand);
           $entityManagerInterface->flush();
       }
       return $this -> render ('admin/brandUpdate.html.twig', ['brandForm'=> $brandForm->createView(),]);
   }
  /**
    * @Route("admin/add/brand", name="brand_add")
    */
    public function addUpdate( EntityManagerInterface $entityManagerInterface, Request $request

    )
   {
      
       $brand = new Brand();
       $brandForm = $this->createForm(BrandType::class, $brand);

       $brandForm->handleRequest($request);
       if ($brandForm->isSubmitted() && $brandForm->isValid()) {
          
           $entityManagerInterface->persist($brand);
           $entityManagerInterface->flush();

           return $this->redirectToRoute("admin_list_brand");
       }
       return $this -> render ('admin/brandUpdate.html.twig', ['brandForm'=> $brandForm->createView(),]);
   
    }
   /**
    * @Route("admin/delete/brand/{id}", name="brand_delete")
    */
   public function deleteBrand( $id, BrandRepository $brandRepository, EntityManagerInterface $entityManagerInterface

    )
   {
       $brand = $brandRepository->find($id);
       $entityManagerInterface->remove($brand);
       $entityManagerInterface->flush();
       $this->addFlash(
           'notice',
           'Le type produit a été supprimé'
       );

       return $this-> redirectToRoute('admin_list_brand');

   }
}

       