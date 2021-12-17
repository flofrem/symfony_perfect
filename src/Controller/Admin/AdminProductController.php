<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
        /**
        * @Route("/admin/products/", name="admin_list_product")
        */
       public function listProduct(ProductRepository $productRepository)
       {
           $products = $productRepository->findAll();
   
           return $this->render("admin/products.html.twig", ['products' => $products]);
       }
   
       /**
        * @Route("admin/product/{id}", name="admin_show_product")
        */
       public function showProduct(ProductRepository $productRepository, $id)
       {
           $product = $productRepository->find($id);
   
           return $this->render("admin/product.html.twig", ['product' => $product]);
       }
       /**
     * @Route("admin/update/product/{id}", name="product_update")
     */
    public function productUpdate($id,ProductRepository $productRepository, EntityManagerInterface $entityManagerInterface, Request $request

    )
   {
       $product = $productRepository->find($id);
       $productForm = $this->createForm(productType::class, $product);

       $productForm->handleRequest($request);
       if ( $productForm->isSubmitted() && $productForm->isValid()) {
           $entityManagerInterface->persist($product);
           $entityManagerInterface->flush();
       }
       return $this -> render ('admin/productUpdate.html.twig', ['productForm'=> $productForm->createView(),]);
   }
   /**
    * @Route("admin/add/product", name="product_add")
    */
   public function addUpdate( EntityManagerInterface $entityManagerInterface, Request $request

    )
   {
      
       $product = new Product();
       $productForm = $this->createForm(ProductType::class, $product);

       $productForm->handleRequest($request);
       if ($productForm->isSubmitted() && $productForm->isValid()) {
          
           $entityManagerInterface->persist($product);
           $entityManagerInterface->flush();

           return $this->redirectToRoute("admin_list_product");
       }
       return $this -> render ('admin/productUpdate.html.twig', ['productForm'=> $productForm->createView(),]);
   
       

   }
   /**
    * @Route("admin/delete/product/{id}", name="poduct_delete")
    */
   public function deleteProduct( $id, ProductRepository $productRepository, EntityManagerInterface $entityManagerInterface

    )
   {
       $product = $productRepository->find($id);
       $entityManagerInterface->remove($product);
       $entityManagerInterface->flush();
       $this->addFlash(
           'notice',
           'Le produit a été supprimé'
       );

       return $this-> redirectToRoute('admin_list_product');

   }
}

