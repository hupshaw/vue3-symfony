<?php

namespace App\Service\ApiClient;

//This service can integrate a RateLimiter when making API calls
use App\Service\ApiClient\RateLimiter;
//We could integrate with Symfony's CacheInterface to cache responses
//use Symfony\Contracts\Cache\CacheInterface;

class ApiClientService
{
    private $headers;

    public function __construct(
        private string $apiKey,
        private string $baseUrl
    ) {
        $this->headers = [
            'api_key: ' . $this->apiKey,
            'Content-Type: application/json'
        ];
    }

    //Could be used to share config information with other Services
    public function getConfig(): array
    {
        return [
            'apiKey' => $this->apiKey,
            'baseUrl' => $this->baseUrl,
        ];
    }

    private function prepApiCall() {
        //check rate limiter and cache
    }

    public function executeCurl(string $apiString) {

        $this->prepApiCall();
        //Concatenate baseURL with specific string of this API call
        $url = $this->baseUrl . $apiString;

        $ch = curl_init();
        
        //set URL from baseURL + unique string of the API call
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        // Only for development. In prod, this would be set to true.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            throw new Exception('cURL Error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        return [
            json_decode($response, true),
            'status_code' => $httpCode
        ];
    }
}