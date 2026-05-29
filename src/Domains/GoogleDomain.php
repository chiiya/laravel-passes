<?php declare(strict_types=1);

namespace Chiiya\LaravelPasses\Domains;

use Chiiya\LaravelPasses\Google\GoogleClient;
use Chiiya\Passes\Google\JWT;
use Chiiya\Passes\Google\Repositories\EventTicketClassRepository;
use Chiiya\Passes\Google\Repositories\EventTicketObjectRepository;
use Chiiya\Passes\Google\Repositories\FlightClassRepository;
use Chiiya\Passes\Google\Repositories\FlightObjectRepository;
use Chiiya\Passes\Google\Repositories\GenericClassRepository;
use Chiiya\Passes\Google\Repositories\GenericObjectRepository;
use Chiiya\Passes\Google\Repositories\GiftCardClassRepository;
use Chiiya\Passes\Google\Repositories\GiftCardObjectRepository;
use Chiiya\Passes\Google\Repositories\LoyaltyClassRepository;
use Chiiya\Passes\Google\Repositories\LoyaltyObjectRepository;
use Chiiya\Passes\Google\Repositories\OfferClassRepository;
use Chiiya\Passes\Google\Repositories\OfferObjectRepository;
use Chiiya\Passes\Google\Repositories\TransitClassRepository;
use Chiiya\Passes\Google\Repositories\TransitObjectRepository;
use Chiiya\Passes\Google\ServiceCredentials;

class GoogleDomain
{
    protected ?ServiceCredentials $credentials = null;
    protected ?EventTicketClassRepository $eventTicketClassRepository = null;
    protected ?EventTicketObjectRepository $eventTicketObjectRepository = null;
    protected ?FlightClassRepository $flightClassRepository = null;
    protected ?FlightObjectRepository $flightObjectRepository = null;
    protected ?GenericClassRepository $genericClassRepository = null;
    protected ?GenericObjectRepository $genericObjectRepository = null;
    protected ?GiftCardClassRepository $giftCardClassRepository = null;
    protected ?GiftCardObjectRepository $giftCardObjectRepository = null;
    protected ?LoyaltyClassRepository $loyaltyClassRepository = null;
    protected ?LoyaltyObjectRepository $loyaltyObjectRepository = null;
    protected ?OfferClassRepository $offerClassRepository = null;
    protected ?OfferObjectRepository $offerObjectRepository = null;
    protected ?TransitClassRepository $transitClassRepository = null;
    protected ?TransitObjectRepository $transitObjectRepository = null;

    public function __construct(
        protected GoogleClient $client,
    ) {}

    public function eventTicketClasses(): EventTicketClassRepository
    {
        if (! $this->eventTicketClassRepository instanceof EventTicketClassRepository) {
            $this->eventTicketClassRepository = new EventTicketClassRepository($this->client);
        }

        return $this->eventTicketClassRepository;
    }

    public function eventTicketObjects(): EventTicketObjectRepository
    {
        if (! $this->eventTicketObjectRepository instanceof EventTicketObjectRepository) {
            $this->eventTicketObjectRepository = new EventTicketObjectRepository($this->client);
        }

        return $this->eventTicketObjectRepository;
    }

    public function flightClasses(): FlightClassRepository
    {
        if (! $this->flightClassRepository instanceof FlightClassRepository) {
            $this->flightClassRepository = new FlightClassRepository($this->client);
        }

        return $this->flightClassRepository;
    }

    public function flightObjects(): FlightObjectRepository
    {
        if (! $this->flightObjectRepository instanceof FlightObjectRepository) {
            $this->flightObjectRepository = new FlightObjectRepository($this->client);
        }

        return $this->flightObjectRepository;
    }

    public function genericClasses(): GenericClassRepository
    {
        if (! $this->genericClassRepository instanceof GenericClassRepository) {
            $this->genericClassRepository = new GenericClassRepository($this->client);
        }

        return $this->genericClassRepository;
    }

    public function genericObjects(): GenericObjectRepository
    {
        if (! $this->genericObjectRepository instanceof GenericObjectRepository) {
            $this->genericObjectRepository = new GenericObjectRepository($this->client);
        }

        return $this->genericObjectRepository;
    }

    public function giftCardClasses(): GiftCardClassRepository
    {
        if (! $this->giftCardClassRepository instanceof GiftCardClassRepository) {
            $this->giftCardClassRepository = new GiftCardClassRepository($this->client);
        }

        return $this->giftCardClassRepository;
    }

    public function giftCardObjects(): GiftCardObjectRepository
    {
        if (! $this->giftCardObjectRepository instanceof GiftCardObjectRepository) {
            $this->giftCardObjectRepository = new GiftCardObjectRepository($this->client);
        }

        return $this->giftCardObjectRepository;
    }

    public function loyaltyClasses(): LoyaltyClassRepository
    {
        if (! $this->loyaltyClassRepository instanceof LoyaltyClassRepository) {
            $this->loyaltyClassRepository = new LoyaltyClassRepository($this->client);
        }

        return $this->loyaltyClassRepository;
    }

    public function loyaltyObjects(): LoyaltyObjectRepository
    {
        if (! $this->loyaltyObjectRepository instanceof LoyaltyObjectRepository) {
            $this->loyaltyObjectRepository = new LoyaltyObjectRepository($this->client);
        }

        return $this->loyaltyObjectRepository;
    }

    public function offerClasses(): OfferClassRepository
    {
        if (! $this->offerClassRepository instanceof OfferClassRepository) {
            $this->offerClassRepository = new OfferClassRepository($this->client);
        }

        return $this->offerClassRepository;
    }

    public function offerObjects(): OfferObjectRepository
    {
        if (! $this->offerObjectRepository instanceof OfferObjectRepository) {
            $this->offerObjectRepository = new OfferObjectRepository($this->client);
        }

        return $this->offerObjectRepository;
    }

    public function transitClasses(): TransitClassRepository
    {
        if (! $this->transitClassRepository instanceof TransitClassRepository) {
            $this->transitClassRepository = new TransitClassRepository($this->client);
        }

        return $this->transitClassRepository;
    }

    public function transitObjects(): TransitObjectRepository
    {
        if (! $this->transitObjectRepository instanceof TransitObjectRepository) {
            $this->transitObjectRepository = new TransitObjectRepository($this->client);
        }

        return $this->transitObjectRepository;
    }

    /**
     * Create a new JWT.
     */
    public function createJWT(array $payload = []): JWT
    {
        if (! $this->credentials instanceof ServiceCredentials) {
            $this->credentials = ServiceCredentials::parse(config('passes.google.credentials'));
        }

        return new JWT(
            iss: $this->credentials->client_email,
            key: $this->credentials->private_key,
            origins: config('passes.google.origins'),
            payload: $payload,
        );
    }
}
