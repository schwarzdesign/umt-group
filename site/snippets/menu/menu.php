<header x-data="{ open: false }" @keydown.window.escape="open = false" class="header">
  <nav class="nav" aria-label="Global">
      <div class="nav__brand">
        <?php snippet('menu/menu-brand') ?>
      </div>
      <div class="mobile-nav__burger">
        <button type="button" class="mobile-nav__burger-button" @click="open = true">
          <span class="sr-only"><?= t('open_menu', 'Open') ?></span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
          </svg>
      </button>
    </div>
      <?php $items = $site->menu()->toStructure() ?>
      <?php if ($items->isNotEmpty()): ?>
        <div class="nav__menu">
            <ul class="menu nav__list">
                <?php snippet('menu/menu-language-switch') ?>
                <?php snippet('menu/menu-item-list', ['items' => $items]) ?>
            </ul>
            <ul class="menu nav__buttons">
                <?php snippet('menu/menu-button') ?>
            </ul>
        </div>
      <?php endif ?>
  </nav>
  <div x-description="Mobile menu, show/hide based on menu open state." class="mobile-nav" x-ref="dialog" x-show="open" aria-modal="true" style="display: none;">
      <div x-description="Background backdrop, show/hide based on slide-over state." class="mobile-nav__background"></div>
      <div class="mobile-nav__container" @click.away="open = false">
        <div class="mobile-nav__brand">

          <?php snippet('menu/menu-brand') ?>

          <button type="button" class="mobile-nav__close-button" @click="open = false">
            <span class="sr-only"><?= t('close_menu', 'Close') ?></span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

        </div>
        <div class="mobile-nav__content">
          <div class="-my-6">

              <?php $items = $site->menu()->toStructure() ?>
              <?php if ($items->isNotEmpty()): ?>
                <div class="mobile-nav__element">
                  <?php snippet('menu/mobile-menu-item-list', ['items' => $items]) ?>
              </div>
              <?php endif ?>
              
              <?php $button_items = $site->menu_button()->toStructure() ?>
              <?php if ($button_items->isNotEmpty()): ?>
                <div class="mobile-nav__element border-top">
                  <ul class="mobile-nav__list">
                    <?php snippet('menu/menu-button') ?>
                  </ul>
                </div>
              <?php endif ?>
              <?php $languages= kirby()->languages()->count() ?>
              <?php if ($languages>1): ?>
                <div class="mobile-nav__element border-top">
                  <ul class="mobile-nav__list menu">
                    <?php snippet('menu/menu-language-switch') ?>
                  </ul>
                </div>
              <?php endif ?>
              <?php $social_media = $site->social_media()->toObject(); ?>
              <?php if ($social_media->isNotEmpty()): ?>
                <div class="mobile-nav__element border-top">
                  <?php snippet('components/social-media', ['social_media' => $social_media]) ?>
                </div>
              <?php endif ?>
          </div>
        </div>
      </div>
    </div>
</header>

  
