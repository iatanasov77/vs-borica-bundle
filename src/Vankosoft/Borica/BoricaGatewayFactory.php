<?php namespace Vankosoft\Borica;

use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

use Vankosoft\Borica\Action\AuthorizeAction;
use Vankosoft\Borica\Action\CancelAction;
use Vankosoft\Borica\Action\ConvertPaymentAction;
use Vankosoft\Borica\Action\CaptureAction;
use Vankosoft\Borica\Action\NotifyAction;
use Vankosoft\Borica\Action\RefundAction;
use Vankosoft\Borica\Action\StatusAction;

class BoricaGatewayFactory extends GatewayFactory
{
    /**
     * {@inheritDoc}
     */
    protected function populateConfig( ArrayObject $config )
    {
        /*
         * I dont know which actions are needed for now
         */
        $config->defaults([
            'payum.factory_name'            => 'borica',
            'payum.factory_title'           => 'Borica',
            'payum.action.capture'          => new CaptureAction(),
            'payum.action.authorize'        => new AuthorizeAction(),
            'payum.action.refund'           => new RefundAction(),
            'payum.action.cancel'           => new CancelAction(),
            'payum.action.notify'           => new NotifyAction(),
            'payum.action.status'           => new StatusAction(),
            'payum.action.convert_payment'  => new ConvertPaymentAction(),
        ]);

        if ( false == $config['payum.api'] ) {
            $config['payum.default_options'] = [
                'sandbox'       => true,
                'terminal_id'   => '',
                'private_key'   => 'path/to/private.key',
                'public_cert'   => 'path/to/public.cer'
            ];
            $config->defaults( $config['payum.default_options'] );
            $config['payum.required_options'] = ['terminal_id', 'private_key', 'public_cert'];

            $config['payum.api'] = function ( ArrayObject $config ) {
                $config->validateNotEmpty( $config['payum.required_options'] );

                return new Keys( $config['terminal_id'], $config['private_key'], $config['public_cert'] );
            };
        }
    }
}
