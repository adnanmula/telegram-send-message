<?php declare(strict_types=1);

namespace DemigrantSoft\Telegram\SendMessage;

final class TelegramClient
{
    public const PARSE_MODE_MARKDOWN = 'markdown';
    public const PARSE_MODE_HTML = 'html';

    private const TELEGRAM_URL = 'https://api.telegram.org';

    private $botToken;

    public function __construct(string $botToken)
    {
        $this->botToken = $botToken;
    }

    public function sendMessage(string $chatId, string $text, string $parseMode = self::PARSE_MODE_MARKDOWN): void
    {
        $url = self::TELEGRAM_URL . '/bot' . $this->botToken . '/sendMessage';

        $params = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
        ];

        $c = \curl_init();
        \curl_setopt($c, CURLOPT_URL, $url);
        \curl_setopt($c, CURLOPT_HEADER, false);
        \curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        \curl_setopt($c, CURLOPT_POST, 1);
        \curl_setopt($c, CURLOPT_POSTFIELDS, $params);
        \curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

        \curl_exec($c);
        \curl_close($c);
    }
}
