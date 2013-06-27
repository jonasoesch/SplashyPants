<?php

require_once(SPLASHY_DIR . "/helpers/ViewController.php");
require_once(SPLASHY_DIR . "/helpers/Template.php");

class VideoView extends ViewController {

    // "Permet d'afficher le video wall"
    public function video() {
        global $tedx_manager;
        
        $someTalks=$tedx_manager->getTalks()->getContent();
        //$msgSpeakers = $tedx_manager->
        //var_dump($someTalks);
        Template::render('video.tpl',array (
            'someTalks' => $someTalks
            
        ));
        
    }

    //Fonction de la page videoDescription
    public function videoDescription($eventId, $speakerId) {


        global $tedx_manager;
        $messageGetEvent = $tedx_manager->getEvent($eventId);


        if ($messageGetEvent->getStatus()) {
            $anEvent = $messageGetEvent->getContent();
            $messageGetSpeaker = $tedx_manager->getSpeaker($speakerId);

            //var_dump($messageGetSpeaker);
            if ($messageGetSpeaker->getStatus()) {
                $aSpeaker = $messageGetSpeaker->getContent();

                $args = array(
                    'event' => $anEvent,
                    'speaker' => $aSpeaker
                );

                $messageGetTalk = $tedx_manager->getTalk($args);
                //var_dump($messageGetTalk);

                if ($messageGetTalk->getStatus()) {
                    
                    $aTalk = $messageGetTalk->getContent();
                    $messageGetPerson = $tedx_manager->getSpeaker($speakerId);
                    if($messageGetPerson->getStatus()){
                        $speaker = $messageGetPerson->getContent();
                         $arraySpeakerTalk = array(
                        'talk' => $aTalk,
                        'speaker' => $speaker);
                    }
                        

                    Template::render('videoDescription.tpl', array(
                        'arraySpeakerTalk' => $arraySpeakerTalk,
                        'event' => $anEvent
                        ));
                } else {
                    Template::flash('could not find any video in the DB');
                }
            } else {
                Template::flash("Could not find Speaker");
            }
        } else {
            Template::flash("Could not find Event");
        }
    }
    
    
    

}

?>
