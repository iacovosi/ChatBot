<?php


namespace App\Conversations;


use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
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
        {


            $question = Question::create('Ερωτήσεις:')
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([
                    Button::create('Ασφαλεια στο διαδίκτυο')->value('security'),
                    Button::create('Διαδικτυακός Εκφοβισμός')->value('bullying'),
                    Button::create('Ενασχόληση στο διαδίκτυο')->value('online'),
                    Button::create('Διαδικτυακή αποπλάνηση')->value('grooming'),
                    Button::create('Παιδική Σεξουαλική Κακοποίηση και Παρενόχληση Παιδιών')->value('sexual_har'),
                    Button::create('Σεξουαλικός Εκβιασμός')->value('sexual_ext'),
                    Button::create('Sexting')->value('sexting'),
                    Button::create('Ηλεκτρονικά Παιχνίδια')->value('gaming'),
                    Button::create('Παραπληροφόρηση')->value('misinformation'),
                ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {

                    if ($answer->getValue() == 'security')
                        $this->askSecurity();
                    elseif ($answer->getValue() == 'bullying')
                        $this->askBullying();
                    elseif ($answer->getValue() == 'online')
                        $this->askOnline();
                    elseif ($answer->getValue() == 'grooming')
                        $this->askGrooming();
                    elseif ($answer->getValue() == 'sexual_har')
                        $this->askSexualHar();
                    elseif ($answer->getValue() == 'sexual_ext')
                        $this->askSexualExt();
                    elseif ($answer->getValue() == 'sexting')
                        $this->askSexting();
                    elseif ($answer->getValue() == 'gaming')
                        $this->askGaming();
                    elseif ($answer->getValue() == 'misinformation')
                        $this->askMisinformation();
                    elseif ($answer->getValue() == 'privacy')
                        $this->askPrivacy();
                    elseif ($answer->getValue() == 'harmful')
                        $this->askPrivacy();
                    elseif ($answer->getValue() == 'phishing')
                        $this->askPrivacy();
                }

            });

        }


    }


    public function askSecurity()
    {


        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Τι θεωρείται παράνομο περιεχόμενο στο Διαδίκτυο;')->value('q1'),
                Button::create('Που μπορώ να βρω περισσότερες πληροφορίες για την Ασφάλεια στο Διαδίκτυο;')->value('q2'),
                Button::create('Πώς να μιλήσω στο παιδί μου για το Διαδίκτυο;')->value('q3'),
                Button::create('Πώς μπορώ να θέσω ρυθμίσεις ασφαλείας στον υπολογιστή μου για την προστασία από κακόβουλο ή ακατάλληλο περιεχόμενο για τα παιδιά;')->value('q4'),

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
            }

        });


    }

    public function askBullying()
    {


        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι είναι ο Διαδικτυακός Εκφοβισμός;')->value('q5'),
                Button::create('Πώς μπορεί να εκφρασθεί ο Διαδικτυακός Εκφοβισμός;')->value('q6'),
                Button::create('Τι μπορώ να κάνω εάν το παιδί μου έχει πέσει θύμα Διαδικτυακού Εκφοβισμού;')->value('q7'),
                Button::create('Τι μπορώ να κάνω αν έχω πέσει θύμα εκφοβισμού;')->value('q8'),
                Button::create('Που μπορώ να αναφέρω περιστατικά εκφοβισμού στις πλατφόρμες κοινωνικής δικτύωσης;')->value('q9'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {


                if ($answer->getValue() == 'q5')
                    $this->say("<a href='/faq.html#dangers_q_5' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q6')
                    $this->say("<a href='/faq.html#dangers_q_6' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q7')
                    $this->say("<a href='/faq.html#dangers_q_7' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q8')
                    $this->say("<a href='/faq.html#dangers_q_8' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q9')
                    $this->say("<a href='/faq.html#dangers_q_9' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });


    }

    public function askOnline()
    {

        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Πότε θα πρέπει να ανησυχήσω για τις ώρες ενασχόλησης του παιδιού μου με το Διαδίκτυο:')->value('q10'),
                Button::create('Πως μπορώ να βοηθήσω το παιδί μου το οποίο απασχολείται πολλές ώρες στο Διαδίκτυο;')->value('q11'),
                Button::create('Τι μπορώ να κάνω για να περιορίσω την πολύωρη ενασχόλησή μου με το Διαδίκτυο;')->value('q12'),

            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {


                if ($answer->getValue() == 'q10')
                    $this->say("<a href='/faq.html#dangers_q_10' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q11')
                    $this->say("<a href='/faq.html#dangers_q_11' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q12')
                    $this->say("<a href='/faq.html#dangers_q_12' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });


    }

    public function askGrooming()
    {

        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι είναι η διαδικτυακή αποπλάνηση (Grooming);')->value('q13'),
                Button::create('Πως μπορώ να ενημερώσω το παιδί μου για τον κίνδυνο της διαδικτυακής αποπλάνησης (Grooming);')->value('q14'),
                Button::create('Τι θα πρέπει να γνωρίζω για την αντιμετώπιση του κινδύνου της διαδικτυακής αποπλάνησης (Grooming);')->value('q15')

            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q13')
                    $this->say("<a href='/faq.html#dangers_q_13' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q14')
                    $this->say("<a href='/faq.html#dangers_q_14' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q15')
                    $this->say("<a href='/faq.html#dangers_q_15' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });


    }

    public function askSexualHar()
    {

        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι αφορά η Παιδική Σεξουαλική Κακοποίηση και Παρενόχληση Παιδιών;')->value('q16'),
                Button::create('Τι μπορώ να κάνω σε περίπτωση που εντοπίσω περιεχόμενο Παιδικής Σεξουαλικής Κακοποίησης και Παρενόχληση Παιδιών;')->value('q17'),
                Button::create('Τι μπορώ να κάνω σε περίπτωση που είμαι θύμα Παιδικής Σεξουαλικής Κακοποίησης και Παρενόχλησης;')->value('q18'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q16')
                    $this->say("<a href='/faq.html#dangers_q_16' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q17')
                    $this->say("<a href='/faq.html#dangers_q_17' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q18')
                    $this->say("<a href='/faq.html#dangers_q_18' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });


    }

    public function askSexualExt()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι είναι ο σεξουαλικός εκβιασμός (Sextortion);')->value('q19'),
                Button::create('Τι κάνω σε περίπτωση που το παιδί μου είναι θύμα σεξουαλικού εκβιασμού (Sextortion);')->value('q20'),
                Button::create('Τι κάνω σε περίπτωση που είμαι θύμα σεξουαλικού εκβιασμού (Sextortion);')->value('q21'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q19')
                    $this->say("<a href='/faq.html#dangers_q_19' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q20')
                    $this->say("<a href='/faq.html#dangers_q_20' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q21')
                    $this->say("<a href='/faq.html#dangers_q_21' target=\"_blank\"> Δες την απάντηση</a>");

            }

        });

    }

    public function askSexting()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι είναι το Sexting;')->value('q22'),
                Button::create('Πιθανοί κίνδυνοι του Sexting:')->value('q23'),
                Button::create('Μπορώ να έχω συνέπειες εάν κοινοποιήσω ή μοιραστώ με τρίτους μηνύματα, φωτογραφίες ή βίντεο σεξουαλικού περιεχομένου;')->value('q24'),
                Button::create('Τι κάνω σε περίπτωση που εντοπίσω ότι κάποιος έχει κοινοποιήσει ή διαμοιραστεί με τρίτους μηνύματα, φωτογραφίες ή βίντεο σεξουαλικού περιεχομένου;')->value('q25'),
                Button::create('Πώς να μιλήσω στο παιδί μου για το Sexting;')->value('q26'),
                Button::create('Τι κάνω σε περίπτωση που το παιδί μου έχει πέσει θύμα Sexting;')->value('q27'),

            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q22')
                    $this->say("<a href='/faq.html#dangers_q_22' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q23')
                    $this->say("<a href='/faq.html#dangers_q_23' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q24')
                    $this->say("<a href='/faq.html#dangers_q_24' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q25')
                    $this->say("<a href='/faq.html#dangers_q_25' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q26')
                    $this->say("<a href='/faq.html#dangers_q_26' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q27')
                    $this->say("<a href='/faq.html#dangers_q_27' target=\"_blank\"> Δες την απάντηση</a>");

            }

        });

    }


    public function askGaming()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Υπάρχουν κίνδυνοι κατά την ενασχόληση των παιδιών με τα διαδικτυακά παιχνίδια;')->value('q28'),
                Button::create('Τι είναι τα εργαλεία γονικού ελέγχου;')->value('q29'),
                Button::create('Τι είναι το Πανευρωπαϊκό Σύστημα Πληροφόρησης PEGI (Pan-European Game Information);')->value('q30'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q28')
                    $this->say("<a href='/faq.html#dangers_q_22' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q29')
                    $this->say("<a href='/faq.html#dangers_q_23' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q30')
                    $this->say("<a href='/faq.html#dangers_q_24' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }

    public function askMisinformation()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Πώς μπορώ να εντοπίσω πληροφορίες / περιεχόμενο στο Διαδίκτυο;')->value('q31'),
                Button::create('Τι είναι παραπληροφόρηση;')->value('q32'),
                Button::create('Τι είναι οι Ψευδείς ειδήσεις (fake news);')->value('q33'),
                Button::create('Πώς θα καταλάβω αν αυτό που διαβάζω είναι αξιόπιστο;')->value('q34'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q31')
                    $this->say("<a href='/faq.html#dangers_q_31' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q32')
                    $this->say("<a href='/faq.html#dangers_q_32' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q33')
                    $this->say("<a href='/faq.html#dangers_q_33' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q34')
                    $this->say("<a href='/faq.html#dangers_q_34' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }

    public function askPrivacy()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([


                Button::create('Τι είναι δεδομένα προσωπικού χαρακτήρα;')->value('q36'),
                Button::create('Πώς αποκαλύπτουμε προσωπικά δεδομένα στο Διαδίκτυο;')->value('q37'),
                Button::create('Πως προστατεύω τα Προσωπικά μου Δεδομένα;')->value('q38'),
                Button::create('Κωδικοί Πρόσβασης')->value('q39'),
                Button::create('Κοινωνικά Δίκτυα και ευρωπαϊκός κανονισμός περί Προστασίας Προσωπικών Δεδομένων (GDPR);')->value('q40'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q36')
                    $this->say("<a href='/faq.html#dangers_q_36' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q37')
                    $this->say("<a href='/faq.html#dangers_q_37' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q38')
                    $this->say("<a href='/faq.html#dangers_q_38' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q39')
                    $this->say("<a href='/faq.html#dangers_q_39' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q40')
                    $this->say("<a href='/faq.html#dangers_q_40' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }

    public function askHarmful()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι είναι ακατάλληλο και επιβλαβές περιεχόμενο;')->value('q41'),
                Button::create('Πως μπορώ να προστατεύω το παιδί μου από ακατάλληλο και επιβλαβές περιεχόμενο;')->value('q42'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q41')
                    $this->say("<a href='/faq.html#dangers_q_41' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q42')
                    $this->say("<a href='/faq.html#dangers_q_42' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }

    public function askPhishing()
    {
        $question = Question::create('Ερωτήσεις:')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([

                Button::create('Τι σημαίνει Υποκλοπή Προσωπικών Δεδομένων (Phishing)')->value('q43'),
                Button::create('Τι θα πρέπει να αποφύγω για να μην πέσω θύμα Υποκλοπής Προσωπικών Δεδομένων (Phishing)')->value('q44'),


            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                if ($answer->getValue() == 'q43')
                    $this->say("<a href='/faq.html#dangers_q_43' target=\"_blank\"> Δες την απάντηση</a>");
                elseif ($answer->getValue() == 'q44')
                    $this->say("<a href='/faq.html#dangers_q_44' target=\"_blank\"> Δες την απάντηση</a>");


            }

        });

    }


    public function askSocialNetworks()
    {
        {


            $question = Question::create('Ερωτήσεις:')
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([
                    Button::create('Facebook')->value('facebook'),
                    Button::create('Instagram')->value('instagram'),
                    Button::create('Tik Tok')->value('tiktok'),

                ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {

                    if ($answer->getValue() == 'facebook')
                        $this->askFacebook();
                    elseif ($answer->getValue() == 'instagram')
                        $this->askInstagram();
                    elseif ($answer->getValue() == 'tiktok')
                        $this->askTikTok();

                }

            });

        }


    }


    public function askFacebook()
    {
        {
            $question = Question::create('Ερωτήσεις:')
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([

                    Button::create('Πώς μπορώ να δημιουργήσω λογαριασμό στο Facebook;')->value('q1'),
                    Button::create('Πού μπορώ να βρω τις ρυθμίσεις μου στο Facebook;')->value('q2'),
                    Button::create('Πώς μπορώ να αλλάξω ή να επαναφέρω τον κωδικό πρόσβασής μου στο Facebook;')->value('q3'),
                    Button::create('Πώς μπορώ να απενεργοποιήσω προσωρινά το λογαριασμό μου στο Facebook;')->value('q4'),
                    Button::create('Πώς μπορώ να διαγράψω οριστικά το λογαριασμό μου στο Facebook;')->value('q5'),
                    Button::create('Δεν μπορώ να συνδεθώ στο Facebook.')->value('q6'),
                    Button::create('Νομίζω ότι ο λογαριασμός μου στο Facebook έχει παραβιαστεί ή χρησιμοποιείται από κάποιον άλλο χωρίς την άδειά μου.')->value('q7'),
                    Button::create('Τι μπορώ να κάνω για να διατηρήσω ασφαλή το λογαριασμό μου στο Facebook;')->value('q8'),
                    Button::create('Πώς μπορώ να ρυθμίσω ποιοι θα βλέπουν το περιεχόμενο του προφίλ και του χρονολογίου μου στο Facebook;')->value('q9'),
                    Button::create('Πώς μπορώ να λαμβάνω ειδοποιήσεις για μη αναγνωρισμένες συνδέσεις στο Facebook;')->value('q10'),
                    Button::create('Τι είναι ο έλεγχος ταυτότητας δύο παραγόντων και πώς λειτουργεί στο Facebook;')->value('q11'),
                    Button::create('Τι μπορώ να κάνω σε περίπτωση που έχω πέσει θύμα ηλεκτρονικού ψαρέματος στο Facebook;')->value('q12'),
                    Button::create('Έλαβα ένα ύποπτο email ή μήνυμα που φαίνεται ότι προέρχεται από το Facebook.')->value('q13'),
                    Button::create('Τι είναι το μπλοκάρισμα στο Facebook και πώς μπορώ να μπλοκάρω κάποιον;')->value('q14'),
                    Button::create('Τι πρέπει να κάνω αν κάποιος με προκαλεί στο Facebook να κάνω κάτι για το οποίο δεν αισθάνομαι άνετα;')->value('q15'),
                    Button::create('Τι πρέπει να κάνω αν κάποιος απειλεί να κοινοποιήσει κάτι που το παιδί μου θέλει να κρατήσει εμπιστευτικό (π.χ. μηνύματα, φωτογραφίες ή βίντεο) στο Facebook;')->value('q16'),
                    Button::create('Πώς μπορώ να αναφέρω ακατάλληλο ή προσβλητικό περιεχόμενο στο Facebook (π.χ. γυμνό, εκφράσεις μίσους, απειλές);')->value('q17'),
                    Button::create('Τι μπορώ να κάνω αν κάποιος με εκφοβίζει, με παρενοχλεί ή μου επιτίθεται στο Facebook;')->value('q18'),
                    Button::create('Τι πρέπει να κάνω αν δω στο Facebook εικόνες σωματικής κακοποίησης ή σεξουαλικής εκμετάλλευσης ενός παιδιού;')->value('q19'),
                    Button::create('Πώς μπορώ να αναφέρω ένα λογαριασμό ή μια Σελίδα στο Facebook που παριστάνει ότι είμαι εγώ ή κάποιος άλλος;')->value('q20'),
                    Button::create('Φόρμα αναφοράς εκβιασμού, προσωπικών εικόνων ή απειλών κοινοποίησης προσωπικών εικόνων (sextortion) στο Facebook')->value('q21'),
                    Button::create('Φόρμα αναφοράς παραπλανητικού λογαριασμού στο Facebook')->value('q22'),
                    Button::create('Φόρμα αναφοράς παραβίασης απορρήτου (φωτογραφία, βίντεο κ.λπ.) στο Facebook')->value('q23'),
                    Button::create('Φόρμα αιτήματος για λογαριασμό εις μνήμην στο Facebook')->value('q24'),
                    Button::create('Φόρμα αναφοράς χρεώσεων στον διαφημιστικό λογαριασμό σας στο Facebook')->value('q25'),
                    Button::create('Φόρμα αναφοράς παιδιού κάτω του ορίου ηλικίας στο Facebook')->value('q26'),



                ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {

                    if ($answer->getValue() == 'q1')
                        $this->say("<a href='/faq.html#social_q1' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q2')
                        $this->say("<a href='/faq.html#social_q2' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q3')
                        $this->say("<a href='/faq.html#social_q3' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q4')
                        $this->say("<a href='/faq.html#social_q4' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q5')
                        $this->say("<a href='/faq.html#social_q5' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q6')
                        $this->say("<a href='/faq.html#social_q6' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q7')
                        $this->say("<a href='/faq.html#social_q7' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q8')
                        $this->say("<a href='/faq.html#social_q8' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q9')
                        $this->say("<a href='/faq.html#social_q9' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q10')
                        $this->say("<a href='/faq.html#social_q10' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q11')
                        $this->say("<a href='/faq.html#social_q11' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q12')
                        $this->say("<a href='/faq.html#social_q12' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q13')
                        $this->say("<a href='/faq.html#social_q13' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q14')
                        $this->say("<a href='/faq.html#social_q14' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q15')
                        $this->say("<a href='/faq.html#social_q15' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q16')
                        $this->say("<a href='/faq.html#social_q16' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q17')
                        $this->say("<a href='/faq.html#social_q17' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q18')
                        $this->say("<a href='/faq.html#social_q18' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q19')
                        $this->say("<a href='/faq.html#social_q19' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q20')
                        $this->say("<a href='/faq.html#social_q20' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q21')
                        $this->say("<a href='/faq.html#social_q21' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q22')
                        $this->say("<a href='/faq.html#social_q22' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q23')
                        $this->say("<a href='/faq.html#social_q23' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q24')
                        $this->say("<a href='/faq.html#social_q24' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q25')
                        $this->say("<a href='/faq.html#social_q25' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q26')
                        $this->say("<a href='/faq.html#social_q26' target=\"_blank\"> Δες την απάντηση</a>");



                }

            });

        }




    }

    public function askInstagram()

    {
        {
            $question = Question::create('Ερωτήσεις:')
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([

                    Button::create('Δημιουργία λογαριασμού και ονόματος χρήστη στο Instagram')->value('q27'),
                    Button::create('Πως μπορώ να διαγράψω ή να απενεργοποιήσω οριστικά τον λογαριασμό μου')->value('q28'),
                    Button::create('Ρυθμίσεις απορρήτου και πληροφορίες στο Instagram')->value('q29'),
                    Button::create('Πώς μπορώ να μπλοκάρω ή να ξεμπλοκάρω κάποιον στο Instagram')->value('q30'),
                    Button::create('Πώς μπορώ εγώ ή το παιδί μου να αναφέρουμε ενοχλητική συμπεριφορά ή ακατάλληλο/προσβλητικό περιεχόμενο στο Instagram;')->value('q31'),
                    Button::create('Φόρμα αναφοράς λογαριασμού πλαστοπροσωπίας στο Instagram')->value('q32'),
                    Button::create('Φόρμα αναφοράς παρενόχλησης ή bullying στο Instagram')->value('q33'),
                    Button::create('Φόρμα αναφοράς φωτογραφιών και βίντεο που παραβιάζουν το απόρρητό σας στο Instagram')->value('q34'),
                    Button::create('Φόρμα αναφοράς χρήστη κάτω του ορίου ηλικίας στο Instagram')->value('q35'),
                    Button::create('Φόρμα αναφοράς ότι διεύθυνση email μου χρησιμοποιείται ήδη στο Instagram')->value('q36'),
                    Button::create('Φόρμα αναφοράς λογαριασμού θανόντος για μετατροπή σε "εις μνήμην" στο Instagram')->value('q37'),



                ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {

                    if ($answer->getValue() == 'q27')
                        $this->say("<a href='/faq.html#social_q27' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q28')
                        $this->say("<a href='/faq.html#social_q28' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q29')
                        $this->say("<a href='/faq.html#social_q29' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q30')
                        $this->say("<a href='/faq.html#social_q30' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q31')
                        $this->say("<a href='/faq.html#social_q31' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q32')
                        $this->say("<a href='/faq.html#social_q32' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q33')
                        $this->say("<a href='/faq.html#social_q33' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q34')
                        $this->say("<a href='/faq.html#social_q34' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q35')
                        $this->say("<a href='/faq.html#social_q35' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q36')
                        $this->say("<a href='/faq.html#social_q36' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q37')
                        $this->say("<a href='/faq.html#social_q37' target=\"_blank\"> Δες την απάντηση</a>");






                }

            });

        }




    }

    public function askTikTok()


    {
        {
            $question = Question::create('Ερωτήσεις:')
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([

                    Button::create('Δημιουργία  λογαριασμού στο Tik Tok')->value('q38'),
                    Button::create('Διαγραφή λογαριασμού στο Tik Tok')->value('q39'),
                    Button::create('Αλλαγή κωδικού στο Tik Tok')->value('q40'),
                    Button::create('Ρυθμίσεις απορρήτου στο Tik Tok')->value('q41'),
                    Button::create('Όρισε τον λογαριασμό σου ιδιωτικό στο Tik Tok')->value('q42'),
                    Button::create('Μπλοκάρισμα λογαριασμού στο Tik Tok')->value('q43'),
                    Button::create('Αναφορά λογαριασμού χρήστη κάτω του ορίου ηλικίας στο Tik Tok')->value('q44'),
                    Button::create('Αναφορά ακατάλληλου περιεχομένου στο Tik Tok')->value('q45'),




                ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {

                    if ($answer->getValue() == 'q38')
                        $this->say("<a href='/faq.html#social_q38' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q39')
                        $this->say("<a href='/faq.html#social_q39' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q40')
                        $this->say("<a href='/faq.html#social_q40' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q41')
                        $this->say("<a href='/faq.html#social_q41' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q42')
                        $this->say("<a href='/faq.html#social_q42' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q43')
                        $this->say("<a href='/faq.html#social_q43' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q44')
                        $this->say("<a href='/faq.html#social_q44' target=\"_blank\"> Δες την απάντηση</a>");
                    elseif ($answer->getValue() == 'q45')
                        $this->say("<a href='/faq.html#social_q45' target=\"_blank\"> Δες την απάντηση</a>");






                }

            });

        }




    }

    public function run()
    {
        $this->welcome();

    }


}