<? $form->getWidget('member_id')->setAttribute('onchange', 'submit(this.form)'); ?>
<div id="sidemenuLogin" class="loginForm">
<form action="<?php echo url_for('member/login') ?>" method="post">
<table>
<?php echo $form ?>
</table>
</form>
</div>
