<li>
    <a 
        class="js-filter__category filter__list-item <?= isCurrentUrl($row['url'])?"active":"" ?>" 
        href="<?=$row['url']?>" 
        data-id="<?=$row['id']?>"><?=$row['name']?>
    </a>
</li>