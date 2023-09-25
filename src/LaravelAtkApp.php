<?php

namespace Gowrav\LaravelAtkIntegrate;


class LaravelAtkApp extends \Atk4\Ui\App {
    protected string $urlBuildingExt = '';

    /** @var array|false Location where to load JS/CSS files */
    public $cdn = [
        'atk' => 'atk',
        'jquery' => 'atk/external/jquery/dist',
        'fomantic-ui' => 'atk/external/fomantic-ui/dist',
        'flatpickr' => 'atk/external/flatpickr/dist',
        'highlight.js' => 'atk/external/@highlightjs/cdn-assets',
        'chart.js' => 'atk/external/chart.js/dist', // for atk4/chart
    ];
    
    public function initIncludes(): void {
        $this->html->js(true,new \Atk4\Ui\Js\JsExpression(
            '$.ajaxSetup({
                headers: {
                    \'X-CSRF-TOKEN\': \'' . csrf_token() . '\'
                }
            });'
        ));

        parent::initIncludes();
	}
}