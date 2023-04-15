{if $loggedin}
<link rel="stylesheet" href="./modules/addons/Verifyemail/templates/css/style.css">
{if $email_authentication_status}

<div class="Userauthentication">
    <h1 class="title-pages">احراز هویت ایمیل</h1>
    <p class="text-dec">برای دسترسی به تمامی خدمات وبسایت ایمیل خود را تایید کنید</p>
        <img class="emailconfimedimg" src="./modules/addons/Verifyemail/templates/img/verify.svg"
                alt="confriming">
        <p class="note">توجه : برای ویرایش ایمیل در فیلد زیر ایمیل جدید خود را وارد کرده و دکمه ویرایش ایمیل را بزنید</p>
        <form method="post" class="formedit" action="">
            <div>
                <label for="emailedit">ایمیل حساب</label>
                <input required value="{$emailclient}" type="email" name="emailedit" id="emailedit">
            </div>
            <div>
                <button class="btnemailconfrim btn-lg btn-resend-verify-email"
                    data-email-sent="{$LANG.action.Emailsent}" data-error-msg=" {$LANG.action.Emailerror}"
                    data-uri="{routePath('user-email-verification-resend')}">
                    ارسال مجدد ایمیل
                </button>
                <button type="submit" class="editemail btn-lg">ویرایش ایمیل</button>
        </form>
</div>
</div>
{else}
<div class="Userauthentication">
<img style="margin: 0;" class="emailconfimedimg" src="./modules/addons/Verifyemail/templates/img/Confrimed.svg"
                alt="confirmed">
    <h1 style="color: green;" class="title-pages">ایمیل تایید شده !</h1>
    <p class="text-dec">ایمیل حساب کاربری شما تایید شده است</p>
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
