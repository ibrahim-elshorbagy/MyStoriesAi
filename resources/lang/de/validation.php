<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */


    'accepted' => ':attribute muss akzeptiert werden.',
    'active_url' => ':attribute ist keine gültige URL.',
    'after' => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal' => ':attribute muss ein Datum nach oder gleich dem :date sein.',
    'alpha' => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => ':attribute muss ein Array sein.',
    'before' => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal' => ':attribute muss ein Datum vor oder gleich dem :date sein.',
    'between' => [
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'file' => ':attribute muss zwischen :min und :max Kilobyte groß sein.',
        'string' => ':attribute muss zwischen :min und :max Zeichen lang sein.',
        'array' => ':attribute muss zwischen :min und :max Elemente haben.',
    ],
    'boolean' => ':attribute Feld muss wahr oder falsch sein.',
    'confirmed' => ':attribute Bestätigung stimmt nicht überein.',
    'date' => ':attribute ist kein gültiges Datum.',
    'date_equals' => ':attribute muss ein Datum gleich dem :date sein.',
    'date_format' => ':attribute entspricht nicht dem Format :format.',
    'different' => ':attribute und :other müssen unterschiedlich sein.',
    'digits' => ':attribute muss :digits Ziffern haben.',
    'digits_between' => ':attribute muss zwischen :min und :max Ziffern haben.',
    'dimensions' => ':attribute hat ungültige Bildabmessungen.',
    'distinct' => ':attribute Feld hat einen doppelten Wert.',
    'email' => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => ':attribute muss mit einem der folgenden Werte enden: :values',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'filled' => ':attribute Feld muss einen Wert haben.',
    'gt' => [
        'numeric' => ':attribute muss größer als :value sein.',
        'file' => ':attribute muss größer als :value Kilobyte sein.',
        'string' => ':attribute muss mehr als :value Zeichen haben.',
        'array' => ':attribute muss mehr als :value Elemente haben.',
    ],
    'gte' => [
        'numeric' => ':attribute muss größer oder gleich :value sein.',
        'file' => ':attribute muss mindestens :value Kilobyte groß sein.',
        'string' => ':attribute muss mindestens :value Zeichen lang sein.',
        'array' => ':attribute muss mindestens :value Elemente haben.',
    ],
    'image' => ':attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'in_array' => ':attribute Feld existiert nicht in :other.',
    'integer' => ':attribute muss eine Ganzzahl sein.',
    'ip' => ':attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json' => ':attribute muss eine gültige JSON-Zeichenkette sein.',
    'lt' => [
        'numeric' => ':attribute muss kleiner als :value sein.',
        'file' => ':attribute muss kleiner als :value Kilobyte sein.',
        'string' => ':attribute muss weniger als :value Zeichen haben.',
        'array' => ':attribute muss weniger als :value Elemente haben.',
    ],
    'lte' => [
        'numeric' => ':attribute muss kleiner oder gleich :value sein.',
        'file' => ':attribute darf nicht größer als :value Kilobyte sein.',
        'string' => ':attribute darf nicht mehr als :value Zeichen haben.',
        'array' => ':attribute darf nicht mehr als :value Elemente haben.',
    ],
    'max' => [
        'numeric' => ':attribute darf nicht größer als :max sein.',
        'file' => ':attribute darf nicht größer als :max Kilobyte sein.',
        'string' => ':attribute darf nicht mehr als :max Zeichen haben.',
        'array' => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes' => ':attribute muss eine Datei vom Typ: :values sein.',
    'mimetypes' => ':attribute muss eine Datei vom Typ: :values sein.',
    'min' => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file' => ':attribute muss mindestens :min Kilobyte groß sein.',
        'string' => ':attribute muss mindestens :min Zeichen lang sein.',
        'array' => ':attribute muss mindestens :min Elemente haben.',
    ],
    'not_in' => 'Das ausgewählte :attribute ist ungültig.',
    'not_regex' => 'Das :attribute Format ist ungültig.',
    'numeric' => ':attribute muss eine Zahl sein.',
    'password' => 'Das Passwort ist falsch.',
    'present' => ':attribute Feld muss vorhanden sein.',
    'regex' => 'Das :attribute Format ist ungültig.',
    'required' => ':attribute Feld ist erforderlich.',
    'required_if' => ':attribute Feld ist erforderlich, wenn :other :value ist.',
    'required_unless' => ':attribute Feld ist erforderlich, es sei denn, :other ist in :values.',
    'required_with' => ':attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all' => ':attribute Feld ist erforderlich, wenn :values vorhanden sind.',
    'required_without' => ':attribute Feld ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute Feld ist erforderlich, wenn keiner der :values vorhanden ist.',
    'same' => ':attribute und :other müssen übereinstimmen.',
    'size' => [
        'numeric' => ':attribute muss :size sein.',
        'file' => ':attribute muss :size Kilobyte groß sein.',
        'string' => ':attribute muss :size Zeichen lang sein.',
        'array' => ':attribute muss :size Elemente enthalten.',
    ],
    'starts_with' => ':attribute muss mit einem der folgenden Werte beginnen: :values',
    'string' => ':attribute muss eine Zeichenkette sein.',
    'timezone' => ':attribute muss eine gültige Zeitzone sein.',
    'unique' => ':attribute ist bereits vergeben.',
    'uploaded' => ':attribute konnte nicht hochgeladen werden.',
    'url' => ':attribute muss eine gültige URL sein.',
    'uuid' => ':attribute muss eine gültige UUID sein.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */


    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */


    'current_password' => 'Das Passwort ist falsch.',


    'attributes' => [
        'name' => 'Name',
        'username' => 'Benutzername',
        'email' => 'E-Mail',
        'first_name' => 'Vorname',
        'last_name' => 'Nachname',
        'password' => 'Passwort',
        'password_confirmation' => 'Passwortbestätigung',
        'city' => 'Stadt',
        'country' => 'Land',
        'address' => 'Adresse',
        'phone' => 'Telefon',
        'mobile' => 'Mobiltelefon',
        'age' => 'Alter',
        'sex' => 'Geschlecht',
        'gender' => 'Geschlecht',
        'day' => 'Tag',
        'month' => 'Monat',
        'year' => 'Jahr',
        'hour' => 'Stunde',
        'minute' => 'Minute',
        'second' => 'Sekunde',
        'title' => 'Titel',
        'content' => 'Inhalt',
        'description' => 'Beschreibung',
        'excerpt' => 'Auszug',
        'date' => 'Datum',
        'time' => 'Zeit',
        'available' => 'Verfügbar',
        'size' => 'Größe',
        'role' => 'Rolle',
        'user_name' => 'Benutzername',
        'current_password' => 'Aktuelles Passwort',


        // Plan validation attributes
        'price' => 'Preis',
        'features' => 'Funktionen',
        'features.*.id' => 'Funktions-ID',
        'features.*.limit_value' => 'Grenzwert',
        'feature_setting' => 'Funktionseinstellung',
        'feature_access' => 'Zugriff',
        'feature_usage' => 'Nutzung',
        'enabled' => 'Aktiviert',
        'disabled' => 'Deaktiviert',


        'content_en' => 'Inhalt auf Englisch',
        'content_de' => 'Inhalt auf Deutsch',
        'content_ar' => 'Inhalt auf Arabisch',
        'excerpt_ar' => 'Auszug auf Arabisch',
        'excerpt_en' => 'Auszug auf Englisch',
        'title_ar' => 'Titel auf Arabisch',
        'title_en' => 'Titel auf Englisch',
        'title_de' => 'Titel auf Deutsch',
    'excerpt_de' => 'Auszug auf Deutsch',
    'content_de' => 'Inhalt auf Deutsch',
        'question_ar' => 'Frage (Arabisch)',
        'question_en' => 'Frage (Englisch)',
        'question_de' => 'Frage (Deutsch)',
        'answer_ar' => 'Antwort (Arabisch)',
        'answer_en' => 'Antwort (Englisch)',
        'answer_de' => 'Antwort (Deutsch)',
        'category_id' => 'Kategorie',
        'image' => 'Bild',
    'cover_image_de' => 'Titelbild (Deutsch)',
    'gallery_images_de' => 'Galeriebilder (Deutsch)',
    'pdf_de' => 'PDF (Deutsch)',
    'name_de' => 'Kategoriename Deutsch',
    'city_de' => 'Stadt (Deutsch)',


        // Order validation attributes
        'child_name' => 'Name des Kindes',
        'child_age' => 'Alter des Kindes',
        'language' => 'Sprache',
        'child_gender' => 'Geschlecht des Kindes',
        'format' => 'Format',
        'value' => 'Wert',
        'value.*' => 'Wert',
        'custom_value' => 'Benutzerdefinierter Wert',
        'child_image' => 'Bild des Kindes',
        'child_image_base64' => 'Bild des Kindes',
        'hair_color' => 'Haarfarbe',
        'hair_style' => 'Frisur',
        'eye_color' => 'Augenfarbe',
        'skin_tone' => 'Hautton',
        'clothing_description' => 'Kleidungsbeschreibung',
        'customer_note' => 'Notizen',
        'customer_feedback' => 'Kundenfeedback',
        'image' => 'Bild',
        'delivery_option_id' => 'Lieferoption',


    ],
];
