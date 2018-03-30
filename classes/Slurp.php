<?php

namespace slurp;

use GuzzleHttp\Client;

class Slurp {

	// bring user config options + CLI parameters
	function __construct($config, $params) {
		$this->config = $config;
		$this->params = $params;
	}

	// main functionality
	public function run() {

		if(!isset($this->params[1])) {
			return "Missing URL parameter \n";
		}

		$url = $this->params[1];
		$directory = getcwd(). "/" . $this->config->directory . "/";

		$client = new client([
			'base_uri' => $url,
			'timeout' => 2
		]);

		$response = $client->request('GET');
		$body = $response->getBody();

		file_put_contents($directory . parse_url($url,  PHP_URL_HOST) . ".html", (string) $body);

		return "huzzah! \n";
	}
}