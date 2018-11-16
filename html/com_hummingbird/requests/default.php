<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_hummingbird
 *
 * @copyright Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// load tooltip behavior
JHtml::_('behavior.tooltip');

$user = JFactory::getUser();
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/list.php';

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="adminForm" name="adminForm">
                                  
        <h1><?php echo JText::_('COM_HUMMINGBIRD_MYREQUESTS_TITLE');?></h1>
        
        <?php if (count($this->items) > 0) : ?>
             
                <table class="table table-striped">
                        <thead>
                                <tr>
                                        <th width="300">
                                                <?php echo JHtml::_('grid.sort', 'COM_HUMMINGBIRD_DATE', 'a.creation_date', $listDirn, $listOrder); ?>
                                        </th>                                                 
                                        <th width="160" class="center">
                                                <?php echo JHtml::_('grid.sort', 'COM_HUMMINGBIRD_STATUS', 'translated_workflow', $listDirn, $listOrder); ?>
                                        </th>
                                        <th><?php echo JText::_('COM_HUMMINGBIRD_RESOURCES'); ?></th>                                       
                                        <th width="80" style="text-align: right;">
                                                <?php //echo JHtml::_('grid.sort', 'COM_HUMMINGBIRD_PRICES', 'a.price', $listDirn, $listOrder); ?>
                                                <?php echo JText::_('COM_HUMMINGBIRD_PRICES'); ?>
                                        </th>
                                </tr>
                        </thead>
                        <tfoot>
                                <tr>
                                        <td colspan="4"><?php echo $this->pagination->getListFooter(); ?></td>
                                </tr>
                        </tfoot>
                        <tbody>
                                <?php
                                foreach ($this->items as $i => $item):
                                        //var_dump($item);
                                        $edit_link = JRoute::_('index.php?option=com_hummingbird&view=request&id=' . $item->id);    
                                        ?>
                                        <tr class="row<?php echo $i % 2; ?>">
                                                <td class="left">
                                                        <a href="<?php echo $edit_link ?>">
                                                                <?php echo JHtml::_('date', $item->creation_date, JText::_('DATE_FORMAT_LC2')); ?>
                                                        </a>
                                                </td>                                                 
                                                <td class="center">
                                                        <a href="<?php echo $edit_link ?>">
                                                                <?php echo $item->translated_workflow; ?>
                                                        </a>                                                        
                                                        
                                                </td> 
                                                <td>
                                                        <?php if (property_exists($item, 'resources')) : ?>                                                        
                                                        <?php echo implode (", ", $item->resources); ?>
                                                        <?php endif; ?>
                                                </td>
                                                
                                                <td class="center">
                                                        <?php if ($item->prices_visible) : ?>
                                                        <div class="price">
                                                                <?php echo JLayoutHelper::render('currency', $item->price_taxed, null, array ('client' => 1)); ?>                                                                
                                                        </div>
                                                        <?php endif; ?>
                                                </td>                                                 
                                        </tr>
                                <?php endforeach; ?>
                        </tbody>
                </table>                                                                     

        <?php else : ?>
                <div class="alert alert-no-items"><?php echo JText::_('COM_HUMMINGBIRD_MYREQUESTS_EMPTY'); ?></div>    
        <?php endif; ?>                        
               
        <div>        
                <input type="hidden" name="option" value="com_hummingbird" /> 
                <input type="hidden" name="view" value="requests" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
                <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
