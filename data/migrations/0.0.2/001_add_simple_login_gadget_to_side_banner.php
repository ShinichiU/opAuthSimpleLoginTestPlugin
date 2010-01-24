<?php

class Revision15_addSimpleLoginGadgetToSideBanner extends Doctrine_Migration_Base
{
  public function migrate()
  {
    $gadget = new Gadget();
    $gadget->setType('sideBannerContents');
    $gadget->setName('authMemberList');
    $gadget->save();
  }
}
