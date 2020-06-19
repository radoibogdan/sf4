<?php

namespace App\Controller;

use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * Liste des produits
     * @Route("/product", name="product_list")
     */
    public function list(ProductRepository $repository)
    {
        /* 
        
        // Récupérer toutes les entités
        $result1 = $repository->findAll(); // produits ou array vide

        // Récupérer plusieurs entités en fonction d'un filtre
        $result2 = $repository->findBy(['id'=>1]); // produits ou array vide

        // Récupérer une entité par son ID
        $result3 = $repository->find(1); // produit ou null

        // Récupérer une entité par son ID
        $result3 = $repository->findOneBy(['id'=>1]); // produit ou null 
        
        */

        return $this->render('product/list.html.twig',[
            'product_list' => $repository->findAll()
        ]);
    }

    /**
     * Ajout d'un produit
     * @Route("/product/new", name="product_add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        // Création du formulaire
        $productForm = $this->createForm(ProductFormType::class);

        // Request => permet de récupérer les infos dans le $_POST
        // On passe la requête au formulaire
        $productForm->handleRequest($request);

        // On vérifie que le formulaire est envoyé et valide
        if ($productForm->isSubmitted() && $productForm->isValid()){
            // On récupère les données du formulaire qui seront envoyées
            $product = $productForm->getData();
            $em->persist($product); // comme le git commit
            $em->flush();
            // Redirection sur la liste des produits
            return $this->redirectToRoute('product_list'); // eviter les URI, mettre les noms des routes
        }

        return $this->render('product/add.html.twig',[
            'product_form' => $productForm->createView()
        ]);
    }

    /**
     * Modification d'un produit
     * @Route("/product/{id}/edit", name="product_edit")
     */
    public function edit($id)
    {
        return $this->render('product/edit.html.twig');
    }

}
