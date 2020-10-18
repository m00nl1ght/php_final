<article class="shop__item product" tabindex="0">
    <div class="product__image">
        <img src="<?= $row['img'] ?>" alt="<?= $row['name']; ?>">
    </div>

    <p class="product__name"><?=$row['name'];?></p>
    <span class="product__price"><?=$row['price'];?>.</span>
</article>