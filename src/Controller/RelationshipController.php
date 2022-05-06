<?php

namespace App\Controller;

use App\Filters\Appliers\RelationshipNameFilter\RelationshipNameFilterApplier;
use App\Filters\Appliers\TestNameFilter\TestNameFilterApplier;
use App\Filters\Shared\FilterParams;
use App\Repository\RelationshipRepository;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RelationshipController extends AbstractController
{
    #[Route('/relationship', name: 'app_relationship')]
    public function index(
        Request $request,
        RelationshipRepository $relationshipRepository,
        RelationshipNameFilterApplier $relationshipNameFilterApplier
    ): Response
    {
        $filterParams = new FilterParams($request->query->all());

        $filterParams
            ->addApplier($relationshipNameFilterApplier);

        $r = $relationshipRepository->findAllWithFilters($filterParams);

        dd($r);

        return $this->render('relationship/index.html.twig', [
            'controller_name' => 'RelationshipController',
        ]);
    }
}
