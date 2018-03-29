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
        if($this->message) $this->sendMessage($this->chat_id, $this->message);
    }

    public function combine($counter = 0)
    {
        $string = $this->output['message']['text'];
        $pos = mb_strpos($string, '@');
        if (!$pos)
            $method = mb_substr($string, 1);
        else
            $method = mb_substr($string, 1, --$pos);

        if (mb_strpos($string, '/add') === 0) $method = 'add';
        else if (mb_strpos($string, '/write') === 0) $method = 'wrt';
        if(mb_strpos(mb_strtolower($string), 'ваня') !== false || mb_strpos(mb_strtolower($string), 'вано') !== false || mb_strpos(mb_strtolower($string), 'в а н я') !== false || mb_strpos(mb_strtolower($string), 'вань') !== false) $method = 'van';

        //        $this->sendMessage($this->chat_id, 'POS: ' . $pos);

        if ($method == 'pizda' && $counter < 3) {
            $text = $this->setAction($method . 1);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 5));
            $text = $this->setAction($method . 2);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 5));
            $text = $this->setAction($method . 4);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 5));
            $text = $this->setAction($method . 5);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 5));
            $text = $this->setAction($method . 6);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 5));
            $text = $this->setAction($method . 7);
            $this->sendMessage($this->chat_id, $text);
            sleep(rand(1, 8));
            $text = $this->setAction($method . 3);

        } else if ($method == 'kill') {
            for ($i = 0; $i < 3; $i++) {
                $text = $this->setAction($method);
                $this->sendMessage($this->chat_id, $text);
                sleep(rand(1, 5));
            }
        } else if ($method == 'add' || $method == 'wrt') {
            if ($this->output['message']['chat']['type'] !== 'private') {
                $text = $this->setAction('nahuj_s_plyazha');

                return 1;
            }

            $text = trim(mb_substr($string, $method == 'wrt' ? 7 : 5));
            $who = ($this->output['message']['from']['username'] ? '@' . $this->output['message']['from']['username'] : $this->output['message']['from']['first_name'] . ' ' . $this->output['message']['from']['last_name']);

            if($method == 'wrt') {
                $new_message = new BotMessages();

                $new_message->message = $text;
                $new_message->who = $who;
                $new_message->timestamp = time();

                if(!trim($who)) {
                    $this->setAction('where_is_fucking_phrase');

                    return;
                }
                $new_message->save();

                $this->sendMessage(TestController::chat_id, '<pre>ПРИВАТНОЕ: </pre>' . $text);

                $this->message = false;

                $this->setAction('private_sent');

                return;
            }

            $new_phrase = new BotPhrases();

            $new_phrase->text = $text;
            $new_phrase->who = $who;

            if (!$new_phrase->text) return $this->setAction('where_is_fucking_phrase');

            $new_phrase->save();

            $text = $this->setAction('done_new_phrase');
        } else
            $text = $this->setAction($method);
        $this->message = $text . ($this->debug['status'] ? '<code>' . $this->debug['text'] . '</code>
__________________
<code>CMD: ' . $method . '</code>' : '');

        \Yii::error('method: ' . $method);
    }

    public function sendMessage($chat_id, $message)
    {
        if (is_array($chat_id))
            foreach ($chat_id as $chat) {
                General::curl_call(self::BASE_API_URL . '/sendMessage?chat_id=' . $chat . '&text=' . urlencode($message) . '&parse_mode=HTML', false);
            }
        else
            General::curl_call(self::BASE_API_URL . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&parse_mode=HTML', false);

        \Yii::error('DONE! SENT! Chat_ID: ' . $chat_id . ' username ' . $this->output['message']['from']['username']);
    }

    public function setAction($action)
    {
        $username = ($this->output['message']['from']['username'] ? '@' . $this->output['message']['from']['username'] : $this->output['message']['from']['first_name'] . ' ' . $this->output['message']['from']['last_name']);

        switch ($action) {
            case 'pizda1':
                return 'Охуел, сука? Ты, ' . $this->first_name . ', блядь, бессмертный ваще! На блядь! Пинга тебе, СУКА: ' . $username;
                break;
            case 'pizda2':
                return 'Пиздец ты охуевший кадр, ' . $username . ', реально! Я с тебя охуеваю тупо.';
                break;
            case 'pizda3':
                return $username . ', я тебя выебу с:';
                break;
            case 'pizda4':
                return $username . ' тебе кто-нибудь когда-нибудь по ебальнику давал? (Нет? Дам я :D только заебалась строчить уже, охладите траханье:)';
                break;
            case 'pizda5':
                return $username . ' любишь минет? ';
                break;
            case 'pizda6':
                return $username . ' делать?';
                break;
            case 'pizda7':
                return $username . '  а если я сейчас фотки сюда после вчерашнего скину?:)';
                break;
            case 'kill':
                return 'СДОХНИ ЛАПУСЕЧКА, ТВАРЬ ЕБАНАЯ БЛЯДЬ';
                break;
            case 'nahuj_s_plyazha':
                return 'Ебанутый? Я буду с тобой базарить только в личке, петух!';
                break;
            case 'done_new_phrase':
                return 'Готово! Фраза добавлена. Иди подрочи.';
                break;
            case 'say':
                $phrase = BotPhrases::find()
                    ->orderBy(new Expression('rand()'))
                    ->limit(1)
                    ->one();

                return $phrase->text;
                break;
            case 'where_is_fucking_phrase':
                return 'Ты уебан? Нахуя ты пустые сообщения шлешь, ублюдок мать твою?';
                break;
            case 'bdzhhh':
                return 'ВИБРАТОР ДАРИНЫ СРАБОТАЛ!';
            case 'zavodiGusya':
                return 'Ты мне тут поспамь, блядь, ' . $username . '. Забанить тебя, сука??';
            case 'private_sent':
                return 'Успешно послал ... тебя нахуй!!! :)';
            case 'van':
                $array = [
                    'че блядь',
                    'ну',
                    'говори, заебешь',
                    'ДА ОТЪЕБИСЬ БЛЯДЬ',
                    'ЧЕГО ТЕБЕ',
                    'сука, когда же ты уже сдохнешь',
                    'отъебись',
                    'блять, НЕ ТРОГАЙТЕ ВАНЮ СУКИ',
                    'слушай, да ты бессмертное существо!',
                    'я тебе писю чик-чик',
                    'ебанись-перевернись!',
                    'еще раз так сделаешь, я тебя заспамлю',
                    'хуяня!',
                    'съебался'
                ];
                return $array[array_rand($array)];
                break;
            case 'help':
                return '
Короче. 
Я могу:
    <b>/pizda</b> - ПОСЛАТЬ ТЕБЯ НАХУЙ
    <b>/kill</b> - ВЫЕБАТЬ ЛАПУСЕЧКУ!!!!!!!';
                break;
            default:
                return false;
                break;
        }
    }
}


?>