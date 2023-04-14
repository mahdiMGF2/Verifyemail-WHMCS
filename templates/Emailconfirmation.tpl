{if $loggedin}
<link rel="stylesheet" href="./modules/addons/Verifyemail/templates/css/style.css">
{if $email_authentication_status}

<div class="Userauthentication">
    <h1 class="title-pages">{$LANG.title.emailconfirmation}</h1>
    <p class="text-dec">{$LANG.Description.emailconfirmation}</p>
        <img class="emailconfimedimg" src="./modules/addons/Verifyemail/templates/img/verify.svg"
                alt="confriming">
        <p class="note">{$LANG.Warning.fillthefield}</p>
        <form method="post" class="formedit" action="">
            <div>
                <label for="emailedit">{$LANG.Account.email}</label>
                <input required value="{$emailclient}" type="email" name="emailedit" id="emailedit">
            </div>
            <div>
                <button class="btnemailconfrim btn-lg btn-resend-verify-email"
                    data-email-sent="{$LANG.action.Emailsent}" data-error-msg=" {$LANG.action.Emailerror}"
                    data-uri="{routePath('user-email-verification-resend')}">
                    {$LANG.Button.Sendconfirmationemail}
                </button>
                <button type="submit" class="editemail btn-lg">{$LANG.Button.Editemail}</button>
        </form>
</div>
</div>
{else}
<div class="Userauthentication">
<img style="margin: 0;" class="emailconfimedimg" src="./modules/addons/Verifyemail/templates/img/Confrimed.svg"
                alt="confirmed">
    <h1 style="color: green;" class="title-pages">ایمیل تایید شده !</h1>
    <p class="text-dec">{$LANG.status.Verifiedemail}</p>
    <a class="btndash-confrimed" href="{$WEB_ROOT}/clientarea.php">داشبورد</a>
        </form>
</div>
</div>
{/if}
{else}
<script>
    location.href = './index.php/login';

</script>
{/if}