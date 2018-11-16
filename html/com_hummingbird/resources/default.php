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
JHtml::_('jquery.framework');

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/list.php';
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/image.php';

$hParams        = $this->hParams;
$user           = JFactory::getUser();
$listOrder      = $this->escape($this->state->get('list.ordering'));
$listDirn       = $this->escape($this->state->get('list.direction'));
?>
<?php if ($hParams->get('display_resourceslist_display_categories_tree', false)): ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var $treeview = $('#resourceTree').jstree({
            'core' : {
                'data' : {
                    'url' : 'index.php?option=com_hummingbird&task=resources.getNode',
                    'data' : function (node) {
                        return { 'id' : node.id };
                    }
                }
            }
        }).on('changed.jstree', function (e, data) {
            if (data.node.data.jstree) {
                window.location = data.node.data.jstree.link;
            } else {
                return data.instance.toggle_node(data.node);
            }
        }).on('loaded.jstree', function() {
            // $treeview.jstree('open_all');
        });
    });
    function showTree () {
        jQuery('#resourceTreeContainer').toggle();
    }
</script>
<?php endif; ?>

<?php
// foreach ($this->items as $key => $value) {
//     echo $key . ' - ' . $value->name;
//     echo '<br>';
//     // print_r($value);
//     echo '<br>';
// }
?>
<h1><?php echo JText::_('COM_HUMMINGBIRD_RESOURCES_TITLE'); ?></h1>

<br>

<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="adminForm" name="adminForm">

<?php /*
	<fieldset class="filters btn-toolbar">
        <?php if ($hParams->get('display_resourceslist_display_search', false)): ?>
        <?php echo HummingbirdHelperList::filter ('search', array(
                'label'         => JText::_('COM_HUMMINGBIRD_ITEMS_SEARCH_FILTER_DESC'),
                'description'   => JText::_('COM_HUMMINGBIRD_ITEMS_SEARCH_FILTER'),
                'value'         => $this->escape($this->state->get('filter.resources.search'))
        )); ?>
        <?php endif; ?>

        <?php if ($hParams->get('display_resourceslist_display_categories_select', false)): ?>
        <?php echo HummingbirdHelperList::filter ('category', array(
                'label'         => JText::_('COM_HUMMINGBIRD_ITEMS_CATEGORY_FILTER'),
                'description'   => JText::_('COM_HUMMINGBIRD_ITEMS_CATEGORY_FILTER_DESC'),
                'value'         => $this->escape($this->state->get('filter.resources.category_id')),
        ));
        ?>
        <?php endif; ?>
	</fieldset>
*/ ?>
        <?php if ($hParams->get('display_resourceslist_display_categories_tree', false)): ?>
        <div id="resourceTreeContainer">
                <div id="resourceTree" class="resourceTree"></div>
        </div>
        <?php endif; ?>

        <?php /*
        <?php if (count($this->items) > 0) : ?>
                <?php
                $displayData = new stdClass();
                $displayData->items = $this->items;
                $displayData->pagination = $this->pagination;
                $displayData->hParams = $hParams;

                echo JLayoutHelper::render('resources_list', $displayData, null, array ('client' => 1)); ?>
        <?php else : ?>
                <?php echo JLayoutHelper::render('resources_list.noitems', $displayData, null, array ('client' => 1)); ?>
        <?php endif; ?>
        */ ?>

        <div>
                <input type="hidden" name="option" value="com_hummingbird" />
                <input type="hidden" name="view" value="resources" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
                <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
