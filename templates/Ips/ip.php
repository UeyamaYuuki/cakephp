<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'watchyou';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home', 'ip']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('jquery-3.5.1.min.js'); ?>
    <?= $this->Html->script('ip') ?>
</head>

<body>
    <header>
        <div class="container text-center">
            <h1>
                WATCH YOU 👀
            </h1>
            <?= 'あなたのIPアドレス検索ツール' ?>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <table>
                            <tr>
                                <th>内容</td>
                                <th>値</td>
                            </tr>
                            <tr>
                                <td>IP</th>
                                <td id="ipAdress"><?= $yourIp ?></td>
                            </tr>
                        </table>
                        <br>
                        <?= $this->Form->button('保存', array(
                            'onClick' => "saveIp()",
                            'class' => "btn-save"
                        )) ?>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <table>
                            <tr>
                                <th>ip</th>
                                <th>作成日時</th>
                            </tr>

                            <!-- ここで、$articles クエリーオブジェクトを繰り返して、記事の情報を出力します -->

                            <?php foreach ($ipArr as $ip) : ?>
                                <tr>
                                    <td>
                                        <?= $ip->ip ?>
                                    </td>
                                    <td>
                                        <?php
                                        $time = $ip->created;
                                        $time->setTimeZone(new DateTimeZone('Asia/Tokyo'));
                                        echo $time->format('Y-m-d H:i:s');
                                        ?>
                                    </td>
                                    <td>
                                        <?= $this->Form->button('編集', array(
                                            'onClick' => "editIp()",
                                            'class' => "btn-edit"
                                        )) ?>
                                        <?= $this->Form->button('削除', array(
                                            'onClick' => "deleteIp($ip->id)",
                                            'class' => "btn-delete"
                                        )) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

            </div>
    </main>
</body>

</html>