<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body mt-5 bg-light">
            <h2 class="text-center">Создать аккаунт</h2>
            <p class="text-center">Заполните форму, чтобы зарегистрироваться</p>
            <form action="<?= URLROOT ?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">Логин: <sup>*</sup></label>
                    <input type="text" name="name"
                        class="form-control form-control-lg <?= !empty($data['name_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['name']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['name_error'] ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email"
                        class="form-control form-control-lg <?= !empty($data['email_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['email']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['email_error'] ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон: <sup>*</sup></label>
                    <input type="text" name="phone"
                        class="form-control form-control-lg <?= !empty($data['phone_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['phone']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['phone_error'] ?>
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
                <div class="form-group">
                    <label for="confirm_password">Подтвердите пароль: <sup>*</sup></label>
                    <input type="password" name="confirm_password"
                        class="form-control form-control-lg <?= !empty($data['confirm_password_error']) ? 'is-invalid' : ''; ?>"
                        value="<?= $data['confirm_password']; ?>">
                    <span class="invalid-feedback">
                        <?= $data['confirm_password_error'] ?>
                    </span>
                </div>
                <div class="row text-center mt-3" style="display: block !important;">
                    <div class="col mb-2">
                        <input type="submit" value="Зарегистрироваться" class="btn btn-success btn-lg block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT ?>/users/login" class="btn btn-light btn-block is_account">Есть
                            аккаунт?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/inc/footer.php';