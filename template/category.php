<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/category.php'; ?>

<div class="filter__wrapper">
    <b class="filter__title">Категории</b>
    
    <ul class="filter__list">
        <?= categoryList(getCategory()); ?>
    </ul>
</div>