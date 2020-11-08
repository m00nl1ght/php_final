<section class="shop__filter filter">
    <form class="js-filter__form">
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/category.php'; ?>

    <div class="filter__wrapper">
        <b class="filter__title">Фильтры</b>
        <div class="filter__range range">
        <span class="range__info">Цена</span>
        <div class="range__line" aria-label="Range Line"></div>
        <div class="range__res">
            <span class="range__res-item min-price">
            <span class="js-min__price"><?= $minmaxPrice['min'] ?></span> руб.
            </span>
            <span class="range__res-item max-price">
            <span class="js-max__price"><?= $minmaxPrice['max'] ?></span> руб.
            </span>
        </div>
        </div>
    </div>

    <fieldset class="custom-form__group">
        <input type="checkbox" name="new" id="new" class="custom-form__checkbox" <?= (Helpers::isCurrentUrl('/filter/new'))?"checked":"" ?>>
        <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
        <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" <?= (Helpers::isCurrentUrl('/filter/sale'))?"checked":"" ?>>
        <label for="sale" class="custom-form__checkbox-label custom-form__info" style="display: block;">Распродажа</label>
    </fieldset>
    <button class="button" type="submit" style="width: 100%">Применить</button>
    </form>
</section>

