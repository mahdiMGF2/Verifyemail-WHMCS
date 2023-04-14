<?php

namespace WHMCS\Module\Addon\Verifyemail\template;

use WHMCS\Database\Capsule;
class outputemail
{
    public function index($vars)
    {
        $langadmin = Capsule::table('tbladmins')->where('id', '1')->value('language');
        $modulelink = $vars['modulelink'];
        $LANG = $vars['_lang'];
        if ($langadmin == "farsi") {
            $rtl = "style-rtl.css";
        } else {
            $rtl = "style.css";
        }
            $Emailauthentication = Capsule::table('mod_Verifyemail')->where('id', '1')->value('Emailauthentication');
            $Userauthentication = Capsule::table('mod_Verifyemail')->where('id', '1')->value('Userauthentication');
            $Deletedatabase = Capsule::table('mod_Verifyemail')->where('id', '1')->value('Deletedatabase');
            $checked = "";
            $checked1 = "";
            $checked2 = "";
            if ($Emailauthentication == "on") {
                $checked = "checked";
            } else {
                $checked = "";
            }
            if ($Userauthentication == "on") {
                $checked1 = "checked";
            } else {
                $checked1 = "";
            }
            if ($Deletedatabase == "on") {
                $checked2 = "checked";
            } else {
                $checked2 = "";
            }
            try {
                Capsule::connection()->transaction(
                    function ($connectionManager) {
                        if (isset($_POST['Emailauthentication'])) {
                            $connectionManager->table('mod_Verifyemail')->update(
                                [

                                    'Emailauthentication' => $_POST['Emailauthentication'],
                                    'Userauthentication' => $_POST['Userauthentication'],
                                    'Deletedatabase' => $_POST['Deletedatabase'],
                                ]
                            );
                        }
                    }
                );
            } catch (\Exception $e) {
                echo "An error has occurred {$e->getMessage()}";
            }

            return <<<EOF
        <link rel="stylesheet" href="../modules/addons/Verifyemail/lib/template/css/{$rtl}">
        <header>
                            <div class="title">{$LANG['Warning']['dec-configgeneral']}</div>
                    <div><a class="btnsetting" href="configgeneral.php?nocache=yc4opdjzyLEJ43Zn#tab=10">{$LANG['Warning']['go-to-configgeneral']}</a></div>
                </header>
                <nav>
                    <a href="{$modulelink}&page=index" class="btnconfig">
                        {$LANG['menu']['setting-email-active']} 
                    </a>
                    <a href="{$modulelink}&page=about" class="btnabout">
                        {$LANG['menu']['aboutanicoweb']} 
                                        </a>
                </nav>
                <form class="formemil" action="#" method="post">
                    <div class="input-form">
                    <label for="Emailauthentication">{$LANG['setting']['Emailconfirmation']}</label>
                   <label class="switch Emailauthentication1" for="Emailauthentication">
                    <input  type="checkbox" $checked name="Emailauthentication" id="Emailauthentication" />
                    <div class="slider round"></div>
                  </label>
                <p>{$LANG['setting']['dec-confirmemail']} </p>
                </div>
                <div class="input-form">
                    <label for="Userauthentication">{$LANG['setting']['Userauthentication']}</label>
                    <label class="switch" for="Userauthentication">
                     <input  type="checkbox" $checked1  name="Userauthentication" id="Userauthentication" />
                     <div class="slider round"></div>
                   </label>
                   <p>{$LANG['setting']['dec-Userauthentication']} </p>
                 </div>
                 <div class="input-form">
                    <label for="Deletedatabase">{$LANG['setting']["Deletedatabase"]}</label>
                    <label class="switch Deletedatabase1" for="Deletedatabase">
                     <input  type="checkbox" $checked2  name="Deletedatabase" id="Deletedatabase" />
                     <div class="slider round"></div>
                   </label>
                   <p>{$LANG['setting']['dec-Deletedatabase']} </p>
                 </div>
                 <input class="submitbtn" type="submit" value="{$LANG['setting']['savechanges']} " name="submit">
                </form>
EOF;
    }
    public function about($vars)
    {
        $langadmin = Capsule::table('tbladmins')->where('id', '1')->value('language');
        $LANG = $vars['_lang'];
        $modulelink = $vars['modulelink'];


        if ($langadmin == "farsi") {
            $rtl = "style-rtl.css";
        } else {
            $rtl = "style.css";
        }

        return <<<EOF
            <link rel="stylesheet" href="../modules/addons/Verifyemail/lib/template/css/{$rtl}">
                <nav>
                    <a href="{$modulelink}&page=index" class="btnconfig">
                        {$LANG['menu']['setting-email-active']} 
                    </a>
                    <a href="{$modulelink}&page=about" class="btnabout">
                        {$LANG['menu']['aboutanicoweb']} 
                                        </a>
                </nav>
                <p class="about">{$LANG['about']['Description']} </p>
EOF;
    }
}
