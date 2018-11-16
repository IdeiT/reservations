<?php
/**
 * @package     Joomla.Site
 * @subpackage  Hummingbird
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="widgetbox widgetbox-gray countdown">
    <h3><?php echo JText::_('MOD_HUMMINGBIRD_COUNTDOWN_SERVICES_TITLE'); ?></h3>
    <p class="font-weight-regular"><?php echo JText::_('MOD_HUMMINGBIRD_COUNTDOWN_EXPLANATION'); ?></p>
    <div id="request-timer-container" class="timer-container">
        <div class="timer-container__title"><?php echo JText::_('MOD_HUMMINGBIRD_COUNTDOWN_REMAINING_TIME'); ?></div>
        <?php echo sprintf($request->workflow->route_requests_explanation, $request->workflow->route_requests_time ); ?>
        <div id="request_timer" class="timer-container__time"><?php echo JText::_('MOD_HUMMINGBIRD_COUNTDOWN_NOT_STARTED'); ?></div>
    </div>
</div>
