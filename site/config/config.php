<?php


$environment = $_ENV["ENVIRONMENT"] ?: 'development';
$isDev = 'development' === $environment;
$isProd = 'production' === $environment;

$enlarge_size = 1600;

return [
    "plain.formblock" => [
         "from_email" => [$_ENV["SMTP_EMAIL"] => "nxttool DEV"]
     ],
    "johannschopplich.copilot" => [
        "providers" => [
            "openai" => [
                "model" => "gpt-4.1",
                "apiKey" => $_ENV["OPENAI_API_KEY"],
            ],
        ],
        "systemPrompt" =>
            "Bei Antworten im HTML-Fomat: Geben nur den Inhalt aus, der in die <body>-Tags passen würde. Der <head>-Abschnitt oder andere Teile einer vollständigen HTML-Dokumentenstruktur dürfen nicht enthalten sein. Entferne alle Markdown-Formatierungen.",
        "temperature" => 0.8,
        "maxGenerationTokens" => 32000,
        "excludedBlocks" => [
            "quote",
            "button",
            "cta",
            "link-list",
            "teaser",
            "person",
            "form",
            "gallery",
            "image",
            "video",
            "markdown",
            "list",
            "code"
        ]
    ],
    'debug' => true,
    "languages" => true,
    'panel' => [
        'install' => $isDev,
    ],
    'cache' => [
        'pages' => [
            'active' => $isProd,
        ],
    ],
    "schwarzdesign.nxttool-core" => [
        "replicate_api_key" => $_ENV["REPLICATE_API_KEY"],
        "text" => [
            "endpoint" => "https://api.openai.com/v1/chat/completions",
            "model" => "gpt-4.1",
            "fast" => "gpt-4.1-mini",
            "apiKey" => $_ENV["OPENAI_API_KEY"],
            "temperature" => 0.8,
            "maxGenerationTokens" => 16000,
            "systemPrompt" =>
                "Bei Antworten im HTML-Fomat: Geben nur den Inhalt aus, der in die <body>-Tags passen würde. Der <head>-Abschnitt oder andere Teile einer vollständigen HTML-Dokumentenstruktur dürfen nicht enthalten sein. Entferne alle Markdown-Formatierungen.",
        ],
    ],
    "auth" => [
         "methods" => ["password", "password-reset"],
         'challenge' => [
            'timeout' => 20 * 60, // 20 minutes
            'email' => [
                'from' => $_ENV["SMTP_EMAIL"]
		    ]
	 ]
     ],
    "email" => [
        "transport" => [
            "type" => "smtp",
            "host" => $_ENV["SMTP_HOST"],
            "port" => $_ENV["SMTP_PORT"],
            "security" => true,
            "auth" => true,
            "username" => $_ENV["SMTP_USER"],
            "password" => $_ENV["SMTP_PWD"],
        ],
    ],
    "thumbs" => [
        "srcsets" => [
            "default" => [
                "640w" => ["width" => 640],
                "768w" => ["width" => 768],
                "1024w" => ["width" => 1024],
                "1280w" => ["width" => 1280],
                "1536w" => ["width" => 1536],
            ],
            "webp" => [
                "640w" => ["width" => 640, "format" => "webp"],
                "768w" => ["width" => 768, "format" => "webp"],
                "1024w" => ["width" => 1024, "format" => "webp"],
                "1280w" => ["width" => 1280, "format" => "webp"],
                "1536w" => ["width" => 1536, "format" => "webp"],
            ],
        ],
        "enlarge" => $enlarge_size,
    ],
    "search.include.templates" => [
        "home",
        "page-layout",
        "content-text",
        "content-text2brand",
        "content-text2easy",
        "content-person",
        "content-news",
        "content-job-offer"
    ],
];
