<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URLROOT; ?>"><?= SITENAME; ?></a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= URLROOT; ?>" style="<?= basename($_SERVER['REQUEST_URI']) == '' ? 'color: green; font-weight: bold;' : '';?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/pages/about" style="<?= basename($_SERVER['REQUEST_URI']) == 'about' ? 'color: green; font-weight: bold;' : '';?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/posts/index" style="<?= basename($_SERVER['REQUEST_URI']) == 'posts' ? 'color: green; font-weight: bold;' : '';?>">Posts</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <?php if(isset($_COOKIE['jwt'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= URLROOT; ?>/users/logout">Logout</a>
                    </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= URLROOT; ?>/users/register" style="<?= basename($_SERVER['REQUEST_URI']) == 'register' ? 'color: green; font-weight: bold;' : '';?>">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/users/login" style="<?= basename($_SERVER['REQUEST_URI']) == 'login' ? 'color: green; font-weight: bold;' : '';?>">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
