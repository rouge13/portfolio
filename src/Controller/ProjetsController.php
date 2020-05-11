<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProjetsController extends AbstractController
{
    public function projetsAction(Request $request,$searchId ,$name ,SkillRepository $skillRepository, CategoryRepository $categoryRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository)
    {

        switch ($name) {
            case 'skill':
                $projects = $projectRepository->findBy(
                    array('skill.id' => $searchId), // Critere
                    array('id' => 'desc'),        // Tri
                    3
                );
                break;

            case 'techno':
                $projects = $projectRepository->findBy(
                    array('skill.techno.id' => $searchId), // Critere
                    array('id' => 'desc'),        // Tri
                    3
                );
                break;

            case 'category':
                $projects = $projectRepository->findBy(
                    array('skill.techno.category.id' => $searchId), // Critere
                    array('id' => 'desc'),        // Tri
                    3
                );
                break;


        }
        return $this->render('pages/projets.html.twig', [
            "name" => $name,
            "searchId" => $searchId,
            "projects"=>$projects,


        ]);
    }

}