<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function add()
    {
        return $this->render('product/add.html.twig');
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
