<?php

class MainClass {

    public function mainMethod() {

        $WebSocketApi = new WebSocketApi();
        if ($WebSocketApi->sendSocket("Test", ["name" => "Patrik", "message" => "testing"]) === true) {
            echo("Povedlo se! Nodejs vrací true!");
        } else {
            echo("Něco se nepovedlo! Node.js nevrací true!");
        }

        echo $this->render();
    }

    protected function render() {
        return include("template.phtml");
    }

}