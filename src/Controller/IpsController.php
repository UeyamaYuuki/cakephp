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
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class IpsController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function index(string ...$path): ?Response
    {
        $yourIp = $this->request->clientIp();
        if (!isset($yourIp)) {
            $yourIp = '不明';
        }
        $this->loadComponent('Paginator');
        $ipArr = $this->Paginator->paginate($this->Ips->find());
        $this->set(compact('yourIp', 'ipArr'));

        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
    public function add()
    {
        $this->autoRender = false;

        // $this->request->is('ajax') でAjax通信か判定する
        $saveArr = [];
        if ($this->request->is('ajax')) {
            $post_data = implode($this->request->getData());
            $saveArr['ip'] = $post_data;
            $ip = $this->Ips->newEmptyEntity();
            $ip = $this->Ips->patchEntity($ip, $saveArr);
            $this->Ips->save($ip);
        }
    }
    public function delete()
    {

        $this->autoRender = false;

        // $this->request->is('ajax') でAjax通信か判定する
        if ($this->request->is('ajax')) {
            $this->request->allowMethod(['post', 'delete']);
            $post_data = implode($this->request->getData());
            $ips = $this->Ips->get($post_data);
            $this->log($post_data);
            $this->Ips->delete($ips);
        }
    }
}