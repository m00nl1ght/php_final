<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="/resources/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item <?= (isCurrentUrl('/')&&empty($_GET))?"active":"" ?>" href="/">Главная</a>
      </li>
      <li>
        <a class="main-menu__item <?= ($_GET['filter'] == 'new')?"active":"" ?>" href="?filter=new">Новинки</a>
      </li>
      <li>
        <a class="main-menu__item <?= ($_GET['filter'] == 'sale')?"active":"" ?>" href="?filter=sale">Sale</a>
      </li>
      <li>
        <a class="main-menu__item" href="/path/delivery.php">Доставка</a>
      </li>
    </ul>
  </nav>
</header>