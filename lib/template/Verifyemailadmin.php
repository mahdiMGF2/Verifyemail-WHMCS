<?php

namespace WHMCS\Module\Addon\Verifyemail\template;
class Verifyemailadmin {

    public function verioutput($action, $parameters)
    {
        if (!$action) {
            $action = 'index';
        }

        $outputemail = new outputemail();

        if (is_callable(array($outputemail, $action))) {
            return $outputemail->$action($parameters);
        }

        return '<p>عملیات نامعتبر درخواست شده است. لطفا برگردید و دوباره امتحان کنید.</p>';
    }
}
