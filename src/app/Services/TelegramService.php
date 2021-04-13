<?php
/**
 * @author Nguyen Van Tinh <tinhnguyenvan91@gmail.com>
 * @date 13/04/21 10:35 AM
 */

namespace App\Services;

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class TelegramService
{
    public static function send($content): Message
    {
        $apiTelegram = new Api(config('telegram.token'));

        $content = is_array($content) && !empty($content) ? implode(PHP_EOL, $content) : $content;
        return $apiTelegram->setTimeout(30)->sendMessage(
            [
                'chat_id' => config('telegram.group_id'),
                'text' => $content,
                'parse_mode' => 'HTML',
                'http_client_timeout' => 40,
                'http_client_connect_timeout' => 30,
            ]
        );
    }
}
