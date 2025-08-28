

<?php 
$currentUrl = kirby()->request()->url();
$editButtonUrl = $page->panel()->url();
$svgIconEdit = tailwindThemeUseFontAwesome('pencil', 'light', 'h-4 w-4 top inline inset-0', '24', '24', 'true', 'currentColor');
?>
<footer aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
          <div class="container-pt-large">
            <div class="container">
              <div class="footer__content">
                <div>
                  <?php if ($image = $site->logo()->toFile()): ?>
                    <img class="footer__image" src="<?= $image->url() ?>" alt="Logo">
                  <?php endif; ?>

                </div>
                <div class="footer__nav">
                  <div class="footer__nav-cols">
                      <?php $main_menu_items = $site->menu()->toStructure(); ?>
                      <?php if ($main_menu_items->isNotEmpty()): ?>
                        <ul role="list" class="menu footer__nav-menu">
                          <?php foreach (
                              $main_menu_items
                              as $main_menu_item
                          ): ?>
                            <?php
                            $itemUrl = $main_menu_item->link()->toUrl();
                            $isActive = $currentUrl == $itemUrl ? "active" : "";
                            $isCurrent =
                                $currentUrl == $itemUrl
                                    ? 'aria-current="page"'
                                    : "";
                            ?>
                            <li>
                              <a href="<?= $itemUrl ?>" class="footer__nav-item <?= $isActive ?>" <?= $isCurrent ?>>
                                <?= tailwindThemeGetLinkTitle($main_menu_item) ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                      <?php
                      $secondary_menu_items = $site
                          ->secondary_menu()
                          ->toStructure();
                      if ($secondary_menu_items->isNotEmpty()): ?>
                        <ul role="list" class="menu footer__nav-menu">
                          <?php foreach (
                              $secondary_menu_items
                              as $secondary_menu_item
                          ): ?>
                            <?php
                            $itemUrl = $secondary_menu_item->link()->toUrl();
                            $isActive = $currentUrl == $itemUrl ? "active" : "";
                            $isCurrent =
                                $currentUrl == $itemUrl
                                    ? 'aria-current="page"'
                                    : "";
                            ?>
                            <li>
                              <a href="<?= $itemUrl ?>" class="footer__nav-item <?= $isActive ?>" <?= $isCurrent ?>>
                                <?= tailwindThemeGetLinkTitle($secondary_menu_item) ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif;
                      ?>
                  </div>
                </div>
                <?php
                $organization = $site->organization();
                $address = $site->address()->toObject();
                $contact_details = $site->contact_details();

                if (
                    $organization->isNotEmpty() ||
                    $contact_details->isNotEmpty() ||
                    $address->isNotEmpty()
                ): ?>
                      <div class="footer__contact">
                          <?php
                          $address_lines = array_filter([
                              $site->organization()->toString(),
                              $address->street()->toString(),
                              implode(
                                  " ",
                                  array_filter([
                                      $address->zip()->toString(),
                                      $address->city()->toString(),
                                  ])
                              ),
                          ]);

                          if (!empty($address_lines)): ?>
                            <p>
                              <?php foreach ($address_lines as $line): ?>
                                  <?= $line ?>
                                  <?php if ($line !== end($address_lines)): ?>
                                      <br>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                            </p>
                          <?php endif;
                          ?>

                          <?php if ($contact_details->isNotEmpty()):

                              $contact_details = $contact_details->toObject();
                              $email = $contact_details->email();
                              $phone = $contact_details->phone();
                              $mobile = $contact_details->mobile();
                              ?>
                              <ul>
                                  <?php if ($email->isNotEmpty()): ?>
                                    <li><a href="mailto:<?= $email->toString() ?>"><?= $email->toString() ?></a></li>
                                  <?php endif; ?>
                                  <?php if ($phone->isNotEmpty()): ?>
                                    <li><a href="tel:<?= $phone->toString() ?>"><?= $phone->toString() ?></a></li>
                                  <?php endif; ?>
                                  <?php if ($mobile->isNotEmpty()): ?>
                                    <li><a href="tel:<?= $mobile->toString() ?>"><?= $mobile->toString() ?></a></li>
                                  <?php endif; ?>
                              </ul>
                          <?php
                          endif; ?>

                          <?php $social_media = $site->social_media()->toObject(); ?>
                            <?php if ($social_media->isNotEmpty()): ?>
                                <div class="footer__social-media">
                                <?php snippet("components/social-media", [
                                    "social_media" => $social_media,
                                ]); ?>
                                </div>
                            <?php endif; ?>
                      </div>
                  <?php endif;
                ?>
                
              </div>

            </div>
            <div class="footer__credits">
              <?php if ($site->credits()->isNotEmpty()): ?>
                <div class="container">
                  <p class="footer__credits-text"><?= $site->credits() ?></p>
                </div>
              <?php endif; ?>
          </div>
      </footer>
        <?php if ($kirby->user()): ?>
            <a href="<?= $editButtonUrl ?>" class="btn-edit" aria-label="Edit page">
                <?= $svgIconEdit ?>
                <span class="sr-only">Edit</span>
            </a>
        <?php endif; ?>
    </main>

</body>
</html>
