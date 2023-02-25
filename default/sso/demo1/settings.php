<?php

$spBaseUrl = 'https://sso.nasirhafeez.com/guest/s/default'; //or http://<your_domain>
echo

$settingsInfo = array(
    'sp' => array(
        'entityId' => $spBaseUrl . '/sso/demo1/metadata.php',
        'assertionConsumerService' => array(
            'url' => $spBaseUrl . '/sso/demo1/index.php?acs',
        ),
        'singleLogoutService' => array(
            'url' => $spBaseUrl . '/sso/demo1/index.php?sls',
        ),
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
    ),
    'idp' => array(
        'entityId' => 'https://accounts.google.com/o/saml2?idpid=C03wnohn9',
        'singleSignOnService' => array(
            'url' => 'https://accounts.google.com/o/saml2/idp?idpid=C03wnohn9',
        ),
        'singleLogoutService' => array(
            'url' => '',
        ),
        'x509cert' => '',
    ),
);
