<?php

namespace App\Controller;

use App\Entity\Plante;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanteController extends AbstractController
{
    /**
     * @Route("/plante", name="plante")
     */
    public function index()
    {
        return $this->render('plante/index.html.twig', [
            'controller_name' => 'PlanteController',
        ]);
    }
        /**
     * @Route("/plante/add", name="plante_add")
     */
    public function add()
    {
        $em = $this->getDoctrine()->getManager();
        //Créer une nouvelle instance de notre class Produit
        $plante = new Plante();
        $plante->setType("Plante interieur");
        $plante->setNom("Bromeliacee");
        $plante->setCouleur("Verte et jaune");
        $plante->setImage("images/plante3.jpg");
        $plante->setPropriete("Plante interieur a votre portee");
        
        $em->persist($plante);
        //flush execute en base et persist fait en équivalent le sql
        $em->flush();
        return $this->render('plante/add.html.twig', [
        ]);
    }
     /**
     * @Route("/plante/list", name="plante_list")
     */
    public function list()
    {
        //méthode qui permet de recuperer les produits de la bdd
        $repo = $this->getDoctrine()->getRepository(Plante::class);
        //$list=tab de données qui retourne les produits à la vue list.html.twig
        $plante = $repo->findAll();
        // dump['produits'];die();
        return $this->render('plante/list.html.twig', ['plante'=>$plante]);
    }
}
