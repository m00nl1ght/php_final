<section class="shop__sorting">
    <div class="shop__sorting-item custom-form__select-wrapper">
        <select class="js-sort-category custom-form__select" name="category">
        <option value="" hidden="">Сортировка</option>
        <option value="price">По цене</option>
        <option value="name">По названию</option>
        </select>
    </div>
    
    <div class="shop__sorting-item custom-form__select-wrapper">
        <select class="js-sort-prices custom-form__select" name="prices">
        <option value="" hidden="">Порядок</option>
        <option value="up">По возрастанию</option>
        <option value="down">По убыванию</option>
        </select>
    </div>

    <p class="shop__sorting-res">Найдено <span class="res-sort"><?= $productCount ?></span></p>
</section>