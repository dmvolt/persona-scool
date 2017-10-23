<?php
use app\modules\file\components\Img;
?>
<?php if ($content): ?>
    <?php foreach ($content as $item): ?>
        <div class="infoblock">
            <?php if ($item->thumb): ?>
                <?php if (!empty($item->text_block2)): ?>
                    <a href="<?= $item->text_block2 ?>"><img src="<?= Img::_('slider', $item->id, '280x140', $item->thumb->filename) ?>"></a>
                <?php else: ?>
                    <img src="<?= Img::_('slider', $item->id, '280x140', $item->thumb->filename) ?>">
                <?php endif; ?>
            <?php endif; ?>
            <?php if (!empty($item->text_block2)): ?>
                <a href="<?= $item->text_block2 ?>" class="button button_light"><?= $item->button_text ?></a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>