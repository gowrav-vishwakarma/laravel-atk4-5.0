<?php

namespace Gowrav\LaravelAtkIntegrate;

use Atk4\Ui\Exception\LateOutputError;
use Atk4\Ui\Exception\UnhandledCallbackExceptionError;
use Throwable;

class LaravelAtkApp extends \Atk4\Ui\App {
    protected $url_building_ext = '';
    
    public function initIncludes() {
        $this->html->js(true,new \Atk4\Ui\JsExpression(
            '$.ajaxSetup({
                headers: {
                    \'X-CSRF-TOKEN\': \'' . csrf_token() . '\'
                }
            });'
        ));

        parent::initIncludes();
	}
}