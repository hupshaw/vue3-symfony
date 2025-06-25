<?php

namespace App\Service\Trains;
use App\Service\ApiClient\ApiClientService;

class TrainService 
{
    
    public function __construct(private ApiClientService $apiClient)
    {
    }

    public function getFilteredTrains(string $stationCode): array 
    {
        $rawData = $this->getNextTrains($stationCode);

        return $this->processTrainData($rawData);
    }

    private function getNextTrains(string $stationCode): array 
    {
        $apiString =  'StationPrediction.svc/json/GetPrediction/' . $stationCode;

        return $this->apiClient->executeCurl($apiString);

    }

    private function processTrainData(array $rawData): array 
    {
        $filteredTrainList = [];

        if (isset($rawData[0]['Trains'])) {
            foreach ($rawData[0]['Trains'] as $train) {
                $filteredTrainList[] = [
                    'minutes' => $train['Min']
                ];
            }
        }

        return $filteredTrainList;
    }

}