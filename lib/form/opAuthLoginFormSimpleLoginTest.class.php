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
  public static $ids;

  public function configure()
  {
    $this->getMembers($this->getOption('max', false));

    $this->setWidget('member_id', new sfWidgetFormSelect(array('choices' => $this->members)));
    $this->validatorSchema['member_id'] = new sfValidatorChoice(array('choices' => array_keys($this->members)));
    $this->mergePostValidator(
      new opAuthValidatorMemberId(array('field_name' => 'member_id'))
    );
    parent::configure();
  }

  protected function getMembers($limit = false)
  {
    $q = Doctrine::getTable('Member')
      ->createQuery()
      ->select('id')
      ->addSelect('name');

    if (self::$ids)
    {
      $q->whereIn('id', self::$ids);
    }

    if ($limit)
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
