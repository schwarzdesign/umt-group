
<?php
use Kirby\Toolkit\Str;
$heroId = Str::slug($headline);
$heroRatio = $page->ratio_block()->value() ?: "auto";
$ratio_config = [
    "16/9" => "lg:aspect-16/9",
    "16/7" => "lg:aspect-16/7",
    "16/5" => "lg:aspect-16/5",
    "auto" => "lg:aspect-auto"
];

$heroRatioClass = $ratio_config[$heroRatio] ?? "lg:h-screen";
?>
<section>
    <div class="hero-block">
        <div class="<?= $heroRatioClass ?> lg:relative">
        <?php
        $heroImage = $page->main_image()->toFile();
        if ($heroImage):

            $thumbsConfig = kirby()->option("thumbs.srcsets");
            $sizes = tailwindThemeGetResponsiveSizes(12);
            ?>
                <?php snippet("utils/picture", [
                    "alt" => $heroImage->alt(),
                    "ratio" => $heroRatio,
                    "src" => $heroImage->url(),
                    "image" => $heroImage,
                    "thumbsConfig" => $thumbsConfig,
                    "sizes" => $sizes,
                    "maxWidth" => 1024,
                    "pictureClass" => "block w-full object-cover lg:mt-0 lg:max-w-none",
                    "imgClass" =>
                    "lg:absolute inset-0 w-full h-full object-cover banner-image",
                    "gallery" => false,
                    "show_caption_credits" => false,
                ]); ?>

                <?php
        endif;
        ?>
            <div class="hero-block__gradient"></div>
            <div class="hero-block__content">
                <div class="hero-block__inner">
                    <rewrite_this>
                            <h1 id="<?= $heroId ?>" class="hero-block__headline"><?= $headline ?></h1>
                    </rewrite_this>
                </div>
            </div>
        </div>
        <div class="hero-block__subcontent">
            <div class="hero-block__subinner">
                <?php if ($page->main_subline()->isNotEmpty()): ?>
                        <div class="hero-block__subline"><?= $page->main_subline() ?></div>
                    <?php endif; ?>
                    <div class="hero-block__links">
                        <?php foreach ($page->main_link()->toStructure() as $linkItem): ?>
                        <?php
                        $link = $linkItem->link()->toLinkObject();
                        $url = $link->toUrl();
                        $link_title = $linkItem->link_title();
                        ?>
                        <?php if ($linkItem->display()->value() === "link-arrow"): ?>
                            <a href="<?= $url ?>" class="link-arrow"><?= $linkItem
                ->link_title()
                ->or("Mehr erfahren") ?><span aria-hidden="true">→</span></a>
                        <?php else: ?>
                            <a href="<?= $url ?>" class="<?= $linkItem
                ->display()
                ->value() ?>"><?= $linkItem->link_title()->or("Mehr erfahren") ?></a>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
            </div>
            <?php $multisite = tailwindGetMultisite(); ?>
            <?php $site_sign = $multisite ? "/assets/images/{$multisite}-sign.svg" : ""; ?>
            <? if ($site_sign): ?>
                <div class="hero-block__sign">
                    <img src="<?= $site_sign ?>" alt="Sign <?= $multisite ?>" aria-hidden="true" />
                </div>
            <? endif; ?>
        </div>
    </div>
</section>
