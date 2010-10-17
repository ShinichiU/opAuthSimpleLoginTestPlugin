<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opAuthLoginFormSimpleLoginTest represents a form to login by one's Member id.
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class opAuthLoginFormSimpleLoginTest extends opAuthLoginForm
{
  protected $members = array(null => '選択してください');
  public static
    $max,
    $min;

  public function configure()
  {
    $this->getMembers();

    $this->setWidget('member_id', new sfWidgetFormSelect(array('choices' => $this->members)));
    $this->validatorSchema['member_id'] = new sfValidatorChoice(array('choices' => array_keys($this->members)));
    $this->mergePostValidator(
      new opAuthValidatorMemberId(array('field_name' => 'member_id'))
    );
    parent::configure();
  }

  protected function getMembers()
  {
    $q = Doctrine::getTable('Member')
      ->createQuery()
      ->select('id')
      ->addSelect('name')
      ->where(1);

    if (self::$max)
    {
      $q->andWhere('id <= ?', (int)self::$max);
    }
    if (self::$min)
    {
      $q->andWhere('id >= ?', (int)self::$min);
    }

    if ($limit = $this->getAuthAdapter()->getAuthConfig('member_list_limit_for_simple_test'))
    {
      $q->limit((int)$limit);
    }
    $results = $q->execute(array(), Doctrine::HYDRATE_NONE);

    foreach ($results as $result)
    {
      $this->members[$result[0]] = $result[1].'(id:'.$result[0].')';
    }
  }
}
