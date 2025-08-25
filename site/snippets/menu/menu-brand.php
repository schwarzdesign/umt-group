<a href="<?= $site->url() ?>" class="logo__link">
  <?php if ($company_name = $site->organization()): ?>
    <span class="sr-only"><?= $company_name ?></span>
  <?php endif; ?>
  <?php if ($image = $site->logo()->toFile()): ?>
    <img class="logo__image" src="<?= $image->url() ?>" alt="Logo <?= $company_name ?>">
  <?php endif; ?>
</a>
