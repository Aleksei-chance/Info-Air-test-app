<?php

namespace Core;

class Request
{
    public string $uri;

    public function __construct($uri)
    {
        $this->uri = trim(urldecode($uri));
        $this->getLang();
    }

    public function getLang(): void
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 3);

        $langMap = [
            'ru' => 'rus',
            'en' => 'eng',
            'de' => 'ger',
        ];

        $userLang = ['rus', 'eng', 'ger'];
        $lang = $langMap[$lang] ?? $lang;
        if (!in_array($lang, $userLang)) {
            $lang = 'rus';
        }

        $_GET['lang'] = $lang;
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function get($name, $default = null): ?string
    {
        return $_GET[$name] ?? $default;
    }

    public function post($name, $default = null): ?string
    {
        return $_POST[$name] ?? $default;
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    protected function removeQueryString(): string
    {
        if ($this->uri) {
            $params = explode('?', $this->uri);
            return trim($params[0], '/');
        }
        return '';
    }
}
