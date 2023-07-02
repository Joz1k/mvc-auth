<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body mt-5 bg-light">
            <?php flash('register_success');?>
            <h2 class="text-center">Войти в аккаунт</h2>
            <p class="text-center">Введите почту и пароль</p>
            <form action="<?= URLROOT ?>/users/login" method="post">
                <div class="form-group">
                    <label for="email_phone">Email или телефон: <sup>*</sup></label>
                    <input type="text" name="email_phone"
                        class="form-control form-control-lg <?= !empty($data['email_phone_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['email_phone']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['email_phone_error'] ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Пароль: <sup>*</sup></label>
                    <input type="password" name="password"
                        class="form-control form-control-lg <?= !empty($data['password_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['password']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['password_error'] ?>
                    </span>
                </div>
                <div class="row text-center mt-3" style="display: block !important;">
                    <div class="col mb-2">
                        <input type="submit" value="Логин" class="btn btn-success btn-lg block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT ?>/users/register" class="btn btn-light btn-block is_account">Нет аккаунта?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/inc/footer.php';