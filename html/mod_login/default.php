<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<div class="widgetbox widgetbox-gray mb-12">

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline1">
	<?php if ($params->get('pretext')) : ?>
		<div class="pretext">
			<h3><?php echo $params->get('pretext'); ?></h3>
		</div>
	<?php endif; ?>
	<div class="userdata">
		<div id="form-login-username" class="form-group">
            <?php if (!$params->get('usetext')) : ?>
                <div class="input-prepend">
                    <span class="add-on">
                        <?php /* <span class="icon-user" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>"></span> */ ?>
                        <label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
                    </span>
                    <input id="modlgn-username" type="text" name="username" class="form-control input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
                </div>
            <?php else : ?>
                <label for="modlgn-username" class=""><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
                <input id="modlgn-username" type="text" name="username" class="form-control input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME_PLACEHOLDER'); ?>" />
            <?php endif; ?>
		</div>
		<div id="form-login-password" class="form-group">
            <?php if (!$params->get('usetext')) : ?>
                <div class="input-prepend">
                    <span class="add-on">
                        <?php /* <span class="icon-lock" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"> */ ?>
                        </span>
                            <label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
                        </label>
                    </span>
                    <input id="modlgn-passwd" type="password" name="password" class="form-control input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_PASSWORD_PLACEHOLDER'); ?>" />
                </div>
            <?php else : ?>
                <label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
                <input id="modlgn-passwd" type="password" name="password" class="form-control input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_PASSWORD_PLACEHOLDER'); ?>" />
            <?php endif; ?>
		</div>
		<?php if (count($twofactormethods) > 1) : ?>
		<div id="form-login-secretkey" class="form-group">
			<div class="controls">
				<?php if (!$params->get('usetext')) : ?>
					<div class="input-prepend input-append">
						<span class="add-on">
							<span class="icon-star" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
							</span>
								<label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
							</label>
						</span>
						<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
						<span class="btn width-auto " title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="icon-help"></span>
						</span>
				</div>
				<?php else : ?>
					<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
					<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
					<span class="btn width-auto" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
						<span class="icon-help"></span>
					</span>
				<?php endif; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="form-group form-check">
            <input id="modlgn-remember" type="checkbox" name="remember" class="form-check-input" value="yes"/>
			<label for="modlgn-remember" class="form-check-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?></label>
		</div>
		<?php endif; ?>
		<div id="form-login-submit" class="control-group">
			<div class="controls">
				<button type="submit" tabindex="0" name="Submit" class="btn btn-primary login-button"><?php echo JText::_('MOD_LOGIN_ACCESS'); ?></button>
			</div>
		</div>
		<?php
			$usersConfig = JComponentHelper::getParams('com_users'); ?>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
    <div class="mt-10">
        <ul class="list-peak">
        <?php if ($usersConfig->get('allowUserRegistration')) : ?>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
                <?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
            </li>
        <?php endif; ?>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
                <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
            </li>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
                <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
            </li>
        </ul>
    </div>
</form>
</div>
