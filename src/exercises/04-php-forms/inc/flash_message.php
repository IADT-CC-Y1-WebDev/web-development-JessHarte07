<?php
$flash = getFlashMessage();
if ($flash): ?>
    <div class="flash-message <?= h($flash['type']) ?>">
        <?= h($flash['message']) ?>
    </div>
<?php endif; ?>
