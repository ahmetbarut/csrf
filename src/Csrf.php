<?php

namespace ahmetbarut\Csrf;

class Csrf
{
    /**
     * Tokeni tutar
     * @var string
     */
    protected string $token;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_REQUEST)) {
            $this->generateToken();
        }
    }

    /**
     * Yeni bir token oluşturur
     */
    public function generateToken()
    {
        $this->token = $_SESSION["_token"] = md5(time() . rand(0, 9999));
    }

    /**
     * tokenin varlığını kontrol eder.
     * @param array|object $post
     * @return bool
     */
    public function tokenHas(array | object $post): bool
    {
        if (is_array($post)) {
            $post = (object) $post;
        }
        if (isset($post->_token)) {
            if ($post) {
                if ($post->_token === $this->getToken()) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    /**
     * Oluşturulan Tokeni getirir.
     * @return string
     */
    public function getToken(): string
    {
        return $_SESSION['_token'];
    }

    /**
     * Hata durumunda dönecek hata kodu ve mesajı
     * @param int $code
     * @param string $message
     */
    public function error($code = 419, $message = "Page Expired")
    {
        return header("HTTP/1.1 {$code} {$message}");
    }
}
