<?php

namespace app\backend\controller;

use app\common\Backend;

class Index extends Backend {

    public function index() {
        return $this->fetch('index');
    }

}
