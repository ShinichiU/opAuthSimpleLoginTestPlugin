<div id="sidemenuLogin" class="loginForm">
<?php echo $form->renderFormTag(url_for('member/login?authMode=SimpleLoginTest')) ?>
<table>
<tr><td>
<?php echo $form['member_id']->renderLabel() ?>:
<?php echo $form['member_id']->render(array('onchange' => 'submit(this.form)')) ?>
<?php echo $form->renderHiddenFields() ?>
</td></tr>
</table>
</form>
<form action="." method="get">
<table>
<tr>
<td>
ID Max: <?php echo $searchForm['id_max']->render(array('size' => 3)) ?>
</td>
<td>
ID Min: <?php echo $searchForm['id_min']->render(array('size' => 3)) ?>
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" class="input_submit" value="<?php echo __('Send') ?>" />
</td>
</tr>
</table>
</form>
</div>
