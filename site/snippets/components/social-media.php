<?php
  $fontClass = $font_class ?? "h-7 w-7";
?>

<div class="flex space-x-2">
  <?php
    foreach ($social_media->fields() as $key => $social):
      $url = $social->url()->value();
      if (!empty($url)):
          $svgIcon = tailwindThemeUseFontAwesome($key, 'brands', $fontClass);
          echo "<a href='{$url}' title='{$key}' class='line-primary'>
                  {$svgIcon}
                </a>";
      endif;
    endforeach;
  ?>
</div>
