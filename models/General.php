<?php
/**
 * Created by PhpStorm.
 * User: Kinselok
 * Date: 9/7/2016
 * Time: 1:13 PM
 */

namespace app\models;

use Yii;

class General extends \Yii
{
    public static function newToken($length = 32)
    {
        return \Yii::$app->security->generateRandomString($length);
    }

    public static function post($alias = null)
    {
        $post = Yii::$app->request->post($alias);
        if (is_string($post)) $post = trim($post);

        return $post;
    }


    /**
     * @return Client|bool
     */
    public static function getUser($from_db = 0)
    {
        if (!self::getSession('auth_info')) return false;

        if ($from_db) return Client::find()
            ->where(['id' => self::getSession('auth_info')->id])
            ->limit(1)
            ->one();

        return General::getSession('auth_info');
    }

    public static function isWholesale($client_id = false)
    {
        if (!$client_id) $client = self::getUser(); else $client = Client::find()
            ->select('wholesale')
            ->where(['id' => $client_id])
            ->limit(1)
            ->one();

        return $client->wholesale;
    }

    public static function discount($price, $discount)
    {
        return $price - ($price / 100 * $discount);
    }

    /**
     * @param ShopProducts $product |array
     *
     * @return float|int
     */
    public static function actualPrice($product, $client_id = false)
    {
        if (!$client_id) $client = self::getUser(); else $client = Client::find()
            ->where(['id' => $client_id])
            ->limit(1)
            ->one();

        if ($client->wholesale) {
            $price = is_array($product) ? $product['wholesale_price'] : $product->wholesale_price;

            return self::discount($price, self::getUser()->wholesale_discount);
        } else {
            $price = is_array($product) ? $product['retail_price'] : $product->retail_price;

            return self::discount($price, self::getUser()->retail_discount);
        }
    }

    public static function setFlash($key, $value = true, $removeAfterAccess = true)
    {
        return Yii::$app->session->addFlash($key, $value, $removeAfterAccess);
    }

    public static function getFlash($name = 'errors')
    {
        return Yii::$app->session->getFlash($name);
    }

    public static function randomChars($len = 32)
    {
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base) {
            $i = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }

        return (string)substr($result, -5);
    }


    public static function curl_call($url, $cmd, $timeout = 15)
    {

        $_cmd = json_encode($cmd);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: ' . strlen($_cmd)
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $_cmd);

        $data = curl_exec($ch);

        $info = curl_getinfo($ch);

        $curl_err = curl_error($ch);

        curl_close($ch);

        if ($data !== false && $info['http_code'] == 200) {
            $result = [
                'status'  => 'OK',
                'message' => json_decode($data, true)
            ];
        } else {
            $result = [
                'status'  => 'error',
                'message' => 'cURL error: ' . $curl_err
            ];
        }

        return $result;

    }

    public static function getSession($data, $data2 = null, $data3 = null)
    {
        $session = \Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (isset($data2)) return $session[$data][$data2]; else if (isset($data3)) return $session[$data][$data2][$data3]; else
            return $session[$data];
    }

    public static function setSession($alias, $data)
    {
        $session = \Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $session[$alias] = $data;
    }

    public static function destroySession($alias)
    {
        $session = \Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $session->set($alias, '');
        $session->remove($alias);
    }

    public static function setCookie($alias, $data, $expires = false)
    {
        if ($expires) {
            if (Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name'   => $alias,
                    'value'  => $data,
                    'expire' => time() + $expires,
                    'domain' => '/'
                ])) || setcookie($alias, $data, time() + $expires, '/')) return true; else
                return false;
        } else {
            if (Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name'   => $alias,
                    'value'  => $data,
                    'expire' => time() + 60 * 60 * 24 * 31
                ])) || setcookie($alias, $data, time() + 60 * 60 * 24 * 365, '/')) return true; else
                return false;
        }
    }

    public static function getCookie($alias)
    {
        $cookies = \Yii::$app->request->cookies;
        $result = $cookies->getValue($alias, null);

        if (!$result) $result = $_COOKIE[$alias];

        return $result;
    }

    public static function destroyCookie($alias)
    {
        $cookies = General::$app->response->cookies;
        $cookies->remove($alias);
    }

    public static function printR($array, $mode = 0)
    {
        echo ' <style>
         pre{
                display:
                block;
                padding:
                9.5px;
             margin: 0 0 10px;
             font - size: 13px;
             line - height: 1.42857143;
             color: #333;
             word -break: break-all;
             word - wrap: break-word;
             background - color: #f5f5f5;
             border: 1px solid #ccc;
             border - radius: 4px;
         }
     </style> ';
        echo '<pre > ';
        print_r($array);
        echo '</pre > ';
        if (!$mode) die();
    }

    public static function translit($string, $divider = '_')
    {
        $charlist = [
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ж" => "J",
            "З" => "Z",
            "И" => "I",
            "Й" => "Y",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "H",
            "Ц" => "TS",
            "Ч" => "CH",
            "Ш" => "SH",
            "Щ" => "SCH",
            "Ъ" => "",
            "Ы" => "YI",
            "Ь" => "",
            "Э" => "E",
            "Ю" => "YU",
            "Я" => "YA",
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ж" => "j",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "y",
            "ы" => "yi",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            " " => $divider,
        ];

        return strtr($string, $charlist);
    }
}