<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * SimpleLoginMemberSearchForm
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class SimpleLoginMemberSearchForm extends BaseForm
{
  public function __construct($defaults = array(), $options = array())
  {
    parent::__construct($defaults, $options, false);
  }

  public function configure()
  {
    $widgets = array('id_min' => new sfWidgetFormInputText(), 'id_max' => new sfWidgetFormInputText());
    $validators = array('id_min' => new sfValidatorInteger(array('required' => false)), 'id_max' => new sfValidatorInteger(array('required' => false)));

    $this->setWidgets($widgets);
    $this->setValidators($validators);

    $this->widgetSchema->setNameFormat('simple_login_test_search[%s]');
  }

  public function setIdsToAuthForm()
  {
    $q = Doctrine::getTable('Member')->createQuery();
    $q->select('id')->where(1);
    $id_min = $this->getValue('id_min');
    $id_max = $this->getValue('id_max');

    if ($id_min || $id_max)
    {
      if ($id_min)
      {
        $q->andWhere('id >= ?', (int)$id_min);
      }
      if ($id_max)
      {
        $q->andWhere('id <= ?', (int)$id_max);
      }

      $ids = $q->execute(array(), Doctrine::HYDRATE_NONE);
      foreach ($ids as &$result)
      {
        $result = $result[0];
      }

      opAuthLoginFormSimpleLoginTest::$ids = count($ids) ? $ids : null;
    }
  }
}
