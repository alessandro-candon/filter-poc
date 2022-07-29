<?php

namespace App\Controller;

use App\Filters\Appliers\RelationshipNameFilter\RelationshipNameFilterApplier;
use App\Filters\Appliers\TestNameFilter\TestNameFilterApplier;
use App\Filters\Appliers\TestWhenDateFilter\TestWhenDateFilterApplier;
use App\Filters\Shared\FilterParams;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(
        Request $request,
        TestRepository $testRepository,
        TestNameFilterApplier $testNameFilterApplier,
        RelationshipNameFilterApplier $relationshipNameFilterApplier,
        TestWhenDateFilterApplier $testWhenDateFilterApplier
    ): Response
    {

        // mi creo una classe che ha all'interno tutti i dati passati
        // attraverso i query params per fare i filtri
        $filterParams = new FilterParams($request->query->all());

        // Aggiungo che tipi di filtro la pia API espone
        // in questo caso ha 2 filtri test e relationship
        $filterParams
            ->addApplier($testNameFilterApplier)
            ->addApplier($relationshipNameFilterApplier)
            ->addApplier($testWhenDateFilterApplier);

        $test = $testRepository->findAllWithFilters($filterParams);

        dd($test);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
