<?php if (isset($error)) : ?>
    <div class="errorWrap" id="msgshow"><?= $this->e($error); ?> </div>
<?php elseif (isset($msg)) : ?>
    <div class="succWrap" id="msgshow"><?= $this->e($msg); ?> </div>
<?php endif;
