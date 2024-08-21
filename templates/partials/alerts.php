<?php if (isset($error)): ?>
    <div class="errorWrap">
        <strong>ERROR</strong> :<?= $this->e($error); ?>
    </div>
<?php elseif (isset($msg)): ?>
    <div class="succWrap">
        <strong>SUCCESS</strong> :<?= $this->e($msg); ?>
    </div>
<?php endif;
