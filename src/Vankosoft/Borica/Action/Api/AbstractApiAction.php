<?php namespace Vankosoft\Borica\Action\Api;

use Payum\Core\Action\ActionInterface;
use Payum\Core\ApiAwareInterface;
use Payum\Core\ApiAwareTrait;
use Payum\Core\GatewayAwareTrait;

use Vankosoft\Borica\Keys;
use Vankosoft\BoricaApi\Factory;
use Vankosoft\BoricaApi\Request;
use Vankosoft\BoricaApi\Response;

class AbstractApiAction implements ActionInterface, ApiAwareInterface
{
    use ApiAwareTrait {
        setApi as _setApi;
    }
    use GatewayAwareTrait;
    
    public function __construct()
    {
        $this->apiClass = Keys::class;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setApi( $api )
    {
        $this->_setApi( $api );
    }

    /**
     * Manual: https://github.com/mirovit/borica-api
     */
    private function getBoricaFactory()
    {
        $factory = new Factory(
            new Request(
                $this->api->getTerminalId(),
                $this->api->getPrivateKey(),
            ),
            new Response( $this->api->getPublicCert() )
        );
        
        return $factory;
    }
}