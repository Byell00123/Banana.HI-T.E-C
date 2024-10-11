<?php
include_once(dirname(__FILE__) . '/../../utils/FlashMessages.php');
?>

<?php if ($flash_messages): ?>
    <?php foreach ($flash_messages as $flash_message): ?>
        <div class="<?php echo $flash_message['type']; ?>" style="color: <?php echo $flash_message['type'] == 'error' ? 'red' : 'green'; ?>;">
            <?php echo $flash_message['message']; ?>
        </div>
    <?php endforeach;?>
<?php endif; ?>