<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FlashMessages;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use FlashMessages;
    protected $data = null;

    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error'         =>  $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          =>  $data
        ]);
    }

    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false): \Illuminate\Http\RedirectResponse
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param  string  $type
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message, $type = 'info'): \Illuminate\Http\RedirectResponse
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }
}
