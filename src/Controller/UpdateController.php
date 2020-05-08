<?php


namespace App\Controller;




use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UpdateController extends AbstractController
{

    public function updateController(Request $request,$name, $id, SkillRepository $skillRepository,CategoryRepository $categoryRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository){

        $form = null;
        $manager = $this->getDoctrine()->getManager();

        switch ($name) {
            case 'skill':
                $skill = $skillRepository->find($id);
                $form = $this->createForm('App\Form\SkillType',$skill);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $skill = $form->getData();
                    $manager->persist($skill);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;

            case 'category':
                $category = $categoryRepository->find($id);
                $form = $this->createForm('App\Form\CategoryType',$category);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $category = $form->getData();
                    $manager->persist($category);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;

            case 'project':
                $project = $projectRepository->find($id);
                $form = $this->createForm('App\Form\ProjectType',$project);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $project = $form->getData();
                    $manager->persist($project);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;

            case 'techno':
                $techno = $technoRepository->find($id);
                $form = $this->createForm('App\Form\TechnoType',$techno);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $techno = $form->getData();
                    $manager->persist($techno);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;
        }
        return $this->render('pages/update.html.twig',["id"=>$id, "name" =>$name ,"form"=>$form->createView()]);

    }

}