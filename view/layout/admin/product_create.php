<main class="page-add">
  <h1 class="h h--1"><?= isset($adminProductCreatePage) ? 'Добавление товара' : 'Изменение товара' ?></h1>

  <form class="custom-form" action="#" method="post">
    <input id="product-id" type="text" name="product-id" value="<?= isset($adminProductCreatePage) ? '' : $product['id'] ?>" hidden="">

    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Данные о товаре</legend>
      <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
        <input type="text" class="custom-form__input" name="product-name" id="product-name" value="<?= isset($adminProductCreatePage) ? '' : $product['name'] ?>">

        <?php if ( isset($adminProductCreatePage) ): ?>
          <p class="custom-form__input-label">Название товара</p>
        <?php endif; ?>
      </label>

      <label for="product-price" class="custom-form__input-wrapper">
        <input type="text" class="custom-form__input" name="product-price" id="product-price" value="<?= isset($adminProductCreatePage) ? '' : $product['price'] ?>">

        <?php if ( isset($adminProductCreatePage) ): ?>
          <p class="custom-form__input-label">Цена товара</p>
        <?php endif; ?>
      </label>
    </fieldset>

    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Фотография товара</legend>

      <ul class="add-list">
        <li class="add-list__item add-list__item--add">
          <input type="file" name="product-photo" id="product-photo" hidden="">
          <label for="product-photo">Добавить фотографию</label>
        </li>
      </ul>
    </fieldset>

    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Раздел</legend>

      <div class="page-add__select">
        <select name="category[]" class="custom-form__select" multiple="multiple">
          <option hidden="">Название раздела</option>

          <?php foreach ($category as $data): ?>
            <option 
              value="<?= $data['id'] ?>"
              <?= isset($data['checked']) ? 'selected="selected"' : '' ?>
              
              ><?= $data['name'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <input type="checkbox" name="new" id="new" class="custom-form__checkbox" <?= (isset($product['new']) && $product['new']) ? 'checked' : '' ?>>
      <label for="new" class="custom-form__checkbox-label">Новинка</label>

      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" <?= (isset($product['sale']) && $product['sale']) ? 'checked' : '' ?>>
      <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
    </fieldset>

    <button class="button" type="submit"><?= isset($adminProductCreatePage) ? 'Добавить товар' : 'Изменить товар' ?></button>
  </form>

  <section class="shop-page__popup-end page-add__popup-end" hidden="">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Товар успешно <?= isset($adminProductCreatePage) ? 'добавлен' : 'изменен' ?></h2>
    </div>
  </section>
</main>