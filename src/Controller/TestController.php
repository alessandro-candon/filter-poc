<?php

namespace App\Controller;

use App\Filters\Appliers\RelationshipNameFilter\RelationshipNameFilterApplier;
use App\Filters\Appliers\TestNameFilter\TestNameFilterApplier;
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
        RelationshipNameFilterApplier $relationshipNameFilterApplier
    ): Response
    {

        $filterParams = new FilterParams($request->query->all());

        $filterParams
            ->addApplier($testNameFilterApplier)
            ->addApplier($relationshipNameFilterApplier);

        $test = $testRepository->findAllWithFilters($filterParams);

        dd($test);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
