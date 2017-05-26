<?php

class WebSocketApi {

    private $password = "d$0awd6$5ZVawdIhlawdZJr8xwadtRFnSlbRX2.$2a$0awd6$5ZVIhawdlZJwdr8xtRFnS72lbRX2.Dsylt5.YSi1BzzqawdBt3rsBawdxYQMYIqsFe",
    $ip = "localhost",
    $port = 4000;

    public function sendSocket($channel, $data) {
        $Url = "http://$this->ip:$this->port";

        $ch = curl_init();

        $POST = ["channel" => $channel, "password" => $this->password, "data" => json_encode($data, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT)];

        $POST_string = null;

        foreach ($POST as $key => $value) {
            $POST_string .= $key. '='.$value.'&';
        }
        rtrim($POST_string, '&');

        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($POST));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POST_string);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response == "true";
    }
}