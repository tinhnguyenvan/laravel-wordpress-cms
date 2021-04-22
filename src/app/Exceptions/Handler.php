<?php

namespace App\Exceptions;

use App\Services\TelegramService;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(
            function (Throwable $e) {
                //
            }
        );
    }

    /**
     * @param  HttpExceptionInterface  $e
     * @return Response
     */
    public function renderHttpException(HttpExceptionInterface $e): Response
    {
        if (config('telegram.enable') && $e->getStatusCode() == 500) {
            $text[] = '- From: '.config('app.name');
            $text[] = '- Env: '.App::environment();
            $text[] = '- Time: '.date('d/m/Y H:i:s');
            $text[] = '- File: '.$e->getFile();
            $text[] = '- Line: '.$e->getLine();
            $text[] = '- Message: '.$e->getMessage();

            TelegramService::send($text);
        }
        return parent::renderHttpException($e);
    }

    public function renderExceptionContent(Throwable $e): string
    {
        if (config('telegram.enable')) {
            $text[] = '- From: '.config('app.name');
            $text[] = '- Env: '.App::environment();
            $text[] = '- Time: '.date('d/m/Y H:i:s');
            $text[] = '- File: '.$e->getFile();
            $text[] = '- Line: '.$e->getLine();
            $text[] = '- Message: '.$e->getMessage();

            TelegramService::send($text);
        }

        return parent::renderExceptionContent($e);
    }
}
