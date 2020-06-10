<?php


namespace App\Conversations;


use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use phpDocumentor\Reflection\Element;

class CybersafetyConversationHelp extends Conversation
{


    public function welcome()
    {

        $this->say("Welcome to Cybersafety FAQ. Please select a category");
        //$this->sendEmail();
        $this->AskF();

    }

    public function askF()
    {

        $question = Question::create('Κατηγορίες:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Γενικές Πληροφορίες')->value('general_info'),
                Button::create('Kίνδυνοι και αντιμετώπιση')->value('dansol'),
                Button::create('Kοινωνικά δίκτυα')->value('social_networks'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'general_info')
                    $this->askGeneralInfo();
                elseif ($answer->getValue() == 'dansol')
                    $this->askDangersSolutions();
                elseif ($answer->getValue() == 'social_networks')
                    $this->askSocialNetworks();

            }

        });


//    $this->say("<a href='/faq.html#q90' target=\"_blank\"> Go To answer</a>");

    }


    public function askGeneralInfo()
    {


        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Τι υπηρεσίες παρέχει η Γραμμή Βοήθειας 1480;')->value('hotline'),
                Button::create('Τι υπηρεσίες παρέχει η Γραμμή Καταγγελιών 1480;')->value('helpline'),
                Button::create('Πώς μπορεί να επικοινωνήσει κάποιος/κάποια με τη Γραμμής Βοήθειας 1480;')->value('communicationhot'),
                Button::create('Πώς μπορεί να επικοινωνήσει κάποιος/κάποια με τη Γραμμή Καταγγελιών 1480;')->value('communicationhelp'),
                Button::create('Ποιες είναι οι ώρες λειτουργίας της Γραμμής Βοήθειας 1480')->value('timeline_hotline'),
                Button::create('Ποιες είναι οι ώρες λειτουργίας της Γραμμής Καταγγελιών 1480')->value('timeline_helpline'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'hotline')
                    $this->say("<a href='/faq.html#general_q_1' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'helpline')
                    $this->say("<a href='/faq.html#general_q_2' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'communicationhot')
                    $this->say("<a href='/faq.html#general_q_3' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'communicationhelp')
                    $this->say("<a href='/faq.html#general_q_4' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'timeline_hotline')
                    $this->say("<a href='/faq.html#general_q_5' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'timeline_helpline')
                    $this->say("<a href='/faq.html#general_q_6' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }


    public function askDangersSolutions()
    {


        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Τι θεωρείται παράνομο περιεχόμενο στο Διαδίκτυο;')->value('q1'),
                Button::create('Που μπορώ να βρω περισσότερες πληροφορίες για την Ασφάλεια στο Διαδίκτυο;')->value('q2'),
                Button::create('Πώς να μιλήσω στο παιδί μου για το Διαδίκτυο;')->value('q3'),
                Button::create('Πώς μπορώ να θέσω ρυθμίσεις ασφαλείας στον υπολογιστή μου για την προστασία από κακόβουλο ή ακατάλληλο περιεχόμενο για τα παιδιά;')->value('q4'),
                Button::create('Πώς μπορεί να εκφρασθεί ο Διαδικτυακός Εκφοβισμός;')->value('q5'),
                Button::create('Τι μπορώ να κάνω εάν το παιδί μου έχει πέσει θύμα Διαδικτυακού Εκφοβισμού;')->value('q6'),
                Button::create('Τι μπορώ να κάνω αν έχω πέσει θύμα εκφοβισμού;')->value('q7'),
                Button::create('Που μπορώ να αναφέρω περιστατικά εκφοβισμού στις πλατφόρμες κοινωνικής δικτύωσης;')->value('q8'),
                Button::create('Πότε θα πρέπει να ανησυχήσω για τις ώρες ενασχόλησης του παιδιού μου με το Διαδίκτυο:')->value('q9'),
                Button::create('Πως μπορώ να βοηθήσω το παιδί μου το οποίο απασχολείται πολλές ώρες στο Διαδίκτυο;')->value('q10'),
                Button::create('Περισσοτερες Ερωτήσεις')->value('more'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q1')
                    $this->say("<a href='/faq.html#dangers_q_1' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q2')
                    $this->say("<a href='/faq.html#dangers_q_2' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q3')
                    $this->say("<a href='/faq.html#dangers_q_3' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q4')
                    $this->say("<a href='/faq.html#dangers_q_4' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q5')
                    $this->say("<a href='/faq.html#dangers_q_5' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q6')
                    $this->say("<a href='/faq.html#dangers_q_6' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q7')
                    $this->say("<a href='/faq.html#dangers_q_7' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q8')
                    $this->say("<a href='/faq.html#dangers_q_8' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q9')
                    $this->say("<a href='/faq.html#dangers_q_9' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q10')
                    $this->say("<a href='/faq.html#dangers_q_10' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'more')
                    $this->askMoreDangersSolutions();


            }

        });

    }


    public function askMoreDangersSolutions()
    {


    }


    public function run()
    {
        $this->welcome();

    }


}