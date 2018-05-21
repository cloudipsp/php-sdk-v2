<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once '../configuration.php';
require_once SDK_ROOTPATH . '../../vendor/autoload.php';


//Payment token for js scheme B(host-to-host)
try {
    //Minimal data set, all other required params will generated automatically
    $data = [
        'currency' => 'USD',
        'amount' => 1000, // convert to 10.00$
        'order_id' => time(),
        'order_desc' => 'test description'
    ];
    //Call method to generate token
    $token = Fondy\Checkout::token($data);
    //getting returned data
    ?>
    <!doctype html>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Getting Token</title>
        <style>
            table tr td, table tr th {
                padding: 10px;
            }
        </style>
    </head>
    <body>
    <table style="margin: auto" border="1">
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
            <td>Respose status:</td>
            <td><?= $token->getData()['response_status'] ?></td>
        </tr>
        <tr>
            <td>Respose token:</td>
            <td><?= $token->getData()['token'] ?></td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
    <?php
} catch (\Exception $e) {
    echo "Fail: " . $e->getMessage();
}