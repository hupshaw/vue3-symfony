<?php

namespace App\Service\ApiClient;
use Symfony\Component\RateLimiter\RateLimiterFactoryInterface;

class RateLimiter {

    //Documentation taken from https://symfony.com/doc/current/rate_limiter.html

    // if you're using service autowiring, the variable name must be:
    // "rate limiter name" (in camelCase) + "Limiter" suffix
    public function index(Request $request, RateLimiterFactoryInterface $wmataImmediateUseLimiter): Response {
        
        // create a limiter based on a unique identifier of the client
        // (e.g. the client's IP address, a username/email, an API key, etc.)
        $limiterInstant = $wmataImmediateUseLimiter->create($request->getClientIp());

        // the argument of consume() is the number of tokens to consume
        // and returns an object of type Limit
        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException();
        }
    }
}