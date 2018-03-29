<form action="" method="post">
    <h2>Настройте простую синхронизацию с Telegram</h2>

    <h4 style="margin-top: 20px;">
        Что необходимо для этого сделать?
    </h4>

    <ul>
        <li>Зарегистрироваться в Telegram</li>
        <li>Перейти по ссылке <a href="http://t.me/jambo_admin_bot">http://t.me/jambo_admin_bot</a>, либо ввести в поиск <code>jambo_admin_bot</code></li>
        <li>Нажать кнопку <code>"Start"</code></li>
        <li>Вы получите сообщение с <b>пятизначным кодом синхронизации</b></li>
        <li>Введите его в поле ниже</li>
    </ul>

    <?php if (\app\models\Admin::get(true)->telegram_id): ?>
        <br>
        <h3 style="color: green;text-align: center"><i class="fa fa-check-circle"></i> Ваш аккаунт успешно синхронихирован с Telegram!</h3>
        <br>
        <br>
    <?php endif ?>

    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    <div class="col-xs-12">
        <div class="col-xs-10">
            <input type="text" class="form-control" name="code" placeholder="Введите синхронизационный код">
        </div>
        <button class="col-xs-2 btn btn-success">
            <i class="fa fa-link"></i> Синхронизировать
        </button>
    </div>

</form>