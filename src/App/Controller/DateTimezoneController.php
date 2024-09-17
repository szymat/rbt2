<?php

declare(strict_types=1);

namespace App\Controller;

use Application\DTO\DateInfoDTO;
use Application\Form\DateInfoType;
use Domain\DateTimezone\Service\DateInfoServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateTimezoneController extends AbstractController
{
    private DateInfoServiceInterface $dateInfoService;

    public function __construct(DateInfoServiceInterface $dateInfoService)
    {
        $this->dateInfoService = $dateInfoService;
    }

    /**
     * @Route("/timezone", name="app_datetimezone")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(DateInfoType::class);
        $form->handleRequest($request);

        $dateInfo = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $dateInfoDTO = $form->getData();
            /** @var DateInfoDTO $dateInfoDTO */

            try {
                $dateInfo = $this->dateInfoService->processDateInfo($dateInfoDTO->getDateTime(), $dateInfoDTO->getDateTimezone());
            } catch (\Exception $e) {
                $this->addFlash('error', 'Invalid date or timezone provided. Please try again.');
            }
        }

        return $this->render('date-timezone/index.html.twig', [
            'form' => $form->createView(),
            'dateInfo' => $dateInfo,
        ]);
    }
}
