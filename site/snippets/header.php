<?php

// Check if the website is in maintenance mode
$website_mode = $site->website_mode()->toBool();
$website_status = $site->website_status()->toBool();
$user = $kirby->user();

// Go to disabled page if website is in maintenance mode or if the website is not in status "online" and the user is not logged in
if (
    !$website_mode || 
    (!$website_status && !$user)
) {
    snippet("disabled");
    exit();
  } 

$multisite = tailwindGetMultisite();
$cssFile = kirby()->root('index') . "/assets/css/" . $multisite . ".css";
if (file_exists($cssFile)) {
    $cssPath = "/assets/css/" . $multisite . ".css";
} else {
    $cssPath = "/assets/css/styles.css";
}
?>
<!DOCTYPE html>
<html
  lang="<?= $kirby->language()->code() ?>" class="scroll-smooth">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>

  <?= snippet("meta", ["page" => $page]) ?>
  
  <script src="<?= url("assets/js/dark-mode.js") ?>" defer></script>
  <script src="<?= url("assets/js/alpine.focus.min.js") ?>" defer></script>
  <script src="<?= url("assets/js/alpine.min.js") ?>" defer></script>
  <script src="<?= url("assets/js/page-nav.js") ?>" defer></script>

  <?= css($cssPath) ?>

</head>
<body class="background__image" x-data="{
    xClasses: ['background-x-1', 'background-x-2', 'background-x-3', 'background-x-4'],
    yClasses: ['background-y-1', 'background-y-2', 'background-y-3', 'background-y-4'],
    init() {
      const x = this.xClasses[Math.floor(Math.random() * this.xClasses.length)];
      const y = this.yClasses[Math.floor(Math.random() * this.yClasses.length)];
      document.body.classList.add(x, y);
    }
  }">

<?php snippet("menu/menu"); ?>
<main class="main" aria-label="Content">
<?php $loadHeroImage = $page->main_image()->isNotEmpty(); ?>

<?php $headline = $page->main_headline()->isNotEmpty()
  ? $page->main_headline()
  : $page->title(); ?>

<?php $heroDisplay = $page->hero_display()
  ? $page->hero_display()->value()
  : "default"; ?>

<?php if ($loadHeroImage && $heroDisplay == "banner"): ?>
  <?php snippet("hero-banner", ["headline" => $headline]); ?>
<?php elseif ($loadHeroImage && $heroDisplay == "block"): ?>
  <?php snippet("hero-block", ["headline" => $headline]); ?>
<?php elseif ($loadHeroImage): ?>
  <?php snippet("hero-default", ["headline" => $headline]); ?>
<?php else: ?>
  <?php snippet("hero", ["headline" => $headline]); ?>
<?php endif; ?>
