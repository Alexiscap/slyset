<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pop_in_general extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('pop');

        $this->load->model(array('concert_model', 'photo_model', 'achat_model', 'document_model', 'musique_model','achat_model'));
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
    }

    // ---- - - --- - - - - - - Pop in Concert - - - - - - - -  --  -- 

    public function ajouter_concert($user_id) {
        $uid = $this->session->userdata('uid');

        if ($user_id != $uid) {
            show_404();
        }

        $this->form_validation->set_error_delimiters('<div class="error-form">', '</div>');

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('concert/ajouter_concert');
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');
            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].= $mot_uniq_glgle[$i] . '+';
            }
            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville'])) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
                }
                $cpr2 = curl_init();
                $pays = null;
                $code_postal = null;
                $route = null;
                $street_number = null;
                $phone = null;
                $website = null;
                if (isset($url_detail_place)) {
                    curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                    curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                    $data['curl2'] = curl_exec($cpr2);
                    $data['test2'] = json_decode($data['curl2']);

                    if (isset($data['test2'])) {
                        $phone = $data['test2']->{'result'}->{'formatted_phone_number'};

                        $website = $data['test2']->{'result'}->{'website'};
                        $adress_component = $data['test2']->{'result'}->{'address_components'};
                        $nbr_componenent = count($adress_component);
                        for ($i = 0; $i < $nbr_componenent; $i++) {
                            //modifier: m ettre case
                            if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                $street_number = $adress_component[$i]->{'short_name'};
                            }
                            if ($adress_component[$i]->{'types'}[0] == 'route') {
                                $route = $adress_component[$i]->{'short_name'};
                            }

                            if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                $code_postal = $adress_component[$i]->{'short_name'};
                            }
                            if ($adress_component[$i]->{'types'}[0] == 'country') {
                                $pays = $adress_component[$i]->{'short_name'};
                            }
                        }
                    }
                }

                $this->concert_model->ajout_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $user_id, $phone, $website);
            }

            $data_success['status'] = 'ajouté';
            $this->load->view('concert/success-concert', $data_success);
        }
    }

    public function modifier_concert($user_id, $concert_id, $adresse_id) {
        $uid = $this->session->userdata('uid');

        if ($user_id != $uid) {
            show_404();
        }

        $data = array();

        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

        $data['info_concert'] = $this->concert_model->get_one_concert($concert_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('concert/modifier_concert', $data);
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');

            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].=
                        $mot_uniq_glgle[$i] . '+';
            }

            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville']) || isset($data['concert_lieu_salle']) || $data['concert_lieu_salle'] != $data['info_concert'][0]->{'salle'} || $data['concert_lieu_ville'] != $data['info_concert'][0]->{'ville'}) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************

                    $cpr2 = curl_init();
                    $pays = null;
                    $code_postal = null;
                    $route = null;
                    $street_number = null;
                    $phone = null;
                    $website = null;

                    if (isset($url_detail_place)) {
                        curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                        curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                        curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                        $data['curl2'] = curl_exec($cpr2);
                        $data['test2'] = json_decode($data['curl2']);

                        if (isset($data['test2'])) {
                            $phone = $data['test2']->{'result'}->{'formatted_phone_number'};
                            $website = $data['test2']->{'result'}->{'website'};
                            $adress_component = $data['test2']->{'result'}->{'address_components'};
                            $nbr_componenent = count($adress_component);
                            for ($i = 0; $i < $nbr_componenent; $i++) {
                                //modifier: m ettre case
                                if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                    $street_number = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'route') {
                                    $route = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                    $code_postal = $adress_component[$i]->{'short_name'};
                                }
                                if ($adress_component[$i]->{'types'}[0] == 'country') {
                                    $pays = $adress_component[$i]->{'short_name'};
                                }
                            }
                        }
                    }
                }
            }

            $this->concert_model->update_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $concert_id, $adresse_id, $phone, $website);

            $data_success['status'] = 'modifié';
            $this->load->view('concert/success-concert', $data_success);
        }
    }

    public function suppression_concert($user_id, $concert_id, $adresse_id) {
        $uid = $this->session->userdata('uid');

        if ($user_id != $uid) {
            show_404();
        }

        $data = array();

        if ($this->input->post("delete")) {
            $this->concert_model->delete_concert_data($concert_id, $adresse_id);
            $data_succes['status'] = 'supprimé';
            $this->load->view('concert/success-concert', $data_succes);
        } else {
            $this->load->view('concert/suppression_concert', $data);
        }
        // echo $this->input->post("no_delete"); {
        //CLOSE POP UP
        //}
    }

    public function zoom_photo($id_photo, $id_album) {
        $data = array();

        $data['zoom'] = $this->photo_model->get_zoom_photos($id_photo);
        $data['zoom_comment'] = $this->photo_model->get_zoom_photos_comment($id_photo);

        $this->load->view('photos/pi_voir_photo', $data);
    }

    public function upload_photo($user_id) {
        $this->load->model('photo_model');

        $data = array('error' => ' ');
        $data['options'] = array(
            '' => '',
        );
        $data['album_by_user'] = $this->photo_model->get_album($user_id);

//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :

        $data['max_album_user'] = count($data['album_by_user']);
//        for($i=0; $i<$max_album_user; $i++){	
//            $data['options'][$album_by_user[$i]->{'nom'}] = $album_by_user[$i]->{'nom'};  
//        }
//        $data['options']['nouveau']="Creer un nouvel album";

        $this->load->view('photos/ajouter_photos', $data);
    }

    public function add_video($user_id) {
        $url_video_complete = $this->input->post('url_video');
        $description = $this->input->post('description');
        $id_url_v = strstr($url_video_complete, "v=");
        $id_url = mb_strcut($id_url_v, 2, 11);
        //envoit en bdd de l'id et la description ainsi que l'album
        $this->form_validation->set_rules('url_video', 'url_video', 'required');

        $data = array('error' => ' ');
        $data['options'] = array(
            '' => '',
        );
        $data['album_by_user'] = $this->photo_model->get_album($user_id);

//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :

        $data['max_album_user'] = count($data['album_by_user']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('photos/add_video', $data);
        } else {
            $noespace_filename_album = str_replace(' ', '_', $this->input->post('albums'));

            $this->photo_model->add_video($id_url, $user_id, $description, $this->input->post('albums'), $noespace_filename_album);
            $this->load->view('photos/photos_success', $data);
        }
    }

    public function do_upload($user_id) {
        $noespace_filename_album = str_replace(' ', '_', $this->input->post('albums'));
        $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $noespace_filename_album;

        if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
        }

        $cover_photo = (count(scandir($dynamic_path)));

        $config['upload_path'] = $dynamic_path;
        /* if ($cover_photo <= 2) {
          $config['file_name'] = "cover";
          }
         */
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        /* $config['max_size'] = '1000';
          $config['max_width'] = '1024';
          $config['max_height'] = '768'; */
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $photo = $this->input->post('photo_up');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo_up')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('photos/ajouter_photos', $error);
        } else {
            $upload_data = $this->upload->data();
            //$_POST['photo'] = $data['file_name'];
            //envoyer id utilisateur, nom photos, noms albums
            $this->photo_model->insert_photos($upload_data['file_name'], $user_id, $noespace_filename_album, $this->input->post('albums'), $this->input->post('description'));

            $this->load->view('photos/photos_success', $upload_data);
        }
    }

    public function update_photo($user_id, $id_media, $type) {
        $this->form_validation->set_rules('description', 'description', 'required');

        // cas possible : 
        //update le nom d'une photo orpheline donc sans albm -> ok
        //update du nom d'un album -> ok
        //update une video -> le nom ->ok
        // Video et photo -> changer nom d'alubm 
        // mettre sans album
        // ajouter un album
        //si cover et changement ou suppresion album -> changer la cover
        //pour album : changement de direction fichier
        //update du nom d'une photo dans un album 
        //update une video -> la mettre dans un album
        //ajouter un  album a une photo : nouvel album
        // changer l'album d'une photo
        //supprimer la photo d'un album
        //supprimer une video d'un album

        $data = array();
        $data['album_by_user'] = $this->photo_model->get_album($user_id);
        $data['max_album_user'] = count($data['album_by_user']);

        if ($type == 1) {
            $data['info_album_photo'] = $this->photo_model->get_abum_for_photo($id_media);
            $data['info_photo'] = $this->photo_model->get_photo_by_id($id_media);
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->helper(array('form', 'url'));

            $this->load->view('photos/update_photo', $data);
        } else {
            if ($type == 1) {
                //info de l'album renseigné : donc changement album pour photo
                $file_name_a = $this->photo_model->get_info_album($this->input->post('albums'));
                //file name de l'album renseigné soit deja existant / soit nouveau

                if (isset($file_name_a[0]->file_name)) {
                    $file_name_album = $file_name_a[0]->file_name;
                } else {
                    //creation d'un nouvel album pour la photo
                    $file_name_album = str_replace(' ', '_', $this->input->post('albums'));
                    $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $file_name_album;

                    if (is_dir($dynamic_path) == false) {
                        mkdir($dynamic_path, 0755, true);
                    }
                    //specifier le nom cover à la photo  
                }
                //mise a jour en bdd des infos photos + album
                //definition des changement de paths des fichiers

                if (isset($data['info_album_photo'][0]->file_name)) {
                    $file_base = './files/' . $user_id . '/photos/' . $data['info_album_photo'][0]->file_name . '/' . $data['info_photo'][0]->file_name;
                } else {
                    $file_base = './files/' . $user_id . '/photos/' . $data['info_photo'][0]->file_name;
                }
                /* if (isset($dynamic_path)) {
                  $data['info_photo'][0]->file_name = "cover.jpg";
                  } */
                if ($file_name_album != null) {
                    $file_obj = './files/' . $user_id . '/photos/' . $file_name_album . '/' . $data['info_photo'][0]->file_name;
                } else {
                    $file_obj = './files/' . $user_id . '/photos/' . '/' . $data['info_photo'][0]->file_name;
                }

                //changement de paths du fichiers
                rename($file_base, $file_obj);
                $data['update_photos'] = $this->photo_model->update_photo($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album, $data['info_photo'][0]->file_name);

                $this->load->view('photos/photos_success', $data);
            }

            if ($type == 2) {

                $file_name_a = $this->photo_model->get_info_album($this->input->post('description'));
                //file name de l'album renseigné soit deja existant / soit nouveau
                $file_name_album = str_replace(' ', '_', $this->input->post('description'));
                $old_name = './files/' . $this->session->userdata('uid') . '/photos/' . $id_media;
                $new_name = './files/' . $this->session->userdata('uid') . '/photos/' . $file_name_album;


                rename($old_name, $new_name);



                $data['update_photos'] = $this->photo_model->update_album($user_id, $id_media, $this->input->post('description'), $file_name_album);
                $this->load->view('photos/photos_success', $data);
            }

            if ($type == 3) {
                //info de l'album renseigné : donc changement album pour photo
                $file_name_a = $this->photo_model->get_info_album($this->input->post('albums'));
                //file name de l'album renseigné soit deja existant / soit nouveau

                if (isset($file_name_a[0]->file_name)) {
                    $file_name_album = $file_name_a[0]->file_name;
                } else {
                    //creation d'un nouvel album pour la photo
                    $file_name_album = str_replace(' ', '_', $this->input->post('albums'));
                    $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $file_name_album;

                    if (is_dir($dynamic_path) == false) {
                        mkdir($dynamic_path, 0755, true);
                    }
                }

                $data['update_photos'] = $this->photo_model->update_video($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album);
                $this->load->view('photos/photos_success', $data);

                //$user_id,$id_video,$nom_video,$album_name,$file_name_a
            }
        }
    }

    public function suppression_media($user_id, $media_id, $type_media) {
        $this->load->model('photo_model');
        $uid = $this->session->userdata('uid');

        $data = array();
        //print $type_media;

        if ($user_id != $uid) {
            show_404();
        }

        if ($this->input->post("delete")) {
            if ($type_media == 1) {
                $this->photo_model->delete_photo($media_id);
                $this->load->view('photos/photos_success');
            }

            if ($type_media == 2) {
                $this->photo_model->delete_album($media_id);
                $this->load->view('photos/photos_success');
            }

            if ($type_media == 3) {
                $this->photo_model->delete_video($media_id);
                $this->load->view('photos/photos_success');
            }
        }
        echo $this->input->post("no_delete"); {
            //CLOSE POP UP
        }

        $this->load->view('photos/delete_photos', $data);
    }

    public function delete_user($user_id) {
        $uid = $this->session->userdata('uid');

        if ($user_id != $uid) {
            show_404();
        }

        $this->user_id = $this->uri->segment(3);
        $data = array();
        $data['profile'] = $this->user_model->getUser($this->user_id);

        $this->form_validation->set_rules('confirm-oui', 'Oui', '');
        $this->form_validation->set_rules('confirm-non', 'Non', '');

        if ($this->form_validation->run() == FALSE) {
//            $this->layout->ajouter_css('colorbox');
//            $this->layout->ajouter_js('jquery.colorbox');
            $this->load->view('reglage/pi_suppression_confirm', $data);
        } else {
            $confirm = $this->input->post('confirm-oui');
            $unconfirm = $this->input->post('confirm-non');

            if ($confirm) {
                
            } else {
                redirect('my-reglages/' . $uid, 'refresh');
            }
            redirect('home', 'refresh');
        }
    }

    public function panier_infos() {
        $data = array();
        $this->form_validation->set_rules('email', 'email', 'valid_email');

        $user_id = $this->session->userdata('uid');
        $data['cmd'] = $this->achat_model->get_achat($user_id);

        //paiement-commande
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('achat/pi_ta_infos', $data);
        } else {
            $this->validation_commande();
        }
    }

    public function validation_commande() {
        $format = $this->input->post('format');
        $email = $this->input->post('email');
        $nom = $this->input->post('nom');

        $this->session->set_flashdata('email', $email);
        $this->session->set_flashdata('nom', $nom);

        $this->load->view('achat/pi_ta_paiement');
    }

    public function paiement() {
        $data = array();

        $this->form_validation->set_rules('code_carte', 'code_carte', 'exact_length[16]|numeric|required');
        $this->form_validation->set_rules('code_secu', 'code_secu', 'exact_length[3]|numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('achat/pi_ta_paiement', $data);
        } else {
            $this->validation_paiement();
        }
    }

    public function validation_paiement() {
        $data = array();
        $data['cmd'] = $this->achat_model->get_achat($this->session->userdata('uid'));

        $number_last_commande = $this->achat_model->number_commande();
        $data['numero_cmd'] = $number_last_commande[0]->last_cmd;

        foreach ($data['cmd'] as $commande) {
            if ($commande->status == "P") {
                $this->achat_model->panier_to_achat($commande->id, $number_last_commande[0]->last_cmd);
            }
        }

        $email = $this->session->flashdata('email');
        $nom = $this->session->flashdata('nom');

        $to = $email;

        $subject = 'test';

        $message = '<html>
                        <head>
                          <title>Facture Slyset</title>
                        </head>
                        <body>
                          Bonjour' . $nom . ' </br></br>

                      Les artistes de Slyset vous remercies de cette commande que vous venez de passer sur notre site internet. </br></br>

                      Voici le récapitulatif de votre commande ___________. </br></br>
                      Cette commande a été passée ___________date </br></br>

                      Numéro de transaction : 24966070 </br></br>

                      Nous vous confirmons le bon paiement suivant (Paiement paybox numéro 372-13022423362169999). </br></br>

                      Montant TOTAL TTC : 51,60 € (dont 1,00 € de frais de gestion) </br></br>

                        </body>
                    </html>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        mail($to, $subject, $message, $headers);
            
        $data['cmd_download'] = $this->achat_model->cmd_valider($data['numero_cmd']);

        $this->load->view('achat/pi_ta_dl', $data);
    }

    public function get_morceaux() {
        $album_id = $this->input->post('id_album');
        $type = $this->input->post('type');
        $data['morceaux'] = $this->document_model->get_morceau_by_album($album_id, $type);
        $all_option = '<option name="morceaux" value=""></option>';

        if (empty($data['morceaux']) != 1) {
            foreach ($data['morceaux'] as $morceau) {
                $all_option .=
                        $option = '<option name="morceaux" value="' . $morceau->id . '">' . $morceau->nom . '</option>';
            }
        } else {
            $all_option = '<option name="morceaux" value="Aucun morceaux disponibles">Aucun morceaux disponibles</option>';
        }

        echo '<select name="morceaux" class="mor">' . $all_option . '</select>';
    }

    public function livret($album_id) {
        $data = array();
        $data['error'] = " ";
        $data['id_alb'] = $album_id;

        $data['album'] = $this->document_model->get_one_album($album_id);

        $this->load->view('partition/pi_ajout_livret', $data);
	
	}
		
	// ************************************************************
	// ******************		LIVRET  	***********************
	// ************************************************************
	
	function do_upload_livret() {
		$this->form_validation->set_rules('livret', 'livret', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$data = array('error' => '');

			$this->load->view('partition/pi_ajout_livret',$data);
		}
		else
		{
			
 	   		$album = $this->input->post('livret');
        	//print $morceau = $this->input->post('morceaux');
			print $album;
        	$album_exp = explode('+', $album);
        	$album_name = $album_exp[0];
        	$album_file_name = str_replace(' ','_',$album_exp[0]);
        	$album_id = $album_exp[1];
        	print $album_id;
            print $album_file_name;
        	$noespace_filename_album = str_replace(' ', '_', $album_name);
        	$dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' . $noespace_filename_album.'/livret';
		
        	if (is_dir($dynamic_path) == false) {
        	    mkdir($dynamic_path, 0755, true);
        	}

        	$config['upload_path'] = $dynamic_path;
        	$config['remove_space'] = TRUE;
        	$config['overwrite'] = TRUE;
        	$config['allowed_types'] = 'pdf';


        	$this->load->library('upload', $config);
        	if (!$this->upload->do_upload()) {
        	    $data = array('error' => $this->upload->display_errors());
        	    $this->load->view('partition/pi_ajout_livret', $data);
        	} 
        	else {
            	$data = array('upload_data' => $this->upload->data());


            	$this->document_model->insert_livret($album_id, $data['upload_data']['file_name']);
            	//	$this->load->view('partition/pi_ajout_paroles', $data);
        	}
        }
    }

    public function update_livret($album_id) {
        $data = array();
        $data['error'] = " ";
        $data['id_alb'] = $album_id;
        $data['album'] = $this->document_model->get_one_album($album_id);
        $this->load->view('partition/pi_update_livret', $data);
    }

    function update_file_livret() {
        $this->form_validation->set_rules('livret', 'livret', 'required');

        $album = $this->input->post('livret');
        //print $morceau = $this->input->post('morceaux');
        $album_exp = explode('+', $album);
        $album_name = $album_exp[0];
        $album_file_name = str_replace(' ', '_', $album_exp[0]);
        $album_id = $album_exp[1];
        if ($this->input->post("delete")) {
            $this->document_model->delete_livret($album_id);
        } else {
            if ($this->form_validation->run() == FALSE) {

                $data = array('error' => '');
                $this->update_livret($album_id);
            } else {
                $album = $this->input->post('livret');
                //print $morceau = $this->input->post('morceaux');
                $album_exp = explode('+', $album);
                $album_name = $album_exp[0];
                $album_file_name = str_replace(' ', '_', $album_exp[0]);
                $album_id = $album_exp[1];
                $noespace_filename_album = str_replace(' ', '_', $album_name);
                $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' . $album_file_name . '/livret';

                if (is_dir($dynamic_path) == false) {
                    mkdir($dynamic_path, 0755, true);
                }

                $config['upload_path'] = $dynamic_path;
                $config['remove_space'] = TRUE;
                $config['overwrite'] = TRUE;
                $config['allowed_types'] = 'pdf';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('partition/pi_update_livret', $error);

                    //$this->load->view('partition/pi_ajout_livret', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $this->document_model->insert_livret($album_id, $data['upload_data']['file_name']);
                    //	$this->load->view('partition/pi_ajout_paroles', $data);
                }
            }
        }
    }

    function update_file_paroles($doc_id)
    {
        //$this->form_validation->set_rules('paroles_upd', 'paroles_upd', 'required');
        $doc = $this->document_model->get_one_doc_by_id($doc_id);
        if ($this->input->post("delete")) 
        {
            $this->document_model->delete_paroles($doc_id);
            $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' .str_replace(' ', '_', $doc[0]->alb_name).'/paroles';
            unlink('./files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/paroles/'.$doc[0]->doc_path);
        }
       
        else
        {
           /* if ($this->form_validation->run() == FALSE)
            {
                $data = array('error' => '');
                $this->update_paroles($doc_id);
            
            }
            else
            {*/
                $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/paroles';
                $config['upload_path'] = $dynamic_path;
                $config['remove_space'] = TRUE;
                $config['overwrite'] = TRUE;
                $config['allowed_types'] = 'pdf';
    

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    if($this->input->post('parole_price')!=null)
                    {
                        $prix = $this->input->post('parole_price');
                        $this->document_model->update_paroles_price($doc_id,$prix);
                    }
                    else
                    {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error) ;
                        $this->update_paroles($doc_id);
                    }


                    //$this->load->view('partition/pi_ajout_livret', $error);
                } 
                else 
                {
                    unlink('./files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/paroles/'.$doc[0]->doc_path);
                    $prix = $this->input->post('parole_price');
                    $data = array('upload_data' => $this->upload->data());
                    $this->document_model->update_paroles($doc_id, $data['upload_data']['file_name'],$prix);
                    //  $this->load->view('partition/pi_ajout_paroles', $data);
                }
            //}
       }

    }
    
    // ************************************************************
    // ******************		PAROLES  	***********************
    // ************************************************************

    public function paroles() {
        $data = array();
        $data['error'] = " ";
        $data['album'] = $this->document_model->get_album($this->session->userdata('uid'));
        $this->load->view('partition/pi_ajout_paroles', $data);
    }
    
    function do_upload_paroles() {
    	if ($this->input->post("submit")) 
    	{

        	$album = $this->input->post('album_doc');
        	$morceau = $this->input->post('morceaux');
        	print $morceau;
        	$album_exp = explode('+', $album);
        	$album_name = $album_exp[0];
        	if(isset($album_exp[1])){ $album_id = $album_exp[1];}
        	$noespace_filename_album = str_replace(' ', '_', $album_name);
        	$dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/'.$noespace_filename_album.'/paroles/';

        	if (is_dir($dynamic_path) == false) {
            	mkdir($dynamic_path, 0755, true);
        	}



        	$config['upload_path'] = $dynamic_path;
        	$config['remove_space'] = TRUE;
        	$config['overwrite'] = TRUE;
        	$config['allowed_types'] = 'pdf';


            $this->load->library('upload', $config);

             if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('partition/pi_ajout_paroles', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $parole_price = $this->input->post('parole_price');
                $this->document_model->insert_doc($parole_price, $album_id, $morceau, $data['upload_data']['file_name'], "paroles");
                //	$this->load->view('partition/pi_ajout_paroles', $data);
            }
        } else if ($this->input->post("delete")) {
            $album = $this->input->post('album');
            print 'delete';
            $album_exp = explode('+', $album);
            $album_name = $album_exp[0];
            $album_id = $album_exp[1];
            $noespace_filename_album = str_replace(' ', '_', $album_name);
            $dynamic_path = './files/' . $this->session->userdata('uid') . '/documents/' . $album_id;
        }
    


   }
    
    
    public function update_paroles($document_id)
    {
        $data = array();
        $data['error'] = " ";
        $data['document']=$this->document_model->get_one_doc_by_id($document_id);
        //$data['id_alb'] = $album_id;
        //$data['album'] = $this->document_model->get_one_album($album_id);
        $this->load->view('partition/pi_update_paroles', $data);

    }

    public function partition() {
        $data = array();
        $data['error'] = " ";
        $data['album'] = $this->document_model->get_album($this->session->userdata('uid'));
        $this->load->view('partition/pi_ajout_partitions', $data);
    }

    function do_upload_partition() {
       if ($this->input->post("submit")) 
        {

            $album = $this->input->post('album_doc');
            $morceau = $this->input->post('morceaux');
            $album_exp = explode('+', $album);
            $album_name = $album_exp[0];
            if(isset($album_exp[1])){ $album_id = $album_exp[1];}
            $noespace_filename_album = str_replace(' ', '_', $album_name);
            $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/'.$noespace_filename_album.'/partition/';


            if (is_dir($dynamic_path) == false) {
                mkdir($dynamic_path, 0755, true);
            }



            $config['upload_path'] = $dynamic_path;
            $config['remove_space'] = TRUE;
            $config['overwrite'] = TRUE;
            $config['allowed_types'] = 'pdf';


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('partition/pi_ajout_partitions', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());


            $partition_price = $this->input->post('partition_price');
                $this->document_model->insert_doc($partition_price,$album_id, $morceau, $data['upload_data']['file_name'], "partition");
            //  $this->load->view('partition/pi_ajout_paroles', $data);
            }
        }

    }


    public function update_partition($document_id)
    {
        $data = array();
        $data['error'] = " ";
        $data['document']=$this->document_model->get_one_doc_by_id($document_id);
        //$data['id_alb'] = $album_id;
        //$data['album'] = $this->document_model->get_one_album($album_id);
        $this->load->view('partition/pi_update_partition', $data);

    }

        function update_file_partition($doc_id)
    {
        //$this->form_validation->set_rules('paroles_upd', 'paroles_upd', 'required');
        $doc = $this->document_model->get_one_doc_by_id($doc_id);
        if ($this->input->post("delete")) 
        {
            $this->document_model->delete_paroles($doc_id);
            $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' .str_replace(' ', '_', $doc[0]->alb_name).'/partition';
            unlink('./files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/partition/'.$doc[0]->doc_path);
        }
       
        else
        {
           /* if ($this->form_validation->run() == FALSE)
            {
                $data = array('error' => '');
                $this->update_paroles($doc_id);
            
            }
            else
            {*/
                $dynamic_path = './files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/partition';
                $config['upload_path'] = $dynamic_path;
                $config['remove_space'] = TRUE;
                $config['overwrite'] = TRUE;
                $config['allowed_types'] = 'pdf';
    

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    if($this->input->post('partition_price')!=null)
                    {
                        $prix = $this->input->post('partition_price');
                        $this->document_model->update_paroles_price($doc_id,$prix);
                    }
                    else
                    {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error) ;
                        $this->update_paroles($doc_id);
                    }


                    //$this->load->view('partition/pi_ajout_livret', $error);
                } 
                else 
                {
                    unlink('./files/' . $this->session->userdata('uid') . '/albums/' . str_replace(' ', '_', $doc[0]->alb_name).'/partition/'.$doc[0]->doc_path);
                    $prix = $this->input->post('partition_price');
                    $data = array('upload_data' => $this->upload->data());
                    $this->document_model->update_paroles($doc_id, $data['upload_data']['file_name'],$prix);
                    //  $this->load->view('partition/pi_ajout_paroles', $data);
                }
            //}
       }

    }
	


    public function upload_musique($user_id) {
//        $this->load->model('photo_model');

        $data = array('error' => ' ');
        $data['options'] = array(
            '' => '',
        );
//        $data['album_by_user'] = $this->photo_model->get_album($user_id);
//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :
//        $data['max_album_user'] = count($data['album_by_user']);
//        for($i=0; $i<$max_album_user; $i++){	
//            $data['options'][$album_by_user[$i]->{'nom'}] = $album_by_user[$i]->{'nom'};  
//        }
//        $data['options']['nouveau']="Creer un nouvel album";

        $this->load->view('musique/upload_musique', $data);
    }

    public function edit_musique($uid, $track_id) {
        $this->load->library('getid3/Getid3');
        $textEncoding = 'UTF-8';
        $getID3 = new getID3;
        $getID3->setOption(array('encoding' => $textEncoding));

        require_once('application/libraries/getid3/write.php');
        
        $data = array();
        $data['track'] = $this->musique_model->get_morceau_single($track_id);
        $data['albums'] = $this->musique_model->get_list_album($uid);
        
        $this->form_validation->set_rules('titre', 'Titre', 'trim|clean_xss|required');
        $this->form_validation->set_rules('artiste', 'Artiste', 'trim|clean_xss|required');
        $this->form_validation->set_rules('piste', 'Piste', 'trim|clean_xss|numeric');
        $this->form_validation->set_rules('annee', 'Année', 'trim|clean_xss|exact_length[4]|numeric');
        $this->form_validation->set_rules('genre', 'Genre', 'trim|clean_xss');
        $this->form_validation->set_rules('prix', 'Prix', 'trim|clean_xss|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('musique/edit_musique', $data);
        } else {
            $upload_folder = '';
            $alb = $data['track']->title_alb;            
            $str_album = str_replace(' ', '_', strtolower($alb));
            if (!empty($data['track']->title_alb)) {
                $upload_folder = 'files/' . $uid . '/musique/' . $str_album . '/';
            } else {
                $upload_folder = 'files/' . $uid . '/musique/';
            }
            
            $title  = $this->input->post('titre');
            $artist = $this->input->post('artiste');
            $album  = $this->input->post('album');
            $year   = $this->input->post('annee');
            $genre  = $this->input->post('genre');
            $piste  = $this->input->post('piste');
            $price  = $this->input->post('prix');
            
            if($album == 0){
                $album = NULL;
            }
            
            $userfile_name = $data['track']->filename;
            $dir_userfile = $upload_folder . $userfile_name;
            
            if(!empty($userfile_name) && file_exists($upload_folder) && file_exists($dir_userfile)){
                $id3_write = new getid3_writetags;
                $id3_write->filename = $dir_userfile;
                $id3_write->tagformats = array('id3v2.3');
                $id3_write->overwrite_tags = true;
                $id3_write->tag_encoding = $textEncoding;
                $id3_write->remove_other_tags = false;
                
                $tagData = array(
                    'title'         => array($title),
                    'artist'        => array($artist),
                    'album'         => array($album),
                    'year'          => array($year),
                    'genre'         => array($genre),
                    'track'         => array($piste),
                );
                $id3_write->tag_data = $tagData;
                
                if ($id3_write->WriteTags()) {
//                    print_r($this->getid3->analyze($dir_userfile));
                    $data['success'] = 'Modification réalisée avec succès.';
                    if (!empty($id3_write->warnings)) {
                        $data['warning'] = 'Avertissement :<br>'.implode('<br><br>', $id3_write->warnings);
                    }
                } else {
                    $data['failed'] = 'Echec de la modification :<br>'.implode('<br><br>', $id3_write->errors);
                }

                $this->musique_model->update_music($track_id, $album, $title, $piste, $artist, $genre, $year, $price);
                
                $data['track'] = $this->musique_model->get_morceau_single($track_id);
            } else {
                $data['error'] = 'Le fichier n\'a pas été trouvé sur Slyset, le chemin est cassé ou le fichier a été supprimé.';
            }
            
            $this->load->view('musique/edit_musique', $data);
        }
    }

    public function delete_playlist($playlist_name) {
        $user_id = $this->session->userdata('uid');
        if ($this->input->post("delete")) {
            $this->musique_model->delete_playlist_data($playlist_name, $user_id);
            $data_succes['status'] = 'supprimé';
            $this->load->view('playlist/sucess-playlist', $data_succes);
        } else {
            $this->load->view('playlist/suppression_playlist');
        }
    }

}
