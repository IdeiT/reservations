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
JHtml::_('behavior.formvalidation');

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/image.php';

$hParams         = $this->hParams;
$user            = JFactory::getUser();
$requestsEnabled = (isset($this->resource->item->parent) && $this->resource->item->parent->requests_enabled) || $this->resource->item->requests_enabled;

// Replace {article_link:text} with an <a> tag filled
if (! empty($this->article)) {
    //var_dump($this->article);
    $article_href = JRoute::_('index.php?option=com_content&view=article&catid='. $this->article->catid .'&id=' . $this->article->id);
    $replace_count = preg_match('/{article_link:(?<text>.+)}/', $this->resource->item->description, $matches);
    if ($replace_count > 0) {
        $replace_with = '<a href="' . $article_href . '" title="${1}">${1}</a>';
        $this->resource->item->description = preg_replace('/{article_link:(?<text>.+)}/', $replace_with, $this->resource->item->description);
    }
}
?>
<?php if ($requestsEnabled): ?>
<script type="text/javascript">
    <?php echo $this->resource->displayJavaScript(); ?>
</script>
<?php endif; ?>

<form action="<?php echo JFactory::getUri()->toString() ; ?>" method="post" id="adminForm" name="adminForm" class="form-validate">

        <div itemscope itemtype="<?php echo $hParams->get('resources_schema_url', 'http://schema.org/Thing'); ?>">

            <div class="pager-header">

                <?php // Title
                // Process title
                $name = '<span itemprop="name">' . $this->resource->item->name . '</span>';
                if ($requestsEnabled) {
                    $title = sprintf(JText::_('COM_HUMMINGBIRD_REQUEST_ADD_ELEMENT'), '<i>' . $name) . '</i>';
                } else {
                    $title = $name;
                }

                if ((! empty($this->resource->item->parent)) && $hParams->get('display_resource_layout_display_parent_title', true)) : ?>
                        <h1 itemprop="name"><?php echo $this->resource->item->parent->name; ?></h1>
                        <?php if ($hParams->get('display_resource_layout_display_title', true)) : ?>
                                <h2><?php echo $title; ?></h2>
                        <?php endif; ?>
                <?php else : ?>
                    <?php if ($hParams->get('display_resource_layout_display_title', true)) : ?>
                        <h1><?php echo $name; ?></h1>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="page-content">

                <?php // Category (subresources display the parent category)
                if ((! empty($this->resource->item->parent)) && $hParams->get('display_resource_layout_display_category', true)) : ?>
                        <div class="category">
                                <?php echo $this->resource->item->parent->category; ?>
                        </div>
                <?php elseif ($hParams->get('display_resource_layout_display_category', true)) : ?>
                        <div class="category-intro">
                                <?php echo $this->resource->item->category; ?>
                        </div>
                <?php endif; ?>

                <?php // Brother selectors
                $displayDataResourceBrothers = new stdClass();
                $displayDataResourceBrothers->resource = $this->resource;
                $displayDataResourceBrothers->hParams = $this->hParams;
                echo JLayoutHelper::render('resource.brothers', $displayDataResourceBrothers, null, array('client' => 1));
                ?>

                <?php // Children selectors
                $displayDataResourceChildren = new stdClass();
                $displayDataResourceChildren->resource = $this->resource;
                $displayDataResourceChildren->hParams = $this->hParams;
                echo JLayoutHelper::render('resource.children', $displayDataResourceChildren, null, array('client' => 1));
                ?>

                <?php // Intro text (sub resource will show the parent intro text)
                if ((! empty($this->resource->item->parent)) && $hParams->get('display_resource_layout_display_intro', true)) : ?>
                        <div class="page-excerpt"><?php echo $this->resource->item->parent->introText; ?></div>
                <?php elseif ($hParams->get('display_resource_layout_display_intro', true)) : ?>
                        <div class="page-excerpt"><?php echo $this->resource->item->introText; ?></div>
                <?php endif; ?>

                <?php // Images
                $displayDataImages = new stdClass();
                $displayDataImages->item = $this->resource->item;
                $displayDataImages->hParams = $this->hParams;
                echo JLayoutHelper::render('images', $displayDataImages, null, array('client' => 1));
                ?>

                <?php // Price
                if ($hParams->get('display_prices_in_frontend')) :
                        echo JLayoutHelper::render('resource.price', $this->price, null, array('client' => 1));
                endif; ?>

                <?php // Description (sub resource will show the parent description)
                if ((! empty($this->resource->item->parent)) && $hParams->get('display_resource_layout_display_description', true)) : ?>
                        <div class="text-intro"><?php echo $this->resource->item->parent->description; ?></div>
                <?php elseif ($hParams->get('display_resource_layout_display_description', true)) : ?>
                        <div class="text-intro"><?php echo $this->resource->item->description; ?></div>
                <?php endif; ?>


                <?php // Related article (Joomla content)
                if ((! empty($this->article)) && ($replace_count == 0)) : ?>
                        <p>
                                <a href="<?php echo $article_href;?>">
                                        <?php echo JText::sprintf('COM_HUMMINGBIRD_RESOURCE_SHOW_RELATED_ARTICLE', $this->article->title); ?>
                                </a>
                        </p>
                <?php endif; ?>

            </div>

            <div class="mb-12 pt-4">

                <h2 class="mb-6"><?php echo JText::_('COM_HUMMINGBIRD_REQUEST_FORM_TITLE'); ?></h2>

                <?php // Properties
                echo $this->resource->displayProperties(); ?>
                <div style="clear: both;"></div>

                <?php // The resource controls for request (calendar, daterepater, ...)
                if ($requestsEnabled): ?>
                        <?php echo $this->resource->display(array('interactive' => true)); ?>
                        <div style="clear: both;"></div>
                <?php endif; ?>

                <?php // Custom fields for this resource on request
                if ($requestsEnabled): ?>
                    <?php echo $this->resource->displayCustomFields(); ?>
                <?php endif; ?>

                <?php // Add to request button
                if ($requestsEnabled): ?>
                    <div id="form-site-submit" class="control-group mt-4">
                        <div class="controls">
                            <button class="btn btn-primary btn-icon validate" name="Submit" tabindex="0" type="button" onclick="Joomla.submitbutton('resource.save'); return false;">
                                <?php //echo sprintf(JText::_('COM_HUMMINGBIRD_REQUEST_ADD_ELEMENT'), '<i>' . $this->resource->item->name) . '</i>'; ?>
                                <?php echo JText::_('COM_HUMMINGBIRD_REQUEST_ADD_ELEMENT_SIMPLE'); ?>
                            </button>
                            <small style="display:none; margin-left: 15px;"><?php echo $this->resource->item->name; ?></small>
                        </div>

                        <div id="system-message-container" class="error-messages mt-4"></div>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <input type="hidden" name="option" value="com_hummingbird" />
        <input type="hidden" name="view" value="resource" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="resource_id" value="<?php echo $this->resource->item->id; ?>" />

        <?php echo JHtml::_('form.token'); ?>
</form>
