<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\Http;
class PulsarService
{
    private $authToken;

    public function __construct($authToken)
    {
        $this->authToken = $authToken;
    }

    public function createTenant($tenantName)
    {
        $apiEndpoint = 'https://product.qa.addissystems.et/pulsar/create-tenant';
        $headers = [
            'x-auth-token' => $this->authToken,
            'Content-Type' => 'application/json',
        ];
        $requestBody = [
            'tenantName' => $tenantName,
        ];
        try {
            $response = Http::withHeaders($headers)->post($apiEndpoint, $requestBody);
            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }
    }
    public function createNamespace($tenantName, $namespaceName){
        $apiEndpoint = 'https://product.qa.addissystems.et/pulsar/create-namespace';
        $headers = [
            'x-auth-token' => $this->authToken,
            'Content-Type' => 'application/json',
        ];
        $requestBody = [
            'tenantName' => $tenantName,
            'namespaceName'=>$namespaceName
        ];
        try {
            $response = Http::withHeaders($headers)->post($apiEndpoint, $requestBody);
            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }

    }
    public function listTenants()
    {
        $apiEndpoint = 'https://product.qa.addissystems.et/pulsar/list-tenants';
        $headers = [
            'x-auth-token' => $this->authToken,
            'Content-Type' => 'application/json',
        ];
        try {
            $response = Http::withHeaders($headers)->get($apiEndpoint, []);

            //dd($response->json());
            return $response->json();
        } catch (\Exception $e) {
                       return [
                'error' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }
    }

    // You can add methods for creating namespace, checking existence, and other Pulsar operations as needed
}
