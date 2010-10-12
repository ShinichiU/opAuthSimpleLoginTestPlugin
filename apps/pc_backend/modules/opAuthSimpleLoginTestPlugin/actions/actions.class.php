<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opAuthSimpleLoginTestPlugin actions.
 *
 * @package    OpenPNE
 * @subpackage opAuthSimpleLoginTestPlugin
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class opAuthSimpleLoginTestPluginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $adapter = new opAuthAdapterSimpleLoginTest('SimpleLoginTest');
    $this->form = $adapter->getAuthConfigForm();
    if ($request->isMethod(sfWebRequest::POST))
    {
      $this->form->bind($request->getParameter('auth'.$adapter->getAuthModeName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash('notice', '設定を反映しました');
        $this->redirect('opAuthSimpleLoginTestPlugin/index');
      }
      $this->getUser()->setFlash('error', '設定を反映できませんでした');
    }
  }
}
