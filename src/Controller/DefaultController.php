<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Techno;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function indexAction(Request $request, SkillRepository $skillRepository,CategoryRepository $categoryRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository){
        $skills = $skillRepository->findAll();
        $categories = $categoryRepository->findAll();
        $projects = $projectRepository->findAll();
        $technos = $technoRepository->findAll();

        //on déclare un nouveaujob (vide)
        $category = new Category();
        //un créé un nouveau formulaire basé sur une entity (dans ce cas, c'est un job)
        $categoryform = $this->createForm('App\Form\CategoryType',$category);
        //on dit au formulaire d'écouter les envois de request
        $categoryform->handleRequest($request);

        $skill = new Skill();
        $skillForm = $this->createForm('App\Form\SkillType', $skill);
        $skillForm->handleRequest($request);

        $project = new Project();
        $projectForm = $this->createForm('App\Form\ProjectType', $project);
        $projectForm->handleRequest($request);

        $techno = new Techno();
        $technoForm = $this->createForm('App\Form\TechnoType', $techno);
        $technoForm->handleRequest($request);

        //si le formulaire est envoyé, alors faire le code dans le if
        if($categoryform->isSubmitted()){
            //hydrater mon entity (qui pour le moment est vide) avec les infos de mon formulaire
            $category = $categoryform->getData();
            //je récupère le manager pour pouvoir sauvegarder mon entity dans la base de données
            $manager = $this->getDoctrine()->getManager();
            //je demande a Doctrine de préparer la sauvegarde de mon entity category
            $manager->persist($category);
            //j'exécute la sauvegarde de mon entity category
            $manager->flush();
            //je redirige vers la route de mon choix (dans ce cas, c'est la route qui a le nom 'home'
            return $this->redirectToRoute('home');
        }


        if($skillForm->isSubmitted()) {
            $skill = $skillForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($skill);
            $manager->flush();
            return $this->redirectToRoute('home');
        }


        if($projectForm->isSubmitted()) {
            $project = $projectForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($project);
            $manager->flush();
            return $this->redirectToRoute('home');
        }


        if($technoForm->isSubmitted()) {
            $techno = $technoForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($techno);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home.html.twig', [
            "categories" =>$categories, "categoryForm"=>$categoryform->createView(),
            "skills"=>$skills, "skillForm"=>$skillForm->createView(),
            "projects"=>$projects, "projectForm"=>$projectForm->createView(),
            "technos"=>$technos, "technoForm"=>$technoForm->createView()
        ]);
    }
}