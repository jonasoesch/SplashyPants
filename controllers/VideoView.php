<?php

require_once(SPLASHY_DIR . "/helpers/ViewController.php");
require_once(SPLASHY_DIR . "/helpers/Template.php");

class VideoView extends ViewController {

    /** ----------------------------------------------------------------------------------------------------
     * This function is for screening the video wall in the video template
     * It takes all the information from the speaker and puts the speakers array which will be send
     * with all the talkmessage array to the video template
     * @param:$id identifiant de l'event
     */
    public function video() {
        global $tedx_manager;
        
        $talksMsg =$tedx_manager->getTalks();
        if($talksMsg->getStatus()) {
          
          $talks = $talksMsg->getContent();
          $speakers = array();
          
          foreach($talks as $talk) {
            $speakers[$talk->getSpeakerPersonNo()] = $tedx_manager->getSpeaker($talk->getSpeakerPersonNo())->getContent();
          }
        }
        
       
        Template::render('video.tpl',array (
            'someTalks' => $talks,
            'speakers' => $speakers
            
        ));
        
    }

    /** ----------------------------------------------------------------------------------------------------
     * Cette mŽthode affiche l'event ˆ partir de l'id reu.
     * 
     * This function is here to show the detailed video template. 
     * @param:eventId identifier of the event
     *        $speakerId identifier of the speaker
     */
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
