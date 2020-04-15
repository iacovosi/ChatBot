<?php


namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

#use App\Mail\TestMail;
#use Illuminate\Support\Facades\Mail;
use App\utilities\Application;
use App\utilities\PersonalDetails;
use App\Report;
use App;

use Mail;

class CybersafetyConversation extends Conversation
{

    public $app;
    public $pd;
    public $locale;


    public function welcome()
    {

        $this->AskLocale();
        //$this->sendEmail();


    }

    public function AskLocale()
    {
        $question = Question::create("Language / Γλώσσα ?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('English/Αγγλικά')->value('en'),
                Button::create('Greek/Ελληνικα')->value('gr'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
//                $this->where = $answer->getValue();
                $this->locale = $answer->getValue();
                App::setLocale($this->locale);
                $this->say(__('lang.choose'));

            } else {
//                App::setLocale("en");
                $this->say(__('lang.choose'));
            }


            $this->askCategory();

        });


    }


    public function askCategory()
    {
        $this->app = new Application();
        App::setLocale($this->locale);
//        $this->AskLocale();
//        $this->say('Hello, Welcome to Cybersafety website');
        $question = Question::create("" . trans('lang.hothelp'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_what')
            ->addButtons([
                Button::create("" . trans('lang.hotline'))->value('hotline'),
                Button::create("" . trans('lang.helpline'))->value('helpline'),

            ]);
        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->app->setCategory($answer->getValue());
//                error_log($this->app->getCategory());

                $this->askWhere();
            } else {

                $this->say("" . trans('lang.mandatory_selection'));
                $this->askCategory();
            }
        });

    }


    public function askWhere()
    {
        App::setLocale($this->locale);
        $question = Question::create(__('lang.where'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create("" . trans('lang.website'))->value('website'),
                Button::create("" . trans('lang.chat_room'))->value('chat_room'),
                Button::create("" . trans('lang.mobile_communication'))->value('mobile_communication'),
                Button::create("" . trans('lang.social_media'))->value('social_media'),
                Button::create("" . trans('lang.email'))->value('email'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
//                $this->where = $answer->getValue();
                $this->app->setWhere($answer->getValue());


                if ($answer->getValue() == 'website' || $answer->getValue() == 'chat_room' || $answer->getValue() == 'social_media')
                    $this->askUrl();

                elseif ($answer->getValue() == 'email') {
                    $this->askWhereEmail();
                } else {

                    if ($this->app->getCategory() == 'hotline')
                        $this->askTypeHotline();
                    else {
                        $this->askTypeHelpline();
                    }
                }

            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askWhere();
            }

        });
    }


    public function askWhereEmail()
    {
        App::setLocale($this->locale);

        $question = Question::create("" . trans('lang.email2'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_email');

        $this->ask($question, function (Answer $answer) {

            if (filter_var($answer->getValue(), FILTER_VALIDATE_EMAIL)) {
                $this->app->setURL($answer->getValue());

                if ($this->app->getCategory() == 'hotline')
                    $this->askTypeHotline();
                else
                    $this->askTypeHelpline();
            } else {
                $this->say("" . trans('lang.invalid_email'));
                $this->askWhereEmail();
            }


        });
    }

    public function askUrl()
    {


        App::setLocale($this->locale);
        $question = Question::create(__('lang.url'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_url');

        $this->ask($question, function (Answer $answer) {
//            $this->type = $answer->getValue();


            if (filter_var($answer->getValue(), FILTER_VALIDATE_URL)) {
                $this->app->setURL($answer->getValue());
                if ($this->app->getCategory() == 'hotline')
                    $this->askTypeHotline();
                else
                    $this->askTypeHelpline();
            } else {
                $this->say("" . trans('lang.invalid_url'));
                $this->askUrl();
            }


        });


    }


    public function askTypeHotline()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.ask_type'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_type')
            ->addButtons([
                Button::create("" . trans('lang.child_pornography'))->value('child_pornography'),
                Button::create("" . trans('lang.hijacking'))->value('hijacking'),
                Button::create("" . trans('lang.network_hijacking'))->value('network_hijacking'),
                Button::create("" . trans('lang.cyber_fraud'))->value('cyber_fraud'),
                Button::create("" . trans('lang.hate_speech'))->value('hate_speech'),
                Button::create("" . trans('lang.other'))->value('other')
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->type = $answer->getValue();
                $this->app->setType($answer->getValue());

                $this->askDescribe();
            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askTypeHotline();
            }

        });
    }

    public function askTypeHelpline()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.ask_type'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_type')
            ->addButtons([
                Button::create("" . trans('lang.cyberbullying'))->value('cyberbullying'),
                Button::create("" . trans('lang.excessive_use'))->value('excessive_use'),
                Button::create("" . trans('lang.love'))->value('love_relationships_sexuality'),
                Button::create("" . trans('lang.sexting'))->value('sexting'),
                Button::create("" . trans('lang.sextortion'))->value('sextortion'),
                Button::create("" . trans('lang.sexual_harassment'))->value('sexual harassment'),
                Button::create("" . trans('lang.grooming'))->value('Grooming'),
                Button::create("" . trans('lang.ecrime'))->value('E-crime'),
                Button::create("" . trans('lang.hate_speech'))->value('hate_speech'),
                Button::create("" . trans('lang.harmfull_content'))->value('potentially_harmful_content'),
                Button::create("" . trans('lang.gaming'))->value('Gaming'),
                Button::create("" . trans('lang.online_reputation'))->value('Online reputation'),
                Button::create("" . trans('lang.technical_settings'))->value('technical_settings'),
                Button::create("" . trans('lang.advertising'))->value('advertising_commercialism'),
                Button::create("" . trans('lang.media'))->value('media_literacy_education'),
                Button::create("" . trans('lang.privacy'))->value('data_privacy')

            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
//                $this->type = $answer->getValue();
                $this->app->setType($answer->getValue());

                $this->askDescribe();
            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askTypeHelpline();
            }

        });


    }

    public function askDescribe()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.describe_incident'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_describe');

        $this->ask($question, function (Answer $answer) {
//            $this->type = $answer->getValue();
            $this->app->setDescription($answer->getValue());
            $this->askPersonalData();
        });

    }

    public function askPersonalData()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.one_of_two'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_personal_data')
            ->addButtons([
                Button::create("" . trans('lang.anonymous'))->value('anonymous'),
                Button::create("" . trans('lang.submit'))->value('submit_personal_details'),
            ]);


        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
