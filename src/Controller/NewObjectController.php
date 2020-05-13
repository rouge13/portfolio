<?php


namespace App\Controller;


use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class NewObjectController extends AbstractController
{
    public function newObjectAction(Request $request,$name){
        $form = null;
        switch ($name) {
            case 'skill':
                $form = $this->createForm('App\Form\SkillType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $skill = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $skill->setImage($newFilename);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($skill);
                        $manager->flush();
                        $this->addFlash('info',"skill : ".$skill->getName()." well added");
                        return $this->redirectToRoute('home');
                    }
                }
                break;

            case 'category':
                $form = $this->createForm('App\Form\CategoryType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $category = $form->getData();
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($category);
                    $manager->flush();
                    $this->addFlash('info',"category : ".$category->getName()." well added");
                    return $this->redirectToRoute('home');

                }
                break;

            case 'project':
                $form = $this->createForm('App\Form\ProjectType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $project = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $project->setImage($newFilename);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($project);
                        $manager->flush();
                        $this->addFlash('info',"project : ".$project->getName()." well added");
                        return $this->redirectToRoute('home');
                    }
                }
                break;

            case 'techno':
                $form = $this->createForm('App\Form\TechnoType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $techno = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $techno->setImage($newFilename);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($techno);
                        $manager->flush();
                        $this->addFlash('info',"techno : ".$techno->getName()." well added");
                        return $this->redirectToRoute('home');
                    }
                }
                break;
        }
        return $this->render('pages/add.html.twig',["name" => $name ,"form"=>$form->createView()]);

    }
}