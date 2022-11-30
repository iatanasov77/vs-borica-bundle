<?php namespace Vankosoft\Borica;

class Keys
{
    /**
     * @var string
     */
    protected $terminalId;

    /**
     * @var string
     */
    protected $privateKey;
    
    /**
     * @var string
     */
    protected $publicCert;

    /**
     * @param string $terminalId
     * @param string $privateKey
     */
    public function __construct( string $terminalId, string $privateKey, string $publicCert )
    {
        $this->terminalId   = $terminalId;
        $this->privateKey   = $privateKey;
        $this->publicCert   = $publicCert;
    }

    /**
     * @return string
     */
    public function getTerminalId()
    {
        return $this->terminalId;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }
    
    /**
     * @return string
     */
    public function getPublicCert()
    {
        return $this->publicCert;
    }
}
