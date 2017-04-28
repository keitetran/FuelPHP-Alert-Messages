<?php
/**
 * FuelPHP Custom Messages
 * "MIT License"
 * @Copyright 2017 Keite Trần <anhtrn90@gmail.com>
 * @Author anhtn
 */
?>
<?php if (!empty($entries)): ?>
  <?php foreach ($entries as $entrie): ?>
    <div class="alert alert-<?php echo $entrie->type; ?>">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <?php if (!empty($entrie->title)): ?>
        <h4><?php echo $entrie->title; ?></h4>
      <?php endif ?>
      <?php if (is_array($entrie->message)): ?>
        <ul>
          <?php foreach ($entrie->message AS $msg): ?>
            <li><?php echo $msg; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p><?php echo $entrie->message; ?></p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>