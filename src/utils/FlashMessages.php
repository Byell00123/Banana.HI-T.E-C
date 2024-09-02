<?php
// src/utils/FlashMessages.php

// Inicie a sessão se necessário
include_once 'session_start.php';

class FlashMessages {
    public static function addMessage($type, $message) {
        $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
    }

    public static function getMessages() {
        if (isset($_SESSION['flash_messages'])) {
            $messages = $_SESSION['flash_messages'];
            unset($_SESSION['flash_messages']); // Limpa as mensagens após serem lidas
            return $messages;
        }
        return [];
    }
}
?>
