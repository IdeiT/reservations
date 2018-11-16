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

JHtml::_('behavior.modal');
JHtml::_('behavior.formvalidation');

// Load extra validators
$doc = JFactory::getDocument();
$field = null;
$lang = JFactory::getLanguage();

$doc->addScript(JURI::root() . '/media/com_hummingbird/js/validators.js');
$date_format = JText::_('COM_HUMMINGBIRD_CUSTOMFIELD_CALENDAR_FORMAT');
$lang_tag = $lang->getTag();
 
?>
<script type="text/javascript">
        // Date client validation
        jQuery( document ).ready(function( $ ) {
                //document.formvalidator.setDefaults({ ignore: ":hidden:not(.chosen-select)" }) //for all select having class .chosen-select
                if (document.formvalidator) {
                        document.formvalidator.setHandler('date', function (value) {                        
                                Locale.use ('<?php echo $lang_tag; ?>');               
                                var d = Date.defineParser('<?php echo $date_format; ?>').parse (value);
                                return d.isValid();                               
                        });
                }
        });         
        
        var elementEdited = false;                          
        window.SqueezeBox.initialize({
                onClose:function(){
                        if (elementEdited) {
                                window.location = window.location;
                        }                        
                }
        });        
        
	Joomla.submitbutton = function(task)
	{                                
		if (task != 'request.cancel') {
			<?php //echo $this->form->getField('description')->save(); ?>
                                                
                        if (document.formvalidator) {
                                if (document.formvalidator.isValid(document.getElementById('adminForm'))) {                                                
                                        Joomla.submitform(task, document.getElementById('siteForm'));
                                }
                        } else {
                                Joomla.submitform(task, document.getElementById('siteForm'));
                        }
                }
	}
        
        function deleteRequestElement (element_id) {
                if (! confirm ('<?php echo JText::_('COM_HUMMINGBIRD_REQUEST_ELEMENTS_CONFIRM_DELETE'); ?>')) {
                        return false;
                }        
        
                $('requestElement').value = element_id;
                Joomla.submitbutton ('request.deleteElement');
        }
                    
        
</script>
<form action="<?php echo JRoute::_('index.php?option=com_hummingbird&view=request&id=' . $this->request->item->id); ?>" method="post" id="siteForm" name="siteForm">
            
        <?php echo JLayoutHelper::render('request', $this->request, null, array ('client' => 1, 'pluginsContent' =>  implode("\n", $this->pluginsContent))); ?>        
    
        
        <input type="hidden" name="option" value="com_hummingbird" />
        <input type="hidden" name="id" value="<?php echo $this->request->item->id; ?>" />
        <input type="hidden" name="view" value="request" />
        <input type="hidden" id="task" name="task" value="" />
        <input type="hidden" id="requestElement" name="requestElement" value="" />
        <?php echo JHtml::_('form.token'); ?>
</form>