<?php if (isset($error)): ?>
    <div class="errorWrap">
        <strong>ERROR</strong> :<?= htmlentities($error); ?>
    </div>
<?php elseif (isset($msg)): ?>
    <div class="succWrap">
        <strong>SUCCESS</strong> :<?= htmlentities($msg); ?>
    </div>
<?php endif;
