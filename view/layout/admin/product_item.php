<li class="product-item page-products__item">
    <b class="product-item__name"><?= $item['name'] ?></b>
    <span class="product-item__field js-product-id"><?= $item['id'] ?></span>
    <span class="product-item__field"><?= $item['price'] ?> руб.</span>
    <span class="product-item__field">Женщины</span>
    <span class="product-item__field"><?= $item['new']?'Да':'Нет' ?></span>
    <a href="/admin/products/edit/<?= $item['id'] ?>" class="product-item__edit" aria-label="Редактировать"></a>
    <button class="product-item__delete"></button>
</li>