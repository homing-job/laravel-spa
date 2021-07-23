<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use \Illuminate\Contracts\View\View as View;

class WebController extends Controller
{
    /**
     * トップ画面
     *
     * @return View
     */
    public function index(): View
    {
        return view('front');
    }

    /**
     * ログイン画面
     *
     * @return View
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * 管理画面
     *
     * @return View
     */
    public function admin(): View
    {
        return view('admin');
    }
}