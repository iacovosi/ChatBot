<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\CybersafetyConversation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param BotMan $bot
     */
    public function startCybersafetyConversation(BotMan $bot)
    {
        $bot->startConversation(new CyberSafetyConversation());
    }

    public function show()
    {

        return view('faq');


    }

}


