<main class="page-authorization">
  <h1 class="h h--1">Авторизация</h1>
  <?php 
    if ($firstTime == false && Auth::isAuth() == false):
      foreach ($errors as $message):
        echo ('<p>' . $message . '</p>');
      endforeach;
    endif;
  ?>
  <form class="custom-form" action="/admin/" method="post">
    <input type="email" class="custom-form__input" required="" name="login" value="<?= $userLogin ?>">
    <input type="password" class="custom-form__input" required="" name="password" value="<?= $userPassword ?>">
    <button class="button" type="submit">Войти в личный кабинет</button>
  </form>
</main>

