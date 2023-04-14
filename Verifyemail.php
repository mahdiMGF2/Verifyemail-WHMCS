<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\Verifyemail\template\Verifyemailadmin;
use WHMCS\Module\Addon\Verifyemail\Client\Verifyemailclient;


/**
 * Verify_email_anicoweb
 *
 * @link https://anicoweb.ir
 *
 * @copyright Copyright (c) AnicoWeb
 */

if (!defined("WHMCS")) {
    die("Access to this file is not possible");
}
function Verifyemail_config()
{
    return [
        'name' => 'Email verification',
        'description' => 'Use this plugin to force the user to confirm the email in the user panel',
        'author' => "<a href='https://anicoweb.ir' target='_blank'>Anico Web</a>",
        'language' => 'en',
        'version' => '1.0',
    ];
}

function Verifyemail_activate()
{
	$pdo = Capsule::connection()->getPdo();
	$pdo->beginTransaction();

	try {

		$query = "CREATE TABLE IF NOT EXISTS `mod_Verifyemail` (
			  `id` int(5) NOT NULL AUTO_INCREMENT,
			  `Emailauthentication` varchar(32) NOT NULL,
			  `Userauthentication` varchar(32) NOT NULL,
              `Deletedatabase` varchar(32) NOT NULL,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

		$pdo->exec($query);
        $query = "INSERT IGNORE INTO mod_Verifyemail (id,Emailauthentication,Userauthentication,Deletedatabase) VALUES ('1','off','off','off');";
		$pdo->exec($query);
        return [
			'status' => 'success', 
			'description' => 'The email verification plugin has been activated successfully. Go to the plugin page to configure the plugin',
		];
	} catch (Exception $e) {

		$pdo->rollBack();

		return [
			'status' => 'error', 
			'description' => 'The plugin was not activated. Contact support to solve the problem',
		];
	}
}
function Verifyemail_deactivate()
{
    $Deletedatabase=Capsule::table('mod_Verifyemail')->where('id', '1')->value('Deletedatabase');
    if($Deletedatabase=="on"){
    try {
        Capsule::schema()
            ->dropIfExists('mod_Verifyemail');

        return [
            'status' => 'success',
            'description' => 'The module was successfully disabled',
        ];
    } catch (\Exception $e) {
        return [
            "status" => "error",
            "description" => "Error in deactivating the module, contact support",
        ];
    }
}
}
function Verifyemail_output($vars)
{
    $action = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
    $verioutputer = new Verifyemailadmin();
    $response = $verioutputer->verioutput($action, $vars);
    echo $response;
}
function Verifyemail_sidebar($vars)
{
    $version = $vars['version'];
    $LANG = $vars['_lang']; 

    return <<<EOF
    <div class="sidebar-header">{$LANG['sidebar']["Other_link"]}</div>
<ul class="menu">
<li><a href="#">{$LANG['sidebar']["Support"]}</a></li>
<li><a herf="#">{$LANG['sidebar']["Vieproducts"]}</a></li>
</ul>;
EOF;
}
function Verifyemail_clientarea($vars)
{
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$dispatcher = new Verifyemailclient();
    return $dispatcher->dispatch($action, $vars);
}
