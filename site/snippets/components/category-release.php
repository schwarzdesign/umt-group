  <?php if ($category->isNotEmpty()): ?>  
    <span>
      <?= $category ?>
    </span>
  <?php endif; ?>
  <?php if ($category->isNotEmpty() && $release_date->isNotEmpty()): ?>  
    <div class="mx-1 h-1 w-1 shrink-0 rounded-full bg-text" aria-hidden="true"></div>
  <?php endif; ?>
  <?php if ($release_date->isNotEmpty()): ?>
    <span>
      <?= $release_date->toDate('d.m.Y') ?>
    </span>
  <?php endif; ?>

