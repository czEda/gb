<?php

class MainClass {

    public function mainMethod() {
        if (isset($_POST['form_name'])) {
            $this->form();
        }

        $dataManager = new DataManager();
        $this->data['messages'] = $dataManager->load();

        echo $this->render();
    }

    protected function render() {
        extract(Clear::clearHtml($this->data));
        return include("template.phtml");
    }

    protected function form() {

        $WebSocketApi = new WebSocketApi();

        if(!empty($_POST['form_name']) && !empty($_POST['form_email']) && !empty($_POST['form_text'])) {

            if (filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)) {

                $Date = time();

                $DataForSocket = [
                    "name" => Clear::clearHtml($_POST['form_name']),
                    "email" => Clear::clearHtml($_POST['form_email']),
                    "text" => Clear::clearHtml($_POST['form_text']),
                    "date" => date("d. m. Y H:i", $Date)
                ];

                $DataManager = new DataManager();

                if ($DataManager->save($_POST['form_name'], $_POST['form_text'], $Date, $_POST['form_email']) && $WebSocketApi->sendSocket('Messages', $DataForSocket)) {
                    exit("ok");
                } else {
                    exit("Chyba při posílání socketu nebo při ukládání dat do databáze!");
                }

            } else {
                exit("Zadaný email není validní!");
            }

        } else {
            exit("Vyplňte všechny položky!");
        }

    }

    protected $data = array();

}