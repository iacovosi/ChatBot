<?php

use App\Http\Controllers\BotManController;
use App\Conversations\CybersafetyConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use App\Conversations;

$botman = resolve('botman');

$botman->hears('exit', function ($bot) {
    $bot->reply('Conversation is over bye bye!');
})->stopsConversation();

$botman->hears('.*', function ($bot) {
    $incoming = ($bot->getMessage()->getText());

    if (soundex($incoming) == soundex('form'))
        $bot->startConversation(new CyberSafetyConversation());
    elseif (soundex($incoming) == soundex('help'))
        $bot->startConversation(new Conversations\CybersafetyConversationHelp());

    elseif($incoming != strtolower('exit'))
        $bot->reply('Sorry, I did not understand these commands. Please retype again...');

});