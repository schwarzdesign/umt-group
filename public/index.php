<?php

use Kirby\Cms\App as Kirby;

require __DIR__ . "/../kirby/bootstrap.php";
require __DIR__ . "/../vendor/autoload.php";

if (file_exists(__DIR__ . "/../.env")) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
}

$host = $_SERVER["HTTP_HOST"];
$hostSegment = explode(".", $host)[0];

$multisites = [];
$multisitesfolder = __DIR__ . "/../content-multisites";
if (is_dir($multisitesfolder)) {
    $multisites = array_map(
        function ($item) use ($multisitesfolder) {
            return $item; 
        },
        array_filter(
            array_diff(scandir($multisitesfolder), ["..", "."]),
            function ($item) use ($multisitesfolder) {
                return is_dir($multisitesfolder . "/" . $item);
            }
        )
    );
}

if (in_array($hostSegment, $multisites)) {
    $contentfolder = "/content-multisites/" . $hostSegment;
} else {
    $contentfolder = "/content";
}


echo (new Kirby([
    "roots" => [
        "index" => __DIR__,
        "base" => dirname(__DIR__),
        "content" => dirname(__DIR__) . $contentfolder,
        "site" => dirname(__DIR__) . "/site",
        "media" => dirname(__DIR__) . "/public/media",
        "kirby" => dirname(__DIR__) . "/kirby",
        "vendor" => dirname(__DIR__) . "/vendor",
        "assets" => __DIR__ . "/assets",
        "fontawesome" => __DIR__ . "/assets/fonts/fontawesome/6.6.0",
    ],
]))->render();
