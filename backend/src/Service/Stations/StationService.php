<?php

namespace App\Service\Stations;
use App\Service\ApiClient\ApiClientService;
//import local model for responses:
use App\types\StationModel;

#[AsService]
class StationService 
{

    public function __construct(private ApiClientService $apiClient)
    {

    }

    public function getFilteredStations(): array
    {
        // Get raw data from API
        $rawData = $this->getStationList();
        
        // Filter and process the data
        return $this->processStationData($rawData);
    }
    
    /*
        * Get list of trains
        * Returns array of trains
        * This could be its own service.
        * We could also do separate services -- one for getting a list of stations and one for getting nextTrain
        * And a separate service for configuration!
    */
    private function getStationList(string $lineCode=''): array
    {

        //As $lineCode is optional, the URL will default to simply 'jStations' if no value is passed
        //In the future, this should be present/optional all the way back to the frontend
        $apiString = 'Rail.svc/json/jStations' . $lineCode;

        return $this->apiClient->executeCurl($apiString);
    }
    
    private function processStationData(array $rawData): array
    {
        $filteredStationList = [];
        
        if (isset($rawData[0]['Stations'])) {
            foreach ($rawData[0]['Stations'] as $station) {
                // Filter only active trains
                    $filteredStationList[] = [
                        'station_code' => $station['Code'],
                        'name' => $station['Name'],
                        'line_code_1' => $station['LineCode1'],
                        'line_code_2' => $station['LineCode2'],
                        'line_code_3' => $station['LineCode3'],
                        'line_code_4' => $station['LineCode4']
                    ];
                // }
            }
        }
        
        return $filteredStationList;
    }

}