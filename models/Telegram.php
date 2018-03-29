<?php

namespace app\models;

use yii\db\Expression;

class Telegram
{
    const TOKEN = '595054108:AAEJjBZvh_XgzqNBFNM84jeCavOFr_2t8bY';
    const BASE_API_URL = "https://api.telegram.org/bot" . self::TOKEN . "";

    const DEBUG_STATUS = FALSE;

    const HR = '&lt;b&gt;';

    public $chat_id;
    public $output;
    public $debug;
    public $first_name;

    public $message;

    public function __construct()
    {
        $this->output = json_decode(file_get_contents('php://input'), TRUE);
        $this->chat_id = $this->output['message']['chat']['id'];
        $this->first_name = $this->output['message']['from']['first_name'];
        $this->debug['status'] = self::DEBUG_STATUS;
        $this->debug['text'] = print_r((object)$this->output, TRUE);
        \Yii::error('!');
        $this->combine();
    }

    public function __destruct()
    {
        \Yii::error('YAY! DESTRUCT!');
        if ($this->message) $this->sendMessage($this->chat_id, $this->message);
    }

    public function combine($counter = 0)
    {
        $string = $this->output['message']['text'];
        $telegram_id = $this->output['message']['chat']['id'];

        $pos = mb_strpos($string, '@');
        if (!$pos) $method = mb_substr($string, 1); else
            $method = mb_substr($string, 1, --$pos);

        switch ($method) {
            case 'start':
                $already_member = Admin::find()
                    ->where(['telegram_id' => $telegram_id])
                    ->count();

                if ($already_member) return $this->sendMessage($telegram_id, 'Ваш аккаунт уже привязан к панели администратора.');

                $bot_member = AdminTelegramClients::find()
                    ->where(['telegram_id' => $telegram_id])
                    ->limit(1)
                    ->one();

                if (!$bot_member) {
                    $bot_member = new AdminTelegramClients();

                    $bot_member->telegram_id = (string)$telegram_id;
                }

                $bot_member->code_id = rand(10000, 99999);

                if (!$bot_member->save()) \Yii::error(print_r($bot_member->errors, 1));

                $message = "<pre>Приветствую, администратор!</pre>\nДля интеграции бота с панелью администрации тебе необходимо ввести следующий код:\n\nКод: <b>" . $bot_member->code_id . "</b>";

                $this->sendMessage($telegram_id, $message);

                break;
        }

        \Yii::error('method: ' . $method);
    }

    public function sendMessage($chat_id, $message)
    {
        if (is_array($chat_id)) foreach ($chat_id as $chat) {
            $result = General::curl_call(self::BASE_API_URL . '/sendMessage?chat_id=' . $chat . '&text=' . urlencode($message) . '&parse_mode=HTML', false);
        } else
            $result = General::curl_call(self::BASE_API_URL . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&parse_mode=HTML', false);

        \Yii::error('DONE! SENT! Chat_ID: ' . $chat_id . ' username ' . $this->output['message']['from']['username']);
        \Yii::info('Result:' . print_r($result, 1));
    }
}

