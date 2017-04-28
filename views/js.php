<?php
/**
 * FuelPHP Custom Messages
 * "MIT License"
 * @Copyright 2017 Keite Trần <anhtrn90@gmail.com>
 * @Author anhtn
 */
?>
<?php if (!empty($entries)): ?>
  <script type="text/javascript">
    $(document).ready(function () {
  <?php
  $msgs = '';
  foreach ($entries as $entrie) {
    if ($js_alert_plugin == 'bootbox') {
      $msgs .= '<li>' . $entrie->message . '</li>';
    } else {
      $msgs .= $entrie->message . '\n';
    }
  }
  ?>
  <?php if ($js_alert_plugin == 'bootbox'): ?>
        bootbox.alert({
          className: 'bb-custom-alert',
          size: "small",
          closeButton: false,
          title: "<?php echo $entrie->title; ?>",
          message: '<?php echo '<ul>' . $msgs . '</ul>' ?>',
          buttons: {
            ok: {
              label: 'OK',
              className: 'btn-default btn-block'
            }
          }
        });
  <?php else: ?>
        alert('<?php echo $msgs; ?>');
  <?php endif; ?>
    });
  </script>
<?php endif; ?>
