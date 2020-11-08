<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="/resources/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item" href="/">Главная</a>
      </li>

      <?php if(Auth::hasRole('Администратор', $userLogin)): ?>
        <li>
          <a class="main-menu__item <?= Helpers::pathUrlArr()[1] == 'products' ? 'active' : '' ?>" href="/admin/products">Товары</a>
        </li>
      <?php endif; ?>

      <li>
        <a class="main-menu__item <?= Helpers::pathUrlArr()[1] == 'orders' ? 'active' : '' ?>" href="/admin/orders">Заказы</a>
      </li>
      <li>
        <a class="main-menu__item" href="/admin/?loginOut=true">Выйти</a>
      </li>
    </ul>
  </nav>
</header>