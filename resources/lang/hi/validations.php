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
    'captcha' => 'कैप्चा कोड सही नहीं है। कृपया फिर से प्रयास करें।',
    'accepted' => ':attribute को स्वीकृत करना आवश्यक है।',
    'active_url' => ':attribute मान्य URL नहीं है।',
    'after' => ':attribute :date के बाद की तिथि होनी चाहिए।',
    'after_or_equal' => ':attribute :date के बाद या उसी के बराबर की तिथि होनी चाहिए।',
    'alpha' => ':attribute केवल वर्णमाला में हो सकता है।',
    'alpha_dash' => ':attribute केवल वर्णमाला, अंक, डैश और अंडरस्कोर में हो सकता है।',
    'alpha_num' => ':attribute केवल वर्णमाला और अंक में हो सकता है।',
    'array' => ':attribute एक सरणी होनी चाहिए।',
    'before' => ':attribute :date से पहले की तिथि होनी चाहिए।',
    'before_or_equal' => ':attribute :date से पहले या उसी के बराबर की तिथि होनी चाहिए।',
    'between' => [
        'numeric' => ':attribute :min और :max के बीच होनी चाहिए।',
        'file' => ':attribute :min और :max किलोबाइट के बीच होनी चाहिए।',
        'string' => ':attribute :min और :max वर्णों के बीच होनी चाहिए।',
        'array' => ':attribute में :min और :max वस्तुएं होनी चाहिए।',
    ],
    'boolean' => ':attribute फ़ील्ड को सत्य या असत्य होना चाहिए।',
    'confirmed' => ':attribute पुष्टिकरण मेल नहीं खाता।',
    'date' => ':attribute मान्य तिथि नहीं है।',
    'date_equals' => ':attribute :date के बराबर की तिथि होनी चाहिए।',
    'date_format' => ':attribute स्वरूप :format से मेल नहीं खाता।',
    'different' => ':attribute और :other भिन्न होने चाहिए।',
    'digits' => ':attribute :digits अंकों का होना चाहिए।',
    'digits_between' => ':attribute :min और :max अंकों के बीच होना चाहिए।',
    'dimensions' => ':attribute में अमान्य छवि आयाम हैं।',
    'distinct' => ':attribute फ़ील्ड में एक डुप्लिकेट मान है।',
    'email' => ':attribute मान्य ईमेल पते होना चाहिए।',
    'ends_with' => ':attribute निम्नलिखित में से एक के साथ समाप्त होना चाहिए: :values।',
    'exists' => 'चयनित :attribute अमान्य है।',
    'file' => ':attribute एक फ़ाइल होनी चाहिए।',
    'filled' => ':attribute फ़ील्ड में मान होना आवश्यक है।',
    'gt' => [
        'numeric' => ':attribute :value से अधिक होना चाहिए।',
        'file' => ':attribute :value किलोबाइट से अधिक होना चाहिए।',
        'string' => ':attribute :value वर्णों से अधिक होना चाहिए।',
        'array' => ':attribute में :value से अधिक आइटम होनी चाहिए।',
    ],
    'gte' => [
        'numeric' => ':attribute :value से अधिक या बराबर होना चाहिए।',
        'file' => ':attribute :value किलोबाइट से अधिक या बराबर होना चाहिए।',
        'string' => ':attribute :value वर्णों से अधिक या बराबर होना चाहिए।',
        'array' => ':attribute में :value आइटम या अधिक होना चाहिए।',
    ],
    'image' => ':attribute एक छवि होनी चाहिए।',
    'in' => 'चयनित :attribute अमान्य है।',
    'in_array' => ':attribute फ़ील्ड :other में मौजूद नहीं है।',
    'integer' => ':attribute एक पूर्णांक होना चाहिए।',
    'ip' => ':attribute मान्य आईपी पता होना चाहिए।',
    'ipv4' => ':attribute मान्य IPv4 पता होना चाहिए।',
    'ipv6' => ':attribute मान्य IPv6 पता होना चाहिए।',
    'json' => ':attribute एक मान्य JSON स्ट्रिंग होना चाहिए।',
    'lt' => [
        'numeric' => ':attribute :value से कम होना चाहिए।',
        'file' => ':attribute :value किलोबाइट से कम होना चाहिए।',
        'string' => ':attribute :value वर्णों से कम होना चाहिए।',
        'array' => ':attribute में :value से कम आइटम होनी चाहिए।',
    ],
    'lte' => [
        'numeric' => ':attribute :value से कम या बराबर होना चाहिए।',
        'file' => ':attribute :value किलोबाइट से कम या बराबर होना चाहिए।',
        'string' => ':attribute :value वर्णों से कम या बराबर होना चाहिए।',
        'array' => ':attribute में :value आइटम से अधिक नहीं होनी चाहिए।',
    ],
    'max' => [
        'numeric' => ':attribute :max से अधिक नहीं हो सकता।',
        'file' => ':attribute :max किलोबाइट से अधिक नहीं हो सकता।',
        'string' => ':attribute :max वर्णों से अधिक नहीं हो सकता।',
        'array' => ':attribute :max आइटम से अधिक नहीं हो सकता।',
    ],
    'mimes' => ':attribute प्रकार के फ़ाइलों की निम्नलिखित में से होनी चाहिए: :values।',
    'mimetypes' => ':attribute प्रकार के फ़ाइलों की निम्नलिखित में से होनी चाहिए: :values।',
    'min' => [
        'numeric' => ':attribute कम से कम :min होना चाहिए।',
        'file' => ':attribute कम से कम :min किलोबाइट होना चाहिए।',
        'string' => ':attribute कम से कम :min वर्ण होना चाहिए।',
        'array' => ':attribute कम से कम :min आइटम होने चाहिए।',
    ],
    'multiple_of' => ':attribute :value का गुणांक होना चाहिए।',
    'not_in' => 'चयनित :attribute अमान्य है।',
    'not_regex' => ':attribute स्वरूप अमान्य है।',
    'numeric' => ':attribute एक अंक होना चाहिए।',
    'password' => 'पासवर्ड गलत है।',
    'present' => ':attribute फ़ील्ड को प्रस्तुत होना चाहिए।',
    'regex' => ':attribute स्वरूप अमान्य है।',
    'required' => ':attribute फ़ील्ड अनिवार्य है।',
    'required_if' => ':attribute फ़ील्ड आवश्यक है जब :other :value होता है।',
    'required_unless' => ':attribute फ़ील्ड आवश्यक है जब :other :values में नहीं है।',
    'required_with' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद है।',
    'required_with_all' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद हैं।',
    'required_without' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद नहीं हैं।',
    'required_without_all' => ':attribute फ़ील्ड आवश्यक है जब :values में कोई भी मौजूद नहीं है।',
    'same' => ':attribute और :other को मेल खाना चाहिए।',
    'size' => [
        'numeric' => ':attribute :size का होना चाहिए।',
        'file' => ':attribute :size किलोबाइट का होना चाहिए।',
        'string' => ':attribute :size वर्णों का होना चाहिए।',
        'array' => ':attribute में :size आइटम होने चाहिए।',
    ],
    'starts_with' => ':attribute निम्नलिखित में से एक के साथ प्रारंभ होना चाहिए: :values।',
    'string' => ':attribute एक स्ट्रिंग होना चाहिए।',
    'timezone' => ':attribute एक मान्य क्षेत्र होना चाहिए।',
    'unique' => ':attribute पहले ही लिया जा चुका है।',
    'uploaded' => ':attribute को अपलोड करने में असमर्थ।',
    'url' => ':attribute स्वरूप अमान्य है।',
    'uuid' => ':attribute एक मान्य UUID होना चाहिए।',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];