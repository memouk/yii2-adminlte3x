<?php
namespace hail812\adminlte3\widgets;

use yii\base\ErrorException;
use yii\bootstrap4\Widget;

class Alert extends Widget
{
    public $alertTypes = [
        'danger' => [
            'class' => 'alert-danger',
            'icon' => 'fa-ban'
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => 'fa-info'
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => 'fa-exclamation-triangle'
        ],
        'success' => [
            'class' => 'alert-success',
            'icon' => 'fa-check'
        ],
        'light' => [
            'class' => 'alert-light',
        ],
        'dark' => [
            'class' => 'alert-dark'
        ]
    ];

    public $type;

    public $title = 'Alert';

    public $icon;

    /**
     * @var string the body content in the alert component.
     */
    public $body;

    /**
     * @var bool whether or not the body has the head
     */
    public $simple = false;

    /**
     * @var array|false the options for rendering the close button tag.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     */
    public $closeButton = [];

     public function init()
    {
        parent::init();

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $message) {

                    $this->options['class'] = $this->alertTypes[$type]['class'] . $appendCss;
                    $this->options['id'] = $this->getId() . '-' . $type;

                    echo \yii\bootstrap4\Alert::widget([
                        'body' => '<i class="icon fas '.$this->alertTypes[$type]['icon'].'"></i>'. $message,
                        'closeButton' => $this->closeButton,
                        'options' => $this->options,
                    ]);

                }
//                if ($this->isAjaxRemoveFlash && !\Yii::$app->request->isAjax) {
//                    $session->removeFlash($type);
//                }
            }
        }
        
    }

   
}