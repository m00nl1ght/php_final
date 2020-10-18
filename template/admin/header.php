<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="/resources/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item" href="/">Главная</a>
      </li>
      <li>
        <a class="main-menu__item <?= ($_GET['page'] == 'products' || (isCurrentUrl('/admin/')&&empty($_GET)))?"active":"" ?>" href="/admin/?page=products">Товары</a>
      </li>
      <li>
        <a class="main-menu__item <?= ($_GET['page'] == 'orders')?"active":"" ?>" href="/admin/?page=orders">Заказы</a>
      </li>
      <li>
        <a class="main-menu__item" href="/admin/?loginOut=true">Выйти</a>
      </li>
    </ul>
  </nav>
</header>