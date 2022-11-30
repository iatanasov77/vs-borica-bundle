<?php namespace Vankosoft\Borica\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayAwareInterface;
use Payum\Core\GatewayAwareTrait;
use Payum\Core\Request\Capture;
use Payum\Core\Exception\RequestNotSupportedException;

use Vankosoft\Borica\Request\Api\CreateTransaction;

class CaptureAction implements ActionInterface, GatewayAwareInterface
{
    use GatewayAwareTrait;

    /**
     * {@inheritDoc}
     *
     * @param Capture $request
     */
    public function execute( $request )
    {
        RequestNotSupportedException::assertSupports( $this, $request );

        $model = ArrayObject::ensureArrayObject( $request->getModel() );

        if ( $model['status'] ) {
            return;
        }
        
        $this->gateway->execute( new CreateTransaction( $model ) );
    }

    /**
     * {@inheritDoc}
     */
    public function supports( $request )
    {
        return
            $request instanceof Capture &&
            $request->getModel() instanceof \ArrayAccess
        ;
    }
}
