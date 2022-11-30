<?php namespace Vankosoft\Borica;

use Vankosoft\Borica\Action\AuthorizeAction;
use Vankosoft\Borica\Action\CancelAction;
use Vankosoft\Borica\Action\ConvertPaymentAction;
use Vankosoft\Borica\Action\CaptureAction;
use Vankosoft\Borica\Action\NotifyAction;
use Vankosoft\Borica\Action\RefundAction;
use Vankosoft\Borica\Action\StatusAction;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

class BoricaGatewayFactory extends GatewayFactory
{
    /**
     * {@inheritDoc}
     */
    protected function populateConfig( ArrayObject $config )
    {
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
            $config['payum.required_options'] = [];

            $config['payum.api'] = function ( ArrayObject $config ) {
                $config->validateNotEmpty( $config['payum.required_options'] );

                return new Api( (array) $config, $config['payum.http_client'], $config['httplug.message_factory'] );
            };
        }
    }
}
