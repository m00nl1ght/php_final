<div class="filter__wrapper">
    <b class="filter__title">Категории</b>
    
    <ul class="filter__list">
        <li>
            <a class="js-filter__category filter__list-item <?= (Helpers::isCurrentUrl('/') || Helpers::isCurrentUrl('/filter/new') || Helpers::isCurrentUrl('/filter/sale'))?'active':'' ?>" 
                href="/">Все
            </a>
        </li>
        <?php foreach ($categories as $item): ?>
            <li>
                <a class="js-filter__category filter__list-item <?= (isset($categoryId) && $categoryId == $item['id'])?'active':'' ?>" 
                    href="/category/<?= $item['id'] ?>">
                    <?= $item['name'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>