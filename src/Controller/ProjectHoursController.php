<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectHoursBookings;
use App\Form\BookHourType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProjectHoursController
 * @package App\Controller
 */
class ProjectHoursController extends AbstractController
{
    /**
     * @return Response
     */
    public function index()
    {
        $projectsHours = $this->getDoctrine()
            ->getRepository(ProjectHoursBookings::class)
            ->findAll();

        return $this->render('projects/hours-overview.html.twig', ['projects_hours' => $projectsHours]);
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Project $project, Request $request)
    {
        $projectBookHours = new ProjectHoursBookings();
        if ($project !== null) {
            $projectBookHours->setProject($project);
        }

        $form = $this->createForm(BookHourType::class, $projectBookHours);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projectBookHours);
            $entityManager->flush();

            $this->addFlash('success', 'Project uren succesvol bijgeboekt.');

            return $this->redirectToRoute('projects_hours_overview');
        }

        return $this->render('projects/project_hours_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
