<?php

namespace App\Controller\Stations;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Stations\StationService;
use App\Service\Trains\TrainService;

#[AsController]
class StationController
{
    #[Route('/getStationList')]
    public function getStationList(StationService $stationService): Response
    {
        $stationList = $stationService->getFilteredStations();

        // Convert array to JSON string
        return new Response(json_encode($stationList), 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    #[Route('/getNextTrains/{stationCode}')]
    public function getNextTrains(string $stationCode, TrainService $trainService): Response
    {
        $nextTrains = $trainService->getFilteredTrains($stationCode);
        
        return new Response(json_encode($nextTrains));
    }
}