<div class="admin-create">

    <h1>Настройки</h1>


    <div class="admin-form">

        <form action="" method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <div class="form-group field-admin-name">
                <label class="control-label" for="admin-pass">Новый пароль:</label>
                <input type="password" id="admin-pass" class="form-control" name="password" maxlength="225">

                <div class="help-block"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>

</div>