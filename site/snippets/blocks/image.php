<?php
$src = null;

if ($image = $block->image()->toFile()) {
    $alt = $image->alt();
    $src = $image->url();
}
$thumbsConfig = kirby()->option("thumbs.srcsets");

$columnSpan = isset($columnSpan) ? $columnSpan : 12;
$sizes = tailwindThemeGetResponsiveSizes($columnSpan);


$enlarge = $block->lightbox() ? $block->lightbox()->toBool() : false;
$link_url = $block->link()->url();

$corner = $block->corner() ? $block->corner()->toBool() : 0;
$cornerClass = $corner == 1 ? 'block-image-corner' : '';
?>
<?php if ($src): ?>

    <?php if ($enlarge): ?>
        <div x-data="{
            imageOpened: false,
            imageActiveUrl: null,
            imageOpen(event) {
                this.imageImageIndex = event.target.dataset.index;
                this.imageActiveUrl = event.target.dataset.large;
                this.imageOpened = true;
            },
            imageClose() {
                this.imageOpened = false;
                setTimeout(() => this.imageActiveUrl = null, 300);
            },
        }" class="w-full h-full select-none">
        <div class="block-image <?= $cornerClass ?> duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
    <?php else: ?>
        <div class="block-image <?= $cornerClass ?>">
    <?php endif; ?>

    <?php snippet("utils/picture", [
        "alt" => $alt,
        "enlarge" => ($link_url == '' && $enlarge === true) ? true : false,
        "href" => $block->link()->toUrl(),
        "src" => $src,
        "ratio" => $block->ratio()->or("auto"),
        "image" => $image,
        "thumbsConfig" => $thumbsConfig,
        "sizes" => $sizes,
        "gallery" => false,
    ]); ?>

 </div>
    <?php if ($enlarge): ?>
        <template x-teleport="body">
            <div x-show="imageOpened" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:leave="transition ease-in-in duration-300" x-transition:leave-end="opacity-0" @click="imageClose" @keydown.window.escape="imageClose" x-trap.inert.noscroll="imageOpened" class="fixed inset-0 z-[99] flex items-center justify-center bg-white/90 dark:bg-black/90 select-none cursor-zoom-out" x-cloak>
                <div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12">
                    <img x-show="imageOpened" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0 transform scale-50" x-transition:leave="transition ease-in-in duration-300" x-transition:leave-end="opacity-0 transform scale-50" class="max-w-full max-h-full object-contain object-center select-none cursor-zoom-out" :src="imageActiveUrl" alt="" style="display: none;">
                </div>
            </div>
        </template>

    </div>
    <?php endif; ?>

<?php endif; ?>
