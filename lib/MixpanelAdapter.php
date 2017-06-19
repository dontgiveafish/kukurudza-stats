<?php

class MixpanelAdapter
{
    protected $guzzle, $jql_path;

    public function __construct($secret, $jql_path = false)
    {
        $this->guzzle = new \GuzzleHttp\Client([
            'base_uri' => 'https://mixpanel.com/api/2.0/jql',
            'auth' => [$secret, ''],
        ]);

        $this->jql_path = $jql_path;
    }

    public function get($script, array $params = [])
    {
        // get jql template from file

        $jql = file_get_contents("{$this->jql_path}/{$script}.js");
        if (empty($jql)) {
            throw new \Exception("JQL script file '{$script}' not found");
        }

        // replace params for a values

        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $search = '$' . $param;
                $replace = json_encode($value);
                $jql = str_replace($search, $replace, $jql);
            }
        }

        //

        $response = $this->guzzle->post('', [
            'form_params' => [
                'script' => $jql,
            ],
        ]);

        // get answer and decode

        $str = $response->getBody()->getContents();
        $answer = json_decode($str, true);

        return $answer;
    }
}