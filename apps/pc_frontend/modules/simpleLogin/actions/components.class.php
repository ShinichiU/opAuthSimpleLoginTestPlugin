<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * simpleLogin components.
 *
 * @package    OpenPNE
 * @subpackage diary
 * @author     Rimpei Ogawa <ogawa@tejimaya.com>
 */
class simpleLoginComponents extends sfComponents
{
  public function executeForm($request)
  {
    $this->searchForm = new SimpleLoginMemberSearchForm();
    $params = $request->getParameter($this->searchForm->getName(), array());
    $this->searchForm->bind($params);

    $adapter = new opAuthAdapterSimpleLoginTest('SimpleLoginTest');
    if ($params)
    {
      $this->searchForm->setIdsToAuthForm();
    }
    $this->form = $adapter->getAuthForm();
    $this->form->setDefault('member_id', $this->getUser()->getMemberId());
  }
}
