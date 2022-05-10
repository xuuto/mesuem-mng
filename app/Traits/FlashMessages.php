<?php
namespace App\Traits;

Trait FlashMessages
{
    protected $errorMessages = [];

    protected $infoMessages = [];

    protected $successMessages = [];

    protected $warningMessages = [];


    /**
     * @param $message
     * @param $type
     */
    protected function setFlashMessage($message, $type)
    {
        $model = 'infoMessages';

        switch ($type) {
            case 'info' : {
                $model = 'infoMessages';
            }
                break;
            case 'error' : {
                $model = 'errorMessages';
            }
                break;
            case 'success' : {
                $model = 'successMessages';
            }
                break;
            case 'warning' : {
                $model = 'warningMessages';
            }
                break;
        }

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        } else array_push($this->$model, $message);
    }

    public function getFlashMessages(): array
    {
        return [
            'error' => $this->errorMessages,
            'info' => $this->infoMessages,
            'success' => $this->successMessages,
            'warning' => $this->warningMessages,
        ];
    }

    public function showFlashMessages()
    {
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('success', $this->successMessages);
        session()->flash('warning', $this->warningMessages);
    }
}