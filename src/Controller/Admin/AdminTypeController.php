<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Repository\TypeRepository;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController extends AbstractController
{
        /**
        * @Route("/admin/types/", name="admin_list_type")
        */
       public function listType(TypeRepository $typeRepository)
       {
           $types= $typeRepository->findAll();
   
           return $this->render("admin/types.html.twig", ['types' => $types]);
       }
   
       /**
        * @Route("admin/type/{id}", name="admin_show_type")
        */
       public function showType(TypeRepository $typeRepository, $id)
       {
           $type = $typeRepository->find($id);
   
           return $this->render("admin/type.html.twig", ['type' => $type]);
       }
       /**
     * @Route("admin/update/type/{id}", name="type_update")
     */
    public function UpdateType($id,TypeRepository $typeRepository, EntityManagerInterface $entityManagerInterface, Request $request

    )
   {
       $type = $typeRepository->find($id);
       $typeForm = $this->createForm(AdminType::class, $type);

       $typeForm->handleRequest($request);
       if ( $typeForm->isSubmitted() && $typeForm->isValid()) {
           $entityManagerInterface->persist($type);
           $entityManagerInterface->flush();
       }
       return $this -> render ('admin/typeUpdate.html.twig', ['typeForm'=> $typeForm->createView(),]);
   }
   /**
    * @Route("admin/add/type", name="type_add")
    */
   public function addUpdate( EntityManagerInterface $entityManagerInterface, Request $request

    )
   {
      
       $type = new Type();
       $typeForm = $this->createForm(AdminType::class, $type);

       $typeForm->handleRequest($request);
       if ($typeForm->isSubmitted() && $typeForm->isValid()) {
          
           $entityManagerInterface->persist($type);
           $entityManagerInterface->flush();

           return $this->redirectToRoute("admin_list_type");
       }
       return $this -> render ('admin/typeUpdate.html.twig', ['typeForm'=> $typeForm->createView(),]);
   
       

   }
   /**
    * @Route("admin/delete/type/{id}", name="type_delete")
    */
   public function deleteType( $id, TypeRepository $typeRepository, EntityManagerInterface $entityManagerInterface

    )
   {
       $type = $typeRepository->find($id);
       $entityManagerInterface->remove($type);
       $entityManagerInterface->flush();
       $this->addFlash(
           'notice',
           'Le type produit a été supprimé'
       );

       return $this-> redirectToRoute('admin_list_type
       ');

   }
}

