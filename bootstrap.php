<?php

/**
 * FuelPHP Custom Messages
 * "MIT License"
 * @Copyright 2017 Keite Trần <anhtrn90@gmail.com>
 * @Author anhtn
 */
Autoloader::add_core_namespace('Messages');

Autoloader::add_classes(array('Messages\\Messages' => __DIR__ . '/classes/messages.php'));
