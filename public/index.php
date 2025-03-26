<?php

use Kirby\Cms\App as Kirby;

require __DIR__ . "/../kirby/bootstrap.php";
require __DIR__ . "/../vendor/autoload.php";

if (file_exists(__DIR__ . "/../.env")) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
}

// simple multisite setup
// the first or second segment of the hostname is used to determine the content folder

$host = $_SERVER["HTTP_HOST"];
$FirstHostSegment = explode(".", $host)[0]; // Get the first segment of the host
$SecondHostSegment = explode(".", $host)[1]; // Get the second segment of the host

// read all existing multisite content folders from /content-multisites

$multisites = [];
$multisitesfolder = __DIR__ . "/../content-multisites";
if (is_dir($multisitesfolder)) {
    $multisites = array_map(
        function ($item) use ($multisitesfolder) {
            return $item; // return the folder name
        },
        array_filter(
            array_diff(scandir($multisitesfolder), ["..", "."]),
            function ($item) use ($multisitesfolder) {
                return is_dir($multisitesfolder . "/" . $item);
            }
        )
    );
}

// set the contentfolder

if (in_array($SecondHostSegment, $multisites)) {
    $contentfolder = "/content-multisites/" . $SecondHostSegment;
} elseif (in_array($FirstHostSegment, $multisites)) {
    $contentfolder = "/content-multisites/" . $FirstHostSegment;
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
