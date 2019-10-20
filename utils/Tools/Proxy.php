<?php

namespace SiUtils\Tools;

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
	
	public static $agents = [
		'GoogleBot' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'
	];

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
	
	public static function getOpts($proxy = false)
	{
		$opts = [
			//Set the timeout time in seconds
			'timeout' => 30,
			// Fake HTTP headers
			'headers' => [
				// 'Referer' => 'https://querylist.cc/',
				'User-Agent' => self::$agents['GoogleBot'],
				// 'Accept'     => 'application/json',
				// 'X-Foo'      => ['Bar', 'Baz'],
				// 'Cookie'    => 'abc=111;xxx=222'
			]
		];

		// Set the http proxy
		if ($proxy) {
			$opts['proxy'] = 'http://222.141.11.17:8118';
		}
		return $opts;
	}
}
