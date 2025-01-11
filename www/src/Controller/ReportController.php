<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;

class ReportController extends Controller
{
    public function reportPage()
    {
        parent::view('report', 'Отчеты');
    }

    public function checkPage()
    {
        parent::view('check', 'Проверка диплома');
    }
}
