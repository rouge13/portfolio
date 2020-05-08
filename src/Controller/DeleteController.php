<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeleteController extends AbstractController
{

    public function deleteAction(Request $request,$name, $id, SkillRepository $skillRepository,CategoryRepository $categoryRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository){

        $manager = $this->getDoctrine()->getManager();

        switch ($name) {
            case 'skill':
                $skill = $skillRepository->find($id);
                $manager->remove($skill);
                $manager->flush();
                return $this->redirectToRoute('home');
                break;

            case 'category':
                $category = $categoryRepository->find($id);
                $manager->remove($category);
                $manager->flush();
                return $this->redirectToRoute('home');
                break;

            case 'project':
                $project = $projectRepository->find($id);
                $manager->remove($project);
                $manager->flush();
                return $this->redirectToRoute('home');
                break;

            case 'techno':
                $techno = $technoRepository->find($id);
                $manager->remove($techno);
                $manager->flush();
                return $this->redirectToRoute('home');
                break;
        }
        return $this->redirectToRoute('home');

    }

}