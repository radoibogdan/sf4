<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * On déclare des routes avec des annotations Route
     *
     * URL: localhost/route
     * URI: /route
     *
     * @Route("/", name="home")
     */
    public function index()
    {
        # templates/        home.html.twig
        return $this->render('home.html.twig', [
            'pseudo' => 'John Doe',
            'liste' => [
                'foo',
                'bar',
                'baz',
            ]
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(EntityManagerInterface $em)
    {
        // Création d'une entité
        $product = new Product();
        $product
            ->setName('Jeans')
            ->setDescription('Un super jean !')
            ->setPrice(79.99)
            ->setQuantity(50)
        ;

        // L'entité n'est pas encore enregistré en base
        dump($product);

        // Enregistrement (insertion)
        // 1. Préparer à l'enregistrement d'une entité (persist ou remove)
        $em->persist($product);
        // 2. Exécuter les requêtes SQL
        $em->flush();

        // fonction de debug: dump() & die;
        dd($product);
    }
}