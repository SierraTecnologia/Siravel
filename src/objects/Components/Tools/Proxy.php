<?php

namespace App\Logic\Tools;

/**
 * @author Ricardo Sierra <ricardo@sierratecnologia.com>
 */
class Proxy
{

    /**
     * @var Builder
     */
    protected $useTor = true;

    /**
     * @var Url
     */
    protected $url;

	function __construct() {

		$torSocks5Proxy = "socks5://127.0.0.1:9050";

		$this->ch = curl_init();

		curl_setopt( $this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5 );
		curl_setopt( $this->ch, CURLOPT_PROXY, $torSocks5Proxy );
		curl_setopt( $this->ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $this->ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, false );
		curl_setopt( $this->ch, CURLOPT_HEADER, false );

	}

	public function curl( $url, $postParameter = null ) {

		if( sizeof( $postParameter ) > 0 )
			curl_setopt( $this->ch, CURLOPT_POSTFIELDS, $postParameter );

		curl_setopt( $this->ch, CURLOPT_URL, $url );
		return curl_exec( $this->ch );

	}

	function __destruct() {

		curl_close( $this->ch );

	}

    /**
     * @param string $url
     *
     * @return string
     */
    protected function get($url)
    {
        $torSocks5Proxy = "socks5://127.0.0.1:9050";

		$this->ch = curl_init();

        if ($this->useTor) {
            curl_setopt( $this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5 );
            curl_setopt( $this->ch, CURLOPT_PROXY, $torSocks5Proxy );
        }
        curl_setopt( $this->ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $this->ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, false );
		curl_setopt( $this->ch, CURLOPT_HEADER, false );
    }
}
