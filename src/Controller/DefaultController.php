<?php


namespace App\Controller;


use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function indexAction(SkillRepository $skillRepository){
        $skills = $skillRepository->findAll();
        return $this->render('home.html.twig', ["skills" => $skills]);
    }
}