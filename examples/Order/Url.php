<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once '../configuration.php';
require_once SDK_ROOTPATH . '../../vendor/autoload.php';


//Payment url scheme B(host-to-host)
try {
    //Minimal data set, all other required params will generated automatically
    $data = [
        'currency' => 'USD',
        'amount' => 1000 // convert to 10.00$
    ];
    $dataBig = [
        'order_desc' => 'tests SDK',
        'currency' => 'USD',
        'amount' => 1000,
        'default_payment_system' => 'card',
        'response_url' => 'http://site.com/responseurl',
        'server_callback_url' => 'http://site.com/callbackurl',
        'payment_systems' => 'qiwi,yandex,webmoney,card,p24',
        'preauth' => 'N',
        'sender_email' => 'tests@fondy.eu',
        'delayed' => 'Y',
        'lang' => 'ru',
        'product_id' => 'some_product_id',
        'required_rectoken' => 'N',
        'lifetime' => 36000,
        'verification' => 'N',
        'subscription' => 'N',
        'merchant_data' => array(
            'custom_field1' => 'Some string',
            'custom_field2' => '2222',
            'custom_field3' => '3!@#$%^&(()_+?"}',
            'custom_field4' => ['custom_field4_test', 'custom_field4_test2', 'custom_field4_test3' => ['custom_field4_test3_33' => 'custom_field4_test3_33']]
        )
    ];
    //Call method to generate url
    $url = Fondy\Checkout::url($data);
    $urlBig = Fondy\Checkout::url($dataBig);
    //getting returned data
    ?>
    <!doctype html>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Getting Url</title>
        <style>
            table tr td, table tr th {
                padding: 10px;
            }
        </style>
    </head>
    <body>
    <table style="margin: auto;" border="1">
        <thead>
        <tr>
            <th style="text-align: center" colspan="2">Request Data</th>
        </tr>
        <tr>
            <th style="text-align: left"
                colspan="2"><?php printf("<pre>%s</pre>", json_encode(['request' => $data], JSON_PRETTY_PRINT)) ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Respose status</td>
            <td><?= $url->getData()['response_status'] ?></td>
        </tr>
        <tr>
            <td>Respose url</td>
            <td><a href="<?= $url->getUrl() ?>"><?= $url->getUrl() ?></a></td>
        </tr>
        </tbody>
    </table>
    <table style="margin: auto;" border="1">
        <thead>
        <tr>
            <th style="text-align: center" colspan="2">Request Data</th>
        </tr>
        <tr>
            <th style="text-align: left"
                colspan="2"><?php printf("<pre>%s</pre>", json_encode(['request' => $dataBig], JSON_PRETTY_PRINT)) ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Respose status</td>
            <td><?= $url->getData()['response_status'] ?></td>
        </tr>
        <tr>
            <td>Respose url</td>
            <td><a href="<?= $urlBig->getUrl() ?>"><?= $urlBig->getUrl() ?></a></td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
    <?php
} catch (\Exception $e) {
    echo "Fail: " . $e->getMessage();
}