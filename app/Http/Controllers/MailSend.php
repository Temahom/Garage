<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;
class MailSend extends Controller
{
    public function mailsend()
    {
        $details = [
            'title' => 'Renumération plus les jours fériés',
            "body" => "Bonjour chers Développeurs de Mediapex \n Nous avons le plaisir de vous annoncer le verssement de votre prime qui sera disponible le Vendredi 26 de ce mois .<br> Veillez agréer cher tous l\'expression de nos salutations distinguées ."
        ];
        \Mail::to('medoune.sene@mediapex.pro')->send(new SendMail($details));
        \Mail::to('moustapha.gueye@mediapex.pro')->send(new SendMail($details));
        \Mail::to('aziz.fall@mediapex.pro')->send(new SendMail($details));
        \Mail::to('moussa.thiam@mediapex.pro')->send(new SendMail($details));
        \Mail::to('fatoubibi96@gmail.com')->send(new SendMail($details));
        \Mail::to('hildedokou@gmail.com')->send(new SendMail($details));
        \Mail::to('diattamohamet30@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}