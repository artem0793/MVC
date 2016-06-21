<?php

abstract class AbstractModel {
    final public function __construct(array $config = NULL) {
        if ($config) {
            db_connect($config);
        }
    }
}
