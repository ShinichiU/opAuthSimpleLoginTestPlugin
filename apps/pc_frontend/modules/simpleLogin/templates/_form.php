<?
$form->getWidget('member_id')->setAttribute('onchange', 'submit(this.form); return false;');
$searchForm->getWidget('id_min')->setAttribute('style', 'width: 50px;');
$searchForm->getWidget('id_max')->setAttribute('style', 'width: 50px;');
?>
<div id="sidemenuLogin" class="loginForm">
<form action="<?php echo url_for('member/login?authMode=SimpleLoginTest') ?>" method="post">
<table>
<?php echo $form ?>
</table>
</form>
<form action="." method="get">
<table>
<?php echo $searchForm ?>
<tr>
<td colspan="2">
<input type="submit" class="input_submit" value="<?php echo __('Send') ?>" />
</td>
</tr>
</table>
</form>
</div>
