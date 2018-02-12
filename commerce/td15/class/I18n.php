<?php
require_once 'class/Image.php';
class I18n {

    public static function get($message) {
        $language = filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE');
        $langue = $language ? mb_substr($language, 0, 2) : 'en';
        if (isset(self::MESSAGE[$langue][$message])) {
            return self::MESSAGE[$langue][$message];
        }
        if($langue !== 'en' && isset(self::MESSAGE['en'][$message])){
            return self::MESSAGE['en'][$message];
        }
        return null;
    }

    const MESSAGE = [
        'fr' => [
            'DB_ERR_BAS_REQUEST'=>"Requête SQL incorrecte",
            'DB_ERR_DSN_ALREADY_DEFINED'=>"Connexion DSN déjà encours",
            'DB_ERR_CONNEXION_FAILED'=>"Echec de la connexion",
            'DB_ERR_DSN_UNDEFINED'=> "Le DSN est indéfini",
            'IMAGE_ERR_NO_IMAGE_FOUND'=> "Aucune image trouvée",
            'IMAGE_ERR_WRONG_IMAGE_TYPE'=> "Type image invalide",
            'IMAGE_ERR_CANT_WRITE'=> "Enregistrement image impossible",
            'IMAGE_ERR_OUT_OF_MEMORY'=> "Mémoire insuffisante",
            UPLOAD_ERR_INI_SIZE => "Fchier trop lourd. (côté serveur).",
            UPLOAD_ERR_FORM_SIZE => "Fichier trop lourd (côté client).",
            UPLOAD_ERR_PARTIAL => "Fichier partiellement uploadé.",
            UPLOAD_ERR_NO_FILE => "Aucun fichier présent.",
            UPLOAD_ERR_NO_TMP_DIR => "Dossier temporaire inexistant.",
            'UPLOAD_ERR_WRONG_EXTENSION' => "Extension fichier incorrect.",
            'UPLOAD_ERR_WRONG_TYPE' => "Type MIME invalide.",
            'UPLOAD_ERR_WRONG_EMPTY_FILE' => "Fichier vide.",
            'UPLOAD_ERR_CANT_WRITE' => "Fichier non écrit"
        ],
        'en' => [
            'DB_ERR_BAS_REQUEST'=>"Bad SQL query",
             'DB_ERR_CONNEXION_FAILED'=>"Connexion failed",
            'DB_ERR_DSN_UNDEFINED'=> " DSN undefined",
             'IMAGE_ERR_NO_IMAGE_FOUND'=> "No image found",
            'IMAGE_ERR_WRONG_IMAGE_TYPE'=> "Wrong image type",
            'IMAGE_ERR_CANT_WRITE'=> "Can't write image",
            'IMAGE_ERR_OUT_OF_MEMORY'=> " Out of memory",
            UPLOAD_ERR_INI_SIZE => "File too big (server side).",
            UPLOAD_ERR_FORM_SIZE => "File too big( side).",
            UPLOAD_ERR_PARTIAL => "Partially uploaded file.",
            UPLOAD_ERR_NO_FILE => "No file.",
            UPLOAD_ERR_NO_TMP_DIR => "Non-existent temporary file.",
            'UPLOAD_ERR_WRONG_EXTENSION' => "Wrong file extension.",
            'UPLOAD_ERR_WRONG_TYPE' => "Wrong file type.",
            'UPLOAD_ERR_WRONG_EMPTY_FILE' => "Empty file.",
            'UPLOAD_ERR_CANT_WRITE' => "can't write file."
        ],
        'ar' => [
            UPLOAD_ERR_INI_SIZE => ""
        ]
    ];

}
