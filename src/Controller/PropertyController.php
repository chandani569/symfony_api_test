<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\MergedApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PropertyController extends AbstractController
{
    private MergedApiService $mergedApiService;

    public function __construct(MergedApiService $mergedApiService)
    {
        $this->mergedApiService = $mergedApiService;
    }

    #[Route('/api/properties', name: 'get_properties', methods: ['GET'])]
    #[IsGranted("ROLE_USER")]
    public function getProperties(Request $request, PaginatorInterface $paginator): JsonResponse
    {
        $properties = $this->mergedApiService->fetchAndMergeData();

        $pagination = $paginator->paginate(
            $properties,
            $request->query->getInt('page', 1),
            10
        );

        return $this->json([
            'current_page' => $pagination->getCurrentPageNumber(),
            'total_items' => $pagination->getTotalItemCount(),
            'total_pages' => ceil($pagination->getTotalItemCount() / 10),
            'data' => $pagination->getItems(),
        ]);
    }
}