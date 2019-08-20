<?php
namespace Crisjohn02\Tokener;

use GuzzleHttp\Client;
use http\Exception\RuntimeException;

class Tokener
{

    protected $config;

    function __construct($config)
    {
        if ($this->hasKeys($config, ['id', 'secret', 'username', 'password', 'url'])) {
            $this->config = [
                'client_id' => $config['id'],
                'client_secret' => $config['secret'],
                'username' => $config['username'],
                'password' => $config['password'],
                'scope' => '*',
                'url' => $config['url']
            ];
        } else {
            throw new RuntimeException('Configuration is incomplete');
        }
    }

    public function get()
    {
        $client = new Client();
        $response = $client->post($this->config['url'], [
            'form_params' =>[
                'grant_type' => 'password',
                'client_id' => $this->config['client_id'],
                'client_secret' => $this->config['client_secret'],
                'username' => $this->config['username'],
                'password' => $this->config['password'],
                'scope' => '*'
            ]
        ]);
        $res = \GuzzleHttp\json_decode( (string) $response->getBody());
        return [
            'token' => $res->access_token,
            'refresh_token' => $res->refresh_token
        ];
    }

    private function hasKeys($var, $keys)
    {
        if (is_string($keys)) {
            return isset($var[$keys]);
        }
        if (is_array($keys)) {
            $result = true;
            $keys = array_values($keys);
            foreach ($keys as $key) {
                if (!isset($var[$key])) {
                    $result = false;
                    break;
                }
            }
            return $result;
        }
    }
}
