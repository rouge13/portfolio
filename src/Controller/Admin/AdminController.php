<?php


namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
        public function indexAction(Request $request,SkillRepository $skillRepository ,CategoryRepository $categoryRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository){
        $skills = $skillRepository->findAll();
        $categories = $categoryRepository->findAll();
        $projects = $projectRepository->findAll();
        $technos = $technoRepository->findAll();

        return $this->render('pages/admin/adminHome.html.twig', [
            "categories" =>$categories,
            "skills"=>$skills,
            "projects"=>$projects,
            "technos"=>$technos
        ]);
    }
}