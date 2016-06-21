<h3 class="text-center">Список статей</h3>

<div class="list-group">
    <?php foreach($list as $item): ?>
        <a href="/blog/<?php print $item['id']; ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php print $item['title']; ?></h4>
            <p class="list-group-item-text"><?php print $item['short']; ?></p>
        </a>
    <?php endforeach; ?>
</div>
