<?php

namespace Infrastructure;

// Класс Менеджер сессии
class SessionManager
{
    const SESSION_NAME = 'HOME_WORK_SESSION';

    // проверка входа
    static function IsLogged(): bool
    {
        self::setSession();

        return isset($_SESSION['isLogged']);
    }

    // вход в сессию
    static function Login(): void
    {
        self::setSession();

        $_SESSION['isLogged'] = true;
    }

    // выход из сессии
    static function Logout(): void
    {
        self::setSession();
        
        $_SESSION = [];
        if (session_id() != "" || isset($_COOKIE[session_name()]))
            setcookie(session_name(), '', time() - 1, '/');

        session_destroy();
    }

    // установка сессии
    static function setSession() {
        if (session_name() !== self::SESSION_NAME) {
            session_name(self::SESSION_NAME);
            session_start();
        }
    }
    
    // alert для вывода ошибки входа
    static function getAlertErrorMessage(): string
    {
        return '<div class="alert alert-danger m-3 w-22rem" role="alert">
            Ошибка входа
            </div>';
    }
}