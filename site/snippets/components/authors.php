
<?php

use Kirby\Toolkit\Str;

$contentPersons = array_filter(array_map(function($author) {
    return page($author);
}, Str::split($authors, ',')));


if (!empty($contentPersons)):

$display = $display ?? "full";
$text_class = $display === "teaser" ? "text-sm" : "";

if ($display === "full"):
  ?>
  <div class="text-muted lg:mt-20"><?= t('person_author') ?></div>
  <?php
  endif;

foreach ($contentPersons as $contentPerson): ?>
    <div class="person-author <?= $text_class ?>">
      
      <?php
      $image = $contentPerson->teaser_image()->toFile(); 
      if ($image): 
        if ($display === "full"):
          $author_pic = $image->thumb(['width' => 60])->url();
        else:
          $author_pic = $image->thumb(['width' => 40])->url();
        endif;
        ?>

        <img class="rounded-full " style="color:transparent" src="<?= $author_pic ?>" alt="<?= $image->alt()->esc() ?>" />
      <?php endif; ?>
      <div class="flex flex-col">
        <a href="<?= $contentPerson->url() ?>" class="no-underline"><span class="leading-snug"><?= $contentPerson->topic()->html() ?></span></a>
        <span class="mt-1 leading-none"><?= $contentPerson->function() ?></span>
      </div>

    
    </div>
  <?php endforeach; ?>
<?php endif; ?>
