<?php foreach($products as $item): ?>
    <article class="shop__item product" tabindex="0">
        <div class="product__image">
            <img src="<?= $item['img'] ?>" alt="<?= $item['name']; ?>">
        </div>

        <p class="product__name"><?=$item['name'];?></p>
        <span class="product__price">
            <span class="js-product__price"><?=$item['price'];?></span> руб.
        </span>
        <span>
    </article>
<?php endforeach; ?>
