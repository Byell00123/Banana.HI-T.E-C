<?php
// src/utils/FlashMessageManager.php
include_once(dirname(__FILE__) . '/FlashMessages.php');

class FlashMessageManager {
    private static $messages = null;

    public static function getMessages() {
        if (self::$messages === null) {
            self::$messages = FlashMessages::getMessages(); // Carrega as mensagens uma vez
        }
        return self::$messages;
    }
}