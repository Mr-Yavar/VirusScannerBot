<?php

namespace nguyenanhung\Tool\DrVirus;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Base
 *
 * @package   nguyenanhung\Tool\DrVirus
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Base
{
    /**
     * @var string - Virus Total API endpoint prefix
     */
    const API_ENDPOINT = 'https://www.virustotal.com/vtapi/v2/';

    /**
     * @var ClientInterface - http client
     */
    protected $_client;

    /**
     * @var string - virus total api key
     */
    protected $_apiKey;

    /**
     * ApiBase constructor.
     *
     * @param         string                   $apiKey
     * @param \GuzzleHttp\ClientInterface|NULL $client
     */
    public function __construct($apiKey, ClientInterface $client = NULL)
    {
        $this->_apiKey = $apiKey;
        if (empty($client)) {
            $this->_client = new Client(array('base_uri' => self::API_ENDPOINT,));
        }
    }

    /**
     * Function parseJson
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:47
     *
     * @param mixed $response
     *
     * @return mixed
     */
    protected function parseJson($response)
    {
        $json = json_decode($response->getBody(), TRUE);

        return $json;
    }

    /**
     * Function makePostRequest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:47
     *
     * @param        $endpoint
     * @param array  $params
     * @param string $type
     *
     * @return mixed
     */
    protected function makePostRequest($endpoint, array $params, $type = 'form_params')
    {
        try {
            $params[$type] = $params;
            $response      = $this->_client->post($endpoint, $params);
            $this->validateResponse($response->getStatusCode());

            return $this->parseJson($response);
        }
        catch (ClientException $e) {
            $this->validateResponse($e->getResponse()->getStatusCode());
        }

        return NULL;
    }

    /**
     * Function makeGetRequest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:47
     *
     * @param       $endpoint
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function makeGetRequest($endpoint, array $params)
    {
        try {
            $url      = self::API_ENDPOINT . $endpoint . '?' . http_build_query($params);
            $response = $this->_client->get($url);
            $this->validateResponse($response->getStatusCode());

            return $response;
        }
        catch (ClientException $e) {
            $this->validateResponse($e->getResponse()->getStatusCode());
        }

        return NULL;
    }

    /**
     * Function validateResponse
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:46
     *
     * @param $statusCode
     */
    protected function validateResponse($statusCode)
    {
        switch ($statusCode) {
            case 204:
                throw new Exceptions\RateLimitException('Too many requests');
            case 403:
                throw new Exceptions\InvalidApiKeyException(sprintf('Key %s is invalid', $this->_apiKey));
            default:
                return;
        }
    }
}
