<?php

class I18n {

    public static function get($message) {
        $language = filter_imput(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE');
        $langue = $language ? mb_substr($language, 0, 2) : 'en';
    }

    const MESSAGE = [
        'fr' => [
            UPLOAD_ERR_INI_SIZE => "Fchier trop lourd. (côté serveur).",
            UPLOAD_ERR_FORM_SIZE => "Fichier trop lourd (côté client).",
            UPLOAD_ERR_PARTIAL => "Fichier partiellement uploadé.",
            UPLOAD_ERR_NO_FILE => "Aucun fichier présent.",
            UPLOAD_ERR_NO_TMP_DIR => "Dossier temporaire inexistant.",
            'UPLOAD_ERR_POST_SIZE' => "Fichier trop lourd (post).",
            'UPLOAD_ERR_WRONG_EXTENSION' => "Extension fichier incorrect.",
            'UPLOAD_ERR_WRONG_TYPE' => "Type MIME invalide.",
            'UPLOAD_ERR_WRONG_EMPTY_FILE' => "Fichier vide."
        ],
        'en' => [
            UPLOAD_ERR_INI_SIZE => "File too big (server side).",
            UPLOAD_ERR_FORM_SIZE => "File too big( side).",
            UPLOAD_ERR_PARTIAL => "Partially uploaded file.",
            UPLOAD_ERR_NO_FILE => "No file.",
            UPLOAD_ERR_NO_TMP_DIR => "Non-existent temporary file.",
        ],
        'ab' => [
            UPLOAD_ERR_INI_SIZE => ""
        ]
    ];

}
