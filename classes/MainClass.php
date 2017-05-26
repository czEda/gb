<?php

class MainClass {

    public function mainMethod() {
        echo $this->Render();
    }

    protected function render() {
        return include("template.phtml");
    }

}