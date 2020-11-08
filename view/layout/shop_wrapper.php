<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/product_sort.php'; ?>

<section class="js-shop__list shop__list">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/product_wrapper.php'; ?>
</section>

<ul class="shop__paginator paginator">
    <?php for ($i = 1; $i <= $pageCount; $i++): ?>

    <li>
        <a class="paginator__item" <?= $i == $pageId ? '' : ('href="' . $i . '"') ?> ><?= $i ?></a>
    </li>

    <?php endfor; ?>
</ul>
