<?php if (isset($error)) : ?>
    <div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div>
<?php elseif (isset($msg)) : ?>
    <div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div>
<?php endif;
