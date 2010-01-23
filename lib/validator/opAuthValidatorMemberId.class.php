<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opAuthValidatorMemberId
 *
 * @package    OpenPNE
 * @subpackage validator
 * @author     Shinichi Urabe <ebihara@tejimaya.com>
 */
class opAuthValidatorMemberId extends sfValidatorSchema
{
  /**
   * Constructor.
   *
   * @param array  $options   An array of options
   * @param array  $messages  An array of error messages
   *
   * @see sfValidatorSchema
   */
  public function __construct($options = array(), $messages = array())
  {
    parent::__construct(null, $options, $messages);
  }

  /**
   * Configures this validator.
   *
   * Available options:
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->addOption('field_name');
    $this->setMessage('invalid', 'ID is not a valid.');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    opActivateBehavior::disable();
    $member = Doctrine::getTable('Member')->find($values[$this->getOption('field_name')]);
    if ($member)
    {
      $values['member'] = $member;
    }
    opActivateBehavior::enable();

    return $values;
  }
}
