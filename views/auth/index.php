<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="login-form"><!--login form-->
                    <h2>Войти в ваш аккаунт</h2>
                    <form action="" method="post">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="text" placeholder="Имя пользователя или Email" name="email"/>
                        <input type="password" placeholder="Ваш пароль" name="password"/>
                        <!--                        <span>-->
                        <!--								<input type="checkbox" class="checkbox">-->
                        <!--								Запомнить меня-->
                        <!--							</span>-->
                        <button type="submit" name="auth" value="1" class="btn btn-default add-to-cart">Вход</button>
                        <h2>Забыли ваш пароль?</h2>
                        <input type="email" placeholder="Ваш Email-адрес"/>
                        <button type="submit" class="btn btn-default add-to-cart">Восстановить</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1 ">
                <h2 class="or">Или</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form profile"><!--sign up form-->
                    <h3>Я новый пользователь!</h3>
                    <form action="" method="post" id="reg_form">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="text" placeholder="Ваше Имя" name="name"/>
                        <input type="text" placeholder="Ваша Фамилия" name="last_name"/>
                        <input type="text" placeholder="Имя пользователя" name="username"/>
                        <input type="email" placeholder="Ваш Email-адрес" name="email"/>
                        <input type="tel" placeholder="Ваш номер телефона" id="phone" name="phone"/>
                        <div style="position:relative;"><input type="password" placeholder="Ваш пароль" name="password" id="register_password"/> <span style="position: absolute;top: 10px;right: 15px;"><i class="far fa-eye" style="cursor: pointer;" id="show_password"></i></span></div>
                        <input type="hidden" name="register" value="1">
                        <a href="#!" id="reg" class="btn btn-default add-to-cart">Зарегистрироваться</a>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

<script>
    var showed = 0;

    window.onload = function () {
        $(document).on('click', '#show_password', function () {
                $('#register_password').attr('type', showed ? 'password' : 'text');
                $(this).removeClass('fa-eye fa-eye-slash').addClass(showed ? 'far fa-eye' : 'far fa-eye-slash')
                if (showed) showed = 0;
                else showed = 1;
            }
        ).on('click', '#reg', function () {
            if (!$('.signup-form [name=name]').val() || !$('.signup-form [name=last_name]').val() || !$('.signup-form [name=email]').val() || !$('.signup-form [name=username]').val() || !$('.signup-form [name=phone]').val() || !$('.signup-form [name=password]').val()) alert('Вы должны заполнить все поля!');
            else document.getElementById('reg_form').submit();
        })
    }
</script>