//                $this->personal_data = $answer->getValue();
                $this->app->setPersonalData($answer->getValue());

                if ($this->app->getPersonalData() == 'anonymous') {
                    $this->say("" . trans('lang.thanks'));
                    $this->storeToDB();
                    $this->sendEmail();
                } else {
                    $this->pd = new PersonalDetails();
                    $this->askName();
                }
            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askWhere();
            }
        });

    }

    public function askName()
    {
        App::setLocale($this->locale);

        $question = Question::create("" . trans('lang.name'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_name');

        $this->ask($question, function (Answer $answer) {
            $this->pd->setName($answer->getValue());
            $this->askSurname();
        });
    }


    public function askSurname()
    {
        App::setLocale($this->locale);

        $question = Question::create("" . trans('lang.surname'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_surname');

        $this->ask($question, function (Answer $answer) {
            $this->pd->setSurname($answer->getValue());
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        App::setLocale($this->locale);

        $question = Question::create("" . trans('lang.email2'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_email');

        $this->ask($question, function (Answer $answer) {

            if (filter_var($answer->getValue(), FILTER_VALIDATE_EMAIL)) {
                $this->pd->setEmail($answer->getValue());
                $this->askPhone();
            } else {
                $this->say("" . trans('lang.invalid_email'));
                $this->askEmail();
            }


        });
    }

    public function askPhone()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.phone'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_phone');

        $this->ask($question, function (Answer $answer) {

            if (filter_var($answer->getValue(), FILTER_VALIDATE_INT)) {
                $this->pd->setPhone($answer->getValue());
                $this->askAge();
            } else {
                $this->say("" . trans('lang.invalid_phone'));
                $this->askPhone();
            }


        });
    }

    public function askAge()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.age'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_age')
            ->addButtons([
                Button::create('5-11 years')->value('five_to_eleven'),
                Button::create('12-18 years')->value('twelve_to_eighteen'),
                Button::create('18+ years')->value('eighteen_plus'),

            ]);
        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->pd->setAge($answer->getValue());
                $this->askGender();
            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askAge();
            }


        });

    }

    public function askGender()
    {
        App::setLocale($this->locale);
        $question = Question::create("" . trans('lang.gender'))
            ->fallback('Unable to ask question')
            ->callbackId('ask_gender')
            ->addButtons([
                Button::create('Male')->value('male'),
                Button::create('Female')->value('female'),

            ]);
        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->pd->setGender($answer->getValue());

                $this->app->setPersonalDetails($this->pd);
                $this->say("" . trans('lang.thanks'));

                $this->storeToDB();
                $this->sendEmail();

            } else {

                $this->say("" . trans('lang.mandatory'));
                $this->askGender();
            }


        });

    }


    public function sendEmail()
    {

        $to_name = 'CyberSafe Team';
        $to_email = 'andreas.charalampous.cy@gmail.com';
//        $data = array("name" => "CyberSafe Chatbot Receiver of CyberSafe Team", 'results' => $this->app->returnResultOfChatBot(),'personal_information'=>$this->pd->getPersonalDetails(),"body"=>"With Regards CyberSafe ChatBot");
        if (isset($this->pd) && !empty($this->pd)) {
            $data = array("name" => "CyberSafe Chatbot Reciever of CyberSafe Team", 'results' => $this->app->returnResultOfChatBot(), 'personal_information' => $this->pd->getPersonalDetails(), "body" => "With Regards CyberSafe ChatBot");
        } else {
            $data = array("name" => "CyberSafe Chatbot Reciever of CyberSafe Team", 'results' => $this->app->returnResultOfChatBot(), 'personal_information' => "Not Given", "body" => "With Regards CyberSafe ChatBot");

        }
        Mail::send('emails.emailnotify', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('CyberSafe Chatbot Result for Report');
            $message->from('cybersafe.chatbot@gmail.com', 'CyberSafe Chatbot Mail');
        });


    }


    public function storeToDB()
    {
        $data = Array();
        $data['category'] = $this->app->getCategory();
        $data['where'] = $this->app->getWhere();
        $data['url'] = $this->app->getUrl();            //add the URL to migration
        $data['type'] = $this->app->getType();
        $data['description'] = $this->app->getDescription();
        if (isset($this->pd) && !empty($this->pd)) {
            $data['personal_data'] = $this->app->getPersonalData();
            $data['personal_details'] = $this->app->getPersonalDetails()->getPersonalDetails();
            $data['name'] = $this->pd->getName();
            $data['surname'] = $this->pd->getSurname();
            $data['email'] = $this->pd->getEmail();
            $data['phone'] = $this->pd->getPhone();
            $data['age'] = $this->pd->getAge();
            $data['gender'] = $this->pd->getGender();
        }
        $id = Report::create($data)->id;


    }


    public function run()
    {
        $this->welcome();

    }


}
