<?php

namespace WHMCS\Module\Addon\Verifyemail\Client;

class Verifyemailclient {

    public function dispatch($action, $parameters)
    {
        if (!$action) {
            $action = 'index';
        }

        $controller = new outputclient();

        if (is_callable(array($controller, $action))) {
            return $controller->$action($parameters);
        }
    }
}
