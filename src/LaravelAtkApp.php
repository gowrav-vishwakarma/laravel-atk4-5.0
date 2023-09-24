<?php

namespace Gowrav\LaravelAtkIntegrate;

use Atk4\Ui\Exception\LateOutputError;
use Atk4\Ui\Exception\UnhandledCallbackExceptionError;
use csrf_token;

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

    /**
     * Catch exception.
    */
    public function caughtException(\Throwable $exception): void
    {
        if ($exception instanceof LateOutputError) {
            $this->outputLateOutputError($exception);
        }

        while ($exception instanceof UnhandledCallbackExceptionError) {
            // TODO: Don't know why exit is needed to run ajax callbacks... need to dig the code 
            exit;
            $exception = $exception->getPrevious();
        }

        $this->catch_runaway_callbacks = false;

        // just replace layout to avoid any extended App->_construct problems
        // it will maintain everything as in the original app StickyGet, logger, Events
        $this->html = null;
        $this->initLayout([Layout\Centered::class]);

        $this->layout->template->dangerouslySetHtml('Content', $this->renderExceptionHtml($exception));

        // remove header
        $this->layout->template->tryDel('Header');

        if (($this->isJsUrlRequest() || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest')
                && !isset($_GET['__atk_tab'])) {
            $this->outputResponseJson([
                'success' => false,
                'message' => $this->layout->getHtml(),
            ]);
        } else {
            $this->setResponseStatusCode(500);
            $this->run();
        }

        // Process is already in shutdown/stop
        // no need of call exit function
        $this->callBeforeExit();
    }
}