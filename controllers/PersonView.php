<?php

require_once SPLASHY_DIR . "/helpers/ViewController.php";
require_once SPLASHY_DIR . "/helpers/Template.php";

class PersonView extends ViewController {

    /** ----------------------------------------------------------------------------------------------------
     * Shows a profile page for any kind of person
     * 
     */
    public function show($id) {
        global $tedx_manager;
        $personMsg = $tedx_manager->getPerson($id);

        // Contrôler si qqn à le droit de voir ou changer un profil
        $canView = $this->canViewProfile($id);
        $canEdit = $this->canEditProfile($id);

        $talksMsg = $tedx_manager->getTalksBySpeaker($personMsg->getContent());
        $rolesMsg = $tedx_manager->getRolesByOrganizer($personMsg->getContent());

        if ($canView) {
            if ($personMsg->getStatus()) {

                $argsTpl = array(
                    'person' => $personMsg->getContent(),
                    'canEdit' => $canEdit
                );

                // If it's the profile of a speaker we want to show his talks
                if ($talksMsg->getStatus()) {
                    $argsTpl['talks'] = $talksMsg->getContent();
                } else {
                    $argsTpl['talks'] = array();
                }

                // If it's the profile of an organizer, we want to show his roles
                if ($rolesMsg->getStatus()) {
                    $argsTpl['roles'] = $rolesMsg->getContent();
                } else {
                    $argsTpl['roles'] = array();
                }

                Template::render('profile.tpl', $argsTpl);
            } else {
                Template::flash($personMsg->getMessage());
                Template::redirect('');
            }
        } else {
            Template::flash("You don't have the right to view this page.");
            Template::redirect('');
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * Displays a list of all the persons
     *
     */
    public function showAll() {
        global $tedx_manager;
        $persons = $tedx_manager->getPersons()->getContent();
        $speakers = $tedx_manager->getSpeakers()->getContent();
        $organizers = $tedx_manager->getOrganizers()->getContent();
        $participants = $tedx_manager->getParticipants()->getContent();

        Template::render('persons.tpl', array(
            'persons' => $persons,
            'speakers' => $speakers,
            'organizers' => $organizers,
            'participants' => $participants
        ));
    }

    /** ----------------------------------------------------------------------------------------------------
     * Displays the form to allow subscription with TEDx
     * but only if you're not logged in 
     */
    public function registerVisitor() {
        global $tedx_manager;
        if (!$tedx_manager->isLogged()) {
            Template::render('participantForm.tpl', array(
                "mode" => "new"
                    )
            );
        } else {
            Template::flash("Can't register when you already have an account");
            Template::redirect('');
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * Adds the Person to the database.
     *
     */
    public function registerVisitorSubmit() {
        global $tedx_manager;
        $args = $this->createPersonArray();

        $aRegisteredVisitor = $tedx_manager->registerVisitor($args);
        Template::flash($aRegisteredVisitor->getMessage());

        if ($aRegisteredVisitor->getStatus()) {
            Template::redirect("persons");
        } else {
            $args['no'] = 0;
            $args['isArchived'] = false;
            Template::render('participantForm.tpl', array(
                "person" => new Person($args),
                'mode' => "new"
                    )
            );
        }
    }

    //fonction qui affiche le template teamRoles
    public function teamRoles() {
        Template::render('teamRoles.tpl');
    }

    public function teamRolesSubmit() {
        global $tedx_manager;
        $messageAddTeamRole = $tedx_manager->addTeamRole($_POST['role']);

        Template::flash($messageAddTeamRole->getMessage());
        Template::redirect('teamRoles');
    }

    //fonction qui affiche le template register
    public function register() {
        Template::render('register');
    }

    public function registerSubmit() {
        global $tedx_manager;
        $args = array(
            'name' => $_POST['firstname'],
            'firstname' => $_POST['lastname'],
            'dateOfBirth' => $_POST['dob_year'] . "-" . $_POST['dob_month'] . "-" . $_POST['dob_day'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'phoneNumber' => $_POST['telephone'],
            'email' => $_POST['email'],
            'idmember' => $_POST['username'],
            'password' => $_POST['password'],
        );

        $aRegisteredVisitor = $tedx_manager->registerVisitor($args);
        Template::flash($aRegisteredVisitor->getMessage());

        if ($aRegisteredVisitor->getStatus()) {
            Template::redirect("persons");
        } else {
            Template::redirect('register');
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * */
    public function registerSpeaker() {
        global $tedx_manager;

        if ($tedx_manager->isOrganizer() || $tedx_manager->isAdministrator() || $tedx_manager->isSuperadmin()) {
            Template::render('speakerForm.tpl', array(
                'mode' => 'new')
            );
        } else {
            Template::flash("You don't have the right to add a speaker");
            Template::redirect('');
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * */
    public function registerSpeakerSubmit() {
        global $tedx_manager;

        if ($tedx_manager->isOrganizer() || $tedx_manager->isAdministrator() || $tedx_manager->isSuperadmin()) {
            $args = $this->createPersonArray();

            $aRegisteredSpeaker = $tedx_manager->registerSpeaker($args);
            Template::flash($aRegisteredSpeaker->getMessage());

            if ($aRegisteredSpeaker->getStatus()) {
                Template::redirect('persons');
            } else {
                $args['no'] = 0;
                $args['isArchived'] = false;
                Template::render('speakerForm.tpl', array(
                    'person' => new Person($args),
                    'mode' => 'new'
                ));
            }
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * */
    public function registerOrganizer() {
        global $tedx_manager;

        if ($tedx_manager->isAdministrator() || $tedx_manager->isSuperadmin()) {
            Template::render('organizerForm.tpl', array(
                'mode' => 'new'
            ));
        } else {
            Template::flash("You don't have the right to add an organizer");
            Template::redirect('');
        }
    }

    public function registerOrganizerSubmit() {
        global $tedx_manager;

        if ($tedx_manager->isAdministrator() || $tedx_manager->isSuperadmin()) {
            $args = $this->createPersonArray();

            $aRegisteredOrganizer = $tedx_manager->registerOrganizer($args);
            Template::flash($aRegisteredOrganizer->getMessage());

            if ($aRegisteredOrganizer->getStatus()) {
                Template::redirect('persons');
            } else {
                $args['no'] = 0;
                $args['isArchived'] = false;

                Template::render('organizerForm.tpl', array(
                    'person' => new Person($args),
                    'mode' => 'new'
                ));
            }
        }
    }

    /** ----------------------------------------------------------------------------------------------------
     * 	
     */
    public function editProfil($id) {
        global $tedx_manager;
        if ($this->canEditProfile($id)) {

            $personMsg = $tedx_manager->getPerson($id);

            // Speaker
            // Not implemented
            if ($tedx_manager->getSpeaker($id)->getStatus()) {
                Template::render('speakerForm.tpl', array(
                    "person" => $personMsg->getContent(),
                    "mode" => "edit"
                ));
                // Organizer  
            } elseif ($tedx_manager->getOrganizer($id)->getStatus()) {
                Template::render('organizerForm.tpl', array(
                    "person" => $personMsg->getContent(),
                    "mode" => "edit"
                ));
            }
            // Participant
            else {
                Template::render('participantForm.tpl', array(
                    "person" => $personMsg->getContent(),
                    "mode" => "edit"
                ));
            }
        } else {
            Template::flash("You can't edit this profile");
            Template::redirect("");
        }
    }

    /** -------------------------------------------------------------------------
     * */
    public function editProfilSubmit($id) {
        global $tedx_manager;

        $args = $this->createPersonArray();
        $args['no'] = $id;

        $aChangedProfil = $tedx_manager->changeProfil($args);


        if ($aChangedProfil->getStatus()) {
            Template::redirect("person/$id");
        } else {
            Template::flash($aChangedProfil->getMessage());
            Template::redirect("person/$id/edit");
        }
    }

    /* accept the inscription of a participant to anEvent
     * create a new acceptedRegistration and redirect on the validation page for anEvent
     * @param: 
     *          $eventId -> event's id
     *          $participantID -> participant's id
     */

    public function acceptRegistration($eventId, $participantId) {
        global $tedx_manager;

        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($eventId);
        //test if messageGetEven exists

        if ($messageGetEvent->getStatus()) {
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if ($messageGetRegistrationsByEvent->getStatus()) {

                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant, compare the id of the participant with the participantId in param and accept the registration if it's  ok
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                    if ($aParticipant->getNo() == $participantId) {
                        $messageWaitingRegistration = $tedx_manager->getRegistration(array(
                            'status' => $aRegistration->getStatus(),
                            'event' => $anEvent,
                            'participant' => $aParticipant)); //->getContent();

                        $aWaitingRegistration = $messageWaitingRegistration->getContent();
                        $anAcceptedRegistration = $tedx_manager->acceptRegistration($aWaitingRegistration);
                        //redirect on the same page and show a flash message "registration accepted"

                        Template::flash('The inscription of the participant number ' . $aParticipant->getNo() . ' has been accepted');
                        Template::redirect('event/' . $eventId . '/validateParticipant');
                    }
                }//foreach
            } else {
                //error message: no registrations found
                Template::flash('Could not find registrations for the event number' . $eventId);
            }//else
        } else {
            //error message: no event found
            Template::flash('Could not find event number ' . $eventId);
        }//else
    }

    /*
     * rejects the inscription of a participant to anEvent
     * create a new rejectedRegistration and redirect on the validation page for anEvent
     * @param: 
     *          $eventId -> event's id
     *          $participantID -> participant's id
     */

    public function rejectRegistration($eventId, $participantId) {
        global $tedx_manager;

        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($eventId);
        //test if messageGetEven exists

        if ($messageGetEvent->getStatus()) {
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if ($messageGetRegistrationsByEvent->getStatus()) {

                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant, compare the id of the participant with the participantId in param and reject the registration if it's  ok
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                    if ($aParticipant->getNo() == $participantId) {
                        $messageWaitingRegistration = $tedx_manager->getRegistration(array(
                            'status' => $aRegistration->getStatus(),
                            'event' => $anEvent,
                            'participant' => $aParticipant));
                        $aWaitingRegistration = $messageWaitingRegistration->getContent();
                        $aRejectedRegistration = $tedx_manager->rejectRegistration($aWaitingRegistration);
                        //redirect on the same page and show a flash message "registration rejected"
                        Template::flash('The inscription of the participant number ' . $aParticipant->getNo() . ' has been rejected');
                        Template::redirect('event/' . $eventId . '/validateParticipant');
                    }
                }//foreach
            } else {
                //error message: no registrations found
                Template::flash('Could not find registrations for the event number ' . $eventId);
            }//else
        } else {
            //error message: no event found
            Template::flash('Could not find event number ' . $eventId);
        }//else
    }

    /*
     * cancels the validation of a participant to anEvent
     * create a new sentRegistration (status = 'sent') and redirect on the validation page for anEvent
     * @param: 
     *          $eventId -> event's id
     *          $participantID -> participant's id
     */

    public function cancelValidationRegistration($eventId, $participantId) {
        global $tedx_manager;

        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($eventId);
        //test if messageGetEven exists

        if ($messageGetEvent->getStatus()) {
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if ($messageGetRegistrationsByEvent->getStatus()) {

                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant, compare the id of the participant with the participantId in param and cancel the registration if it's  ok
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                    if ($aParticipant->getNo() == $participantId) {
                        $messageWaitingRegistration = $tedx_manager->getRegistration(array(
                            'status' => $aRegistration->getStatus(),
                            'event' => $anEvent,
                            'participant' => $aParticipant));
                        $aWaitingRegistration = $messageWaitingRegistration->getContent();
                        $aCancelledRegistration = $tedx_manager->cancelRegistration($aWaitingRegistration);
                        //redirect on the same page and show a flash message "registration cancelled"
                        Template::flash('The validation of the participant number ' . $aParticipant->getNo() . ' has been cancelled');
                        Template::redirect('event/' . $eventId . '/validateParticipant');
                        //var_dump($aRejectedRegistration);
                    }
                }//foreach
            } else {
                //error message: no registrations found
                Template::flash('Could not find registrations for the event number ' . $eventId);
            }//else
        } else {
            //error message: no event found
            Template::flash('Could not find event number ' . $eventId);
        }//else
    }

    /* -----------------------------------------------------------------------------------------------------------
     * Gets the participants with their motivations and keywords for an Event
     * sort to keep only the last registration to an Event for each participant and only if the status of this last registration is different from 'pending'
     * and shows the last registration ba participant in a list for an Event where there are no status equals to 'pending'
     * @param:
     *          $id -> event's id
     */

    public function showParticipant($id) {
        global $tedx_manager;

        if ($tedx_manager->isAdministrator() || $tedx_manager->isSuperadmin() || $tedx_manager->isValidator()) {
            //to count the number of AcceptedRegistrations
            $numberOfAcceptedRegistrations = 0;
            //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
            $messageGetEvent = $tedx_manager->getEvent($id);
            //test if messageGetEven exists

            if ($messageGetEvent->getStatus()) {
                //get the object anEvent with the specified id
                $anEvent = $messageGetEvent->getContent();

                //call to the function to get all the registrations of the anEvent
                $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
                //test if there are some registrations or not

                if ($messageGetRegistrationsByEvent->getStatus()) {

                    //creation of the array of RegistrationParticipantwithMotivations and keywords
                    $registrationsParticipantsWithMotivations = array();


                    //get all the registrations (array)
                    $registrations = $messageGetRegistrationsByEvent->getContent();

                    //for each registration, get the participant and his motivations related to anEvent
                    foreach ($registrations as $aRegistration) {


                        $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                        // Get the last registration for the participant to an event
                        $args = array(
                            'participant' => $aParticipant,
                            'event' => $anEvent);
                        $messageGetLastRegistration = $tedx_manager->getLastRegistration($args);

                        // Get the Registrations from Message
                        $theLastRegistration = $messageGetLastRegistration->getContent();
                        //test the status of the registration because we want to keep only the status 'accepted', 'rejected', or 'sent'
                        if ($theLastRegistration->getStatus() == 'Sent' || $theLastRegistration->getStatus() == 'Accepted' || $theLastRegistration->getStatus() == 'Rejected') {
                            //test if the registration is the last registration of the participant to an event
                            if ($theLastRegistration->getStatus() == $aRegistration->getStatus()) {


                                //work on the motivations
                                //parameters for the function getMotivationsByParticipantForEvent($args);
                                $args = array(
                                    'participant' => $aParticipant,
                                    'event' => $anEvent
                                );
                                $messageGetMotivationsByParticipantForEvent = $tedx_manager->getMotivationsByParticipantForEvent($args);

                                //test if there are some motivations for $aParticipant related to the anEvent
                                if ($messageGetMotivationsByParticipantForEvent->getStatus()) {
                                    //creation of an array of motivations
                                    $motivations = $messageGetMotivationsByParticipantForEvent->getContent();
                                } else {
                                    //no motivations, array empty
                                    $motivations = array();
                                }//else
                                //work on the Keywords
                                //parameters for the function getKeywordsByPersonForEvent($args);
                                $args = array(
                                    'person' => $aParticipant,
                                    'event' => $anEvent
                                );
                                $messageGetKeywordsByPersonForEvent = $tedx_manager->getKeywordsByPersonForEvent($args);

                                //test if there are some keywords for $aParticipant related to the anEvent
                                if ($messageGetKeywordsByPersonForEvent->getStatus()) {
                                    //creation of an array of keywords
                                    $keywords = $messageGetKeywordsByPersonForEvent->getContent();
                                } else {
                                    //no keywords, array empty
                                    $keywords = array();
                                }//else
                                //fill the array $registrationsParticipantswithMotivations[] with the registration, the participant, his motivations and his keywords, related to anEvent
                                $registrationsParticipantswithMotivations[] = array(
                                    'registration' => $theLastRegistration,
                                    'participant' => $aParticipant,
                                    'motivations' => $motivations,
                                    'keywords' => $keywords
                                );
                                if ($theLastRegistration->getStatus() == 'Accepted') {
                                    $numberOfAcceptedRegistrations++;
                                }
                            }
                        }
                    }//foreach
                    //apply of the template validateParticipant.tpl and add of the var we need to use it
                    Template::render('validateParticipant.tpl', array(
                        'event' => $anEvent,
                        'registrationsParticipantsWithMotivations' => $registrationsParticipantswithMotivations,
                        'numberOfAcceptedRegistrations' => $numberOfAcceptedRegistrations
                    ));
                } else {
                    //error message: no registrations found
                    Template::flash('Could not find registrations ' . $messageGetRegistrationsByEvent->getMessage());
                }//else
            } else {
                //error message: no event found
                Template::flash('Could not find event ' . $messageGetEvent->getMessage());
            }//else
        } else {
            Template::flash('Acces denied');
            Template::redirect('');
        }
    }

//function

    /*     * **********************************************************************************************************
     * ******************************************* Helper Functions ***********************************************
     * *********************************************************************************************************** */

    /** ---------------------------------------------
     *
     */
    public function canViewProfile($personId) {
        global $tedx_manager;

        $loggedPersonMsg = $tedx_manager->getLoggedPerson();
        $canView = false;

        // Everybody can view a speaker profile
        if ($tedx_manager->getSpeaker($personId)->getStatus()) {
            $canView = true;
        }

        // Everybody can view an organizer profile
        if ($tedx_manager->getOrganizer($personId)->getStatus()) {
            $canView = true;
        }

        // Everybody can view his own profile
        if ($loggedPersonMsg->getStatus() && ($loggedPersonMsg->getContent()->getNo() == $personId)) {
            $canView = true;
        }

        // Validators, Organizers and Admins can view all the profiles
        if ($tedx_manager->isValidator() ||
                $tedx_manager->isOrganizer() ||
                $tedx_manager->isAdministrator() ||
                $tedx_manager->isSuperadmin()) {
            $canView = true;
        }

        return $canView;
    }

    /** ----------------------------------------------------------------------------------------------------
     * Check if somebody has the right to change the profile of a 
     * person with a given id.
     */
    public function canEditProfile($personId) {
        global $tedx_manager;

        $loggedPersonMsg = $tedx_manager->getLoggedPerson();
        $canEdit = false;

        if ($loggedPersonMsg->getStatus()) {

            // Anybody can edit his proper profile
            if ($loggedPersonMsg->getContent()->getNo() == $personId) {
                $canEdit = true;

                // All kinds of website-manager can edit any profile
            } else if ($tedx_manager->isValidator() ||
                    $tedx_manager->isOrganizer() ||
                    $tedx_manager->isAdministrator() ||
                    $tedx_manager->isSuperadmin()
            ) {
                $canEdit = true;
            }
        }
        return $canEdit;
    }

    /** ----------------------------------------------------------------------------------------------------
     * */
    public function createPersonArray() {
        $args = array(
            'name' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'firstName' => $_POST['firstname'],
            'dateOfBirth' => $_POST['dob_year'] . "-" . $_POST['dob_month'] . '-' . $_POST['dob_day'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'phoneNumber' => $_POST['telephone'],
            'email' => $_POST['email']
        );

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $args['idmember'] = $_POST['username'];
            $args['password'] = $_POST['password'];
        }

        if (isset($_POST['description'])) {
            $args['description'] = $_POST['description'];
        }

        return $args;
    }

    public function locations() {
        Template::render('locations.tpl');
    }

    public function locationsSubmit() {
        global $tedx_manager;
        $args = array(
            'name' => $_POST['Name'],
            'direction' => $_POST['Direction'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'phoneNumber' => $_POST['telephone'],
            'email' => $_POST['email']
        );

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $args['idmember'] = $_POST['username'];
            $args['password'] = $_POST['password'];
        }

        if (isset($_POST['description'])) {
            $args['description'] = $_POST['description'];
        }

        return $args;
    }

    public function registerToAnEvent($eventId) {
        global $tedx_manager;

        if ($tedx_manager->isLogged()) {
            if ($tedx_manager->isParticipant()) {

                Template::flash("You are already participating on this event!");
                Template::redirect("event/$eventId");
            } else {
                Template::render('registerToAnEvent.tpl');


                $event = $tedx_manager->getEvent($eventId)->getContent();
                Template::render('registerToAnEvent.tpl', array(
                    'Event' => $event
                ));
            }
        } else {

            Template::flash('You need to become member of the TEDx community before you can register for an event');
            Template::redirect('register');
        }
    }

    public function registerToAnEventSubmit($eventId) {

        global $tedx_manager;
        $currentEvent = $tedx_manager->getEvent($eventId)->getContent();

        // R?cup?re le message contenant une personne logg?e
        $messagePersonLogged = $tedx_manager->getLoggedPerson();
        $loggedPerson = "";
        // Si on a bien re?u une personne, on la var_dump
        if ($messagePersonLogged->getStatus()) {
            $loggedPerson = $messagePersonLogged->getContent();
        }
        // Sinon affichage du message d'erreur
        else {
            echo $messagePersonLogged->getMessage();
        }


        $args1 = array(
            'person' => $loggedPerson, // object Person
            'event' => $tedx_manager->getEvent($eventId)->getContent(), // object Event
            //'slots' => $aListOfSlots, // List of objects Slot OPTIONNAL
            'type' => 'Presse', // String
            'typeDescription' => 'Redacteur chez Edipresse SA'
        );

        $messageRegisteredParticipant = $tedx_manager->registerToAnEvent($args1);
        $aRegisteredParticipant = "";


        if ($messageRegisteredParticipant->getStatus()) {
            $aRegisteredParticipant = $messageRegisteredParticipant->getContent();
            echo 'Congrats! ' . $messageRegisteredParticipant->getMessage();
        } else {
            Template::flash($messageRegisteredParticipant->getMessage());
            Template::render('registerToAnEvent.tpl');
        }


        $aMotivation = array(
            'text' => $_POST['motivation'],
            'event' => $tedx_manager->getEvent($eventId)->getContent(),
            'participant' => $aRegisteredParticipant
        );


        $aMotivationAddedToAnEvent = $tedx_manager->addMotivationToAnEvent($aMotivation);
        Template::flash($messageRegisteredParticipant->getMessage());

        if ($messageRegisteredParticipant->getStatus()) {
            Template::redirect("persons");
        } else {
            Template::redirect('register');
        }

        if ($aMotivationAddedToAnEvent->getStatus())
            echo 'Congrats!' . $aMotivationAddedToAnEvent->getMessage();
        else
            echo 'Error!' . $aMotivationAddedToAnEvent->getMessage();


        // Args addKeywordsToAnEvent
        $args2 = array(
            'listOfValues' => array($_POST['keyword1'], $_POST['keyword2'], $_POST['keyword3']), //List of object values
            'person' => $aRegisteredParticipant, // object Person,
            'event' => $currentEvent // object Event
        );
        // Add keyword to an event
        $anAddedKeywords = $tedx_manager->addKeywordsToAnEvent($args2);

        // Message
        if ($anAddedKeywords->getStatus())
            echo 'Congrats!' . $anAddedKeywords->getMessage();
        else
            echo 'Error!' . $anAddedKeywords->getMessage();
    }

    public function allocateTeamRoles() {
        global $tedx_manager;
        $messageGetRole = $tedx_manager->getRoles();
// Message
        if (!$messageGetRole->getStatus())
            Template::flash($messageGetRole->getMessage());
        $messageGetOrganizers = $tedx_manager->getOrganizers();
// Message
        if (!$messageGetOrganizers->getStatus())
            Template::flash($messageGetOrganizers->getMessage());
        Template::render("allocateTeamRoles.tpl", array('roles' => $messageGetRole->getContent(), 'organizers' => $messageGetOrganizers->getContent()));
    }

    public function allocateTeamRolesSubmit() {

        // object Organizer
        $anOrganizer=$tedx_manager->getOrganizer($_POST['organizerSelect']);
        // object TeamRole
        $aTeamRole=$_POST['rolesSelect'];
        //current event
        $anEvent= EventView::getLatestEvent();
                
        $argsRole = array(
            'name' => $_POST['rolesSelect'],
            'event' => $anEvent,
            'organizer' => $anOrganizer
        );

        $messageGetRole = $tedx_manager->getRole($argsRole);
        
        $args = array(
            'organizer' => $anOrganizer,
            'teamRole' => $messageGetRole->getContent()
        );
        // affect teamRole
        $messageAffectTeamRole = $tedx_manager->affectTeamRole($args);
        
        if ($messageGetRole->getStatus())
            echo 'Congrats! ' . $messageGetRole->getMessage();
        else
            echo 'Error! ' . $messageGetRole->getMessage();
        
        // Message
        if ($messageAffectTeamRole->getStatus())
            echo 'Congrats! ' . $messageAffectTeamRole->getMessage();
        else
            echo 'Error! ' . $messageAffectTeamRole->getMessage();

        // Object Event
        $anEvent;
        // Object Organizer
        $anOrganizer;

        // args get Role
        
// getting the role
        
// Message
        
    }

//class


    /*
      $args = array(
      'name'        => isset($_POST['lastname']) ? $_POST['lastname'] : "",
      'firstname'   => isset($_POST['firstname']) ? $_POST['firstname'] : "",
      'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month'].'-'.$_POST['dob_day'],
      'address'     => isset($_POST['address']) ? $_POST['address'] : "",
      'city'        => isset($_POST['city']) ? $_POST['city'] : "",
      'country'     => isset($_POST['country']) ? $_POST['country'] : "",
      'phoneNumber' => isset($_POST['telephone']) ? $_POST['telephone'] : "",
      'email'       => isset($_POST['email']) ? $_POST['email'] : "",
      'idmember'    => isset($_POST['username']) ? $_POST['username'] : "",
      'password'    => isset($_POST['password']) ? $_POST['password'] : ""
      );
     */
}

?>
