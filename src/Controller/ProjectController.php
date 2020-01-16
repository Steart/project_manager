<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectHoursBookings;
use App\Form\ProjectType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends SecurityController
{
    /**
     * @return Response
     */
    public function index()
    {
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        return $this->render('projects/overview.html.twig', ['projects' => $projects]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $contact = new Project();
        $form = $this->createForm(ProjectType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Project succesvol toegevoegd.');

            return $this->redirectToRoute('project_index');
        }

        return $this->render('projects/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Project $project, Request $request)
    {
        $test = $project;
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash('success', 'Project succesvol bijgewerkt.');

            return $this->redirectToRoute('project_index');
        }

        return $this->render('projects/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    /**
     * @param Project $project
     * @return Response
     */
    public function detail(Project $project)
    {
        $projectHours = $this->getDoctrine()
            ->getRepository(ProjectHoursBookings::class)
            ->findBy(['project' => $project->getId()]);

        $dedicatedProjectHours = 0;
        if (!empty($projectHours)) {
            foreach ($projectHours as $projectHour) {
                $dedicatedProjectHours += $projectHour->getHours();
            }
        }

        return $this->render('projects/details.html.twig', [
            'project' => $project,
            'project_hours' => $projectHours,
            'dedicated_project_hours' => $dedicatedProjectHours,
        ]);
    }

}