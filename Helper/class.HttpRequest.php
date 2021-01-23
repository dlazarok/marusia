<?php


namespace ILoveMarusia\Common\Helper;

/**
 * @todo изучить вопрос и поправить класс добавив безопасности
 */
class HttpRequest
{
    private static $instance = null;
    private $body = '';
    private $additionalParams = array();
    private $requestHeaders = array();

    /**
     * Реализация синглтона
     * @return HttpRequest
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Конструктор. Запускает сессию, читает запрос из php://input, уберает экранирование
     */
    private function __construct()
    {
        if (PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }

        $file = fopen('php://input', 'r');
        if (get_magic_quotes_gpc()) {
            self::strips($_COOKIE);
            self::strips($_REQUEST);
            if (!empty($_SERVER['PHP_AUTH_USER'])) self::strips($_SERVER['PHP_AUTH_USER']);
            if (!empty($_SERVER['PHP_AUTH_PW'])) self::strips($_SERVER['PHP_AUTH_PW']);
        }
        $this->getHeaders();
        if (is_resource($file)) {
            while (!feof($file)) {
                $this->body .= fgets($file);
            }
            fclose($file);
            $this->parseRequest();
        }
    }

    private function parseRequest()
    {
        if (!$this->getHeader('CONTENT-TYPE')) {
            return;
        }

        $mime = explode(';', $this->getHeader('CONTENT-TYPE'));
        switch ($mime[0]) {
            case 'multipart/form-data':
            case 'application/x-www-form-urlencoded':
                $this->parseBodyAsUrlEncde();
                break;
            case 'application/json':
                $this->parseBodyAsJson();
                break;
        }
    }

    private static function urldecodeRequest($value)
    {
        if (is_array($value)) {
            foreach ($value as &$subvalue) {
                $subvalue = self::urldecodeRequest($subvalue);
            }
            return $value;
        }
        return urldecode($value);
    }

    private function parseBodyAsUrlEncde()
    {
        parse_str($this->body, $data);
        self::urldecodeRequest($data);
    }

    private function parseBodyAsJson()
    {
        $data = json_decode($this->body, true);
        if (empty($data)) {
            return;
        }
        foreach ($data as $key => $value) {
            $this->additionalParams[$key] = $value;
        }
    }

    /**
     * Уберает экранирование с данных
     * @param array $array
     */
    private static function strips(&$array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                self::strips($array[$key]);
            }
        } else {
            $array = stripslashes($array);
        }
    }

    /**
     * Возвращает тело http запроса
     * @return string
     */
    public function getRequestBody(): string
    {
        return $this->body;
    }

    /**
     * Проверяет является ли запрос Ajax запросом
     * @return bool
     */
    public function isAjaxRequest(): bool
    {
        return $this->getHeader('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest';
    }

    /**
     * Возвращает HTTP метод
     * @return type
     */
    public function getHttpMethod(): string
    {
        return strtoupper($this->getHeader('REQUEST_METHOD'));
    }

    /**
     * Геттер. Возвращает параметр из тела запроса
     * @param type $name
     */
    public function __get($name)
    {
        return $this->getRequestParam($name);
    }

    /**
     * Cеттер дополнительных параметров.
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value)
    {
        $this->additionalParams[$name] = urldecode($value);
    }

    /**
     * Возвращает значение заголовка
     * @param string $header
     * @return type
     */
    public function getHeader(string $name)
    {
        return (isset($this->requestHeaders[$name]) ? $this->requestHeaders[$name] : null);
    }

    /**
     * Что-то вышка клоака, подумать и переделать
     */
    private function getHeaders()
    {
        $this->requestHeaders = $_SERVER;
        if (!function_exists('getallheaders')) {
            foreach ($_SERVER as $name => $value) {
                if (strpos($name, 'HTTP_') === 0) {
                    $this->requestHeaders[str_replace(' ', '-', strtoupper(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
        } else {
            $buffer = getallheaders();
            foreach ($buffer as $key => $value) {
                $this->requestHeaders[strtoupper($key)] = $value;
            }
        }
    }

    /**
     * Возвращает параметр из куки по названию
     * @param type $name
     * @return type
     */
    public function getCookieParam(string $name)
    {
        return $_COOKIE[$name];
    }

    /**
     * Возвращает URI запроса
     * @return type
     */
    public function getHttpUri(): string
    {
        return $this->getHeader('REQUEST_URI');
    }

    /**
     * Возвращает параметр из реквеста(GET|POST)
     * @param string $name
     * @return type
     */
    public function getRequestParam(string $name)
    {
        if (isset($this->additionalParams[$name])) {
            return $this->additionalParams[$name];
        }
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
    }

    /**
     * Возвращает загруженный пользователем файл (_FILES).
     * @param string $name - название поля формы
     * @return null|array $_FILES[$name]
     */
    public function getRequestFile(string $name)
    {
        return isset($_FILES[$name]) && $_FILES[$name]['size'] && $_FILES[$name]['tmp_name'] ? $_FILES[$name] : null;
    }

    /**
     * Возвращает значение параметра из сессии пользователя
     * @param string $name
     * @return type
     */
    public function getSessionParam(string $name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /**
     * Устанавливает параметр в куки
     * @param string $name
     * @param type $value
     * @param type $expire
     * @param type $path
     * @param type $domain
     */
    public function setCookieParam(string $name, $value, $expire = null, $path = null, $domain = null)
    {
        setcookie($name, $value, $expire, $path, $domain);
    }

    /**
     * Устанавливает значение параметра в сессии пользователя
     * @param string $name
     * @param type $value
     */
    public function setSessionParam(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }
}