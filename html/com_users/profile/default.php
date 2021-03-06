<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div class="profile<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
    <?php endif; ?>
    <h1><?php echo JText::_('COM_USERS_PROFILE_MY_PROFILE'); ?></h1>
	<?php echo $this->loadTemplate('core'); ?>
	<?php echo $this->loadTemplate('params'); ?>
	<?php echo $this->loadTemplate('custom'); ?>
	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
        <div class="btn-group mt-6">
            <a class="btn btn-icon btn-primary" data-icon="&#xe08a;" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id); ?>">
                <!--<span class="icon-user"></span>-->
                <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
            </a>
        </div>
	<?php endif; ?>
</div>
