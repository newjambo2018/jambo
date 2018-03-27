<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://i.icomoon.io/public/temp/5d76678c1a/UntitledProject/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.1/animate.css">

<div class="auth animated fadeIn">
    <div class="logo">
        Jambo<span>ua</span> Admin
    </div>
    <form method="post" action="">
        <input type="hidden" value="<?= Yii::$app->request->csrfToken ?>" name="_csrf">
        <div class="form-control">
            <input name="email" type="text"/>
            <label>E-Mail</label>
            <div class="bar"></div>
        </div>
        <div class="form-control">
            <input name="password" type="password"/>
            <label>Password</label>
            <div class="bar"></div>
        </div>

        <div class="actions">
            <input class="login" type="submit" value="Login"/>
<!--            <a href="">Create an account</a>-->
        </div>
    </form>
    <div class="auth-confirm">
        <i class="material-icons">mail_outline</i>
        <h1>Thank You for registering!</h1>
        <p>Please check your email for confirmation link.</p>
        <a class="login-back" href="">Login</a>
    </div>
</div>


<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
    @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
    @import url(https://fonts.googleapis.com/css?family=Roboto+Slab:400,700);

    body {
        background-color: #303F9F;
        background-size: cover;
        font-family: 'Roboto', sans-serif;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
    }

    body * {
        box-sizing: border-box;
        outline: none;
    }

    .logo {
        font-size: 34px;
        font-family: 'Roboto Slab', serif;
        text-align: center;
        margin-bottom: 50px;
        color: #6573d0;
    }

    .logo span {
        font-size: 20px;
        color: #8c97dc;
    }

    .auth {
        width: 300px;
        margin: 100px auto 0 auto;
    }

    .auth .form-control {
        position: relative;
        margin-bottom: 15px;
    }

    .auth .form-control input[type="text"],
    .auth .form-control input[type="password"] {
        width: 100%;
        border: none;
        background-color: transparent;
        height: 40px;
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        position: relative;
        z-index: 2;
        border-bottom: 2px solid #5161ca;
    }

    .auth .form-control input[type="text"]:-webkit-autofill,
    .auth .form-control input[type="password"]:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 50px #303F9F inset;
        -webkit-text-fill-color: #fff;
    }

    .auth .form-control input[type="text"]:-webkit-autofill:focus,
    .auth .form-control input[type="password"]:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0 50px #303F9F inset;
        -webkit-text-fill-color: #fff;
    }

    .auth .form-control input[type="text"]:focus ~ label,
    .auth .form-control input[type="password"]:focus ~ label {
        z-index: 3;
    }

    .auth .form-control input[type="text"].active ~ label,
    .auth .form-control input[type="password"].active ~ label {
        z-index: 3;
    }

    .auth .form-control input[type="text"]:focus ~ .bar:before, .auth .form-control input[type="text"]:focus ~ .bar:after,
    .auth .form-control input[type="password"]:focus ~ .bar:before,
    .auth .form-control input[type="password"]:focus ~ .bar:after {
        background-color: #9fa8e2;
        width: 50%;
    }

    .auth .form-control input[type="text"]:focus ~ label,
    .auth .form-control input[type="password"]:focus ~ label {
        transform: translate(-12%, -50%) scale(0.75);
        color: #b3bae8;
    }

    .auth .form-control input[type="text"].active ~ label,
    .auth .form-control input[type="password"].active ~ label {
        transform: translate(-12%, -50%) scale(0.75);
    }

    .auth .form-control .bar:before, .auth .form-control .bar:after {
        content: "";
        position: absolute;
        bottom: 0;
        height: 2px;
        width: 0;
        transition: .2s ease;
        z-index: 2;
    }

    .auth .form-control .bar:before {
        left: 50%;
    }

    .auth .form-control .bar:after {
        right: 50%;
    }

    .auth .form-control label {
        line-height: 40px;
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        font-size: 16px;
        transition: 0.2s ease;
        z-index: 1;
        color: #7885d6;
    }

    .auth .actions {
        margin-top: 50px;
    }

    .auth .actions input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px 0;
        background-color: #384aba;
        border: none;
        font-size: 16px;
        font-weight: 400;
        text-transform: uppercase;
        border-radius: 2px;
        color: white;
        cursor: pointer;
        margin-bottom: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .auth .actions input[type="submit"]:hover {
        background-color: #3d50c5;
    }

    .auth .actions a {
        text-align: center;
        display: block;
        color: #909add;
        text-decoration: none;
        padding: 10px 0;
        font-weight: 500;
    }

    .auth .actions a:hover {
        color: #dadef4;
    }

    .auth .auth-confirm {
        background-color: #dadef4;
        border-radius: 2px;
        text-align: center;
        color: #303F9F;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .auth .auth-confirm h1 {
        font-size: 21px;
        margin-bottom: 20px;
    }

    .auth .auth-confirm p {
        line-height: 21px;
    }

    .auth .auth-confirm a {
        background-color: #303F9F;
        border-radius: 2px;
        padding: 10px 5px;
        text-transform: uppercase;
        display: block;
        font-size: 14px;
        color: #fff;
        text-decoration: none;
        margin-top: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .auth .auth-confirm a:hover {
        background-color: #3d50c5;
    }

    .auth .auth-confirm i {
        font-size: 70px;
        color: #b3bae8;
    }

    .auth-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        border-top: 1px solid #3545af;
        background-color: #3242a7;
        padding: 20px;
    }

    .auth-bottom a {
        display: block;
        color: #909add;
        text-decoration: none;
        padding: 10px 0;
        font-weight: 500;
    }

    .auth-bottom a:hover {
        color: #dadef4;
    }

    .auth-bottom a.facebook-login span {
        float: left;
        margin-right: 5px;
        font-size: 16px;
        color: #dadef4;
    }

    .auth-bottom .auth-bottom-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .auth-bottom .auth-bottom-left {
        float: left;
    }

    .auth-bottom .auth-bottom-right {
        float: right;
    }


</style>

<script>
    $('.auth-confirm').hide();
    $('input').blur(function () {
        if ($(this).val().length > 0) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });


    // $('.login').click(function (e) {
    //     e.preventDefault();
    //     $('form').fadeOut(function () {
    //         $('.auth-confirm').fadeIn();
    //     });
    // });


    $('.login-back').click(function (e) {
        e.preventDefault();
        $('.auth-confirm').fadeOut(function () {
            $('form').fadeIn();
        });
    });


</script>