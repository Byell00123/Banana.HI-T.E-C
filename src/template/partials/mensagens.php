<?php
// src/template/partial/mensagens.php
include_once(dirname(__FILE__) . '/../../utils/FlashMessageManager.php');
$flash_messages = FlashMessageManager::getMessages(); // Obtém as mensagens de forma centralizada
?>
<?php if ($flash_messages): ?>
    <?php foreach ($flash_messages as $flash_message): ?>
        <div class="mensagens <?php echo $flash_message['type']; ?>">
            <div class="mensagem <?php echo $flash_message['type']; ?>">
                <?php echo $flash_message['message']; ?>
            </div>
        </div>
        <?php endforeach;?>
<?php endif; ?>