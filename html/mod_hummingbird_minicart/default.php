<?php
/**
 * @package     Joomla.Site
 * @subpackage  Hummingbird
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$jinput = JFactory::getApplication()->input;
$joption = $jinput->get('option');
$jview = $jinput->get('view');

// echo $joption;
// echo '<br>';
// echo $jview;

// print_r($displayData);
?>

<div class="widgetbox widgetbox-gray mb-6 widgetbox-minicart">

    <?php if ($joption === 'com_hummingbird' && $jview === 'request' ) : ?>

        <?php if ( isset($request) && ! isset($request->item) ) : ?>

            <h3><?php echo JText::_('MOD_HUMMINGBIRD_MINICART_TITLE'); ?></h3>
            <div class="paragraph mb-6">Queres solicitar máis servizos?</div>
            <a class="btn btn-secondary btn-icon" href="<?php echo JRoute::_('index.php?option=com_hummingbird&view=resources'); ?>">Engadir servizos</a>

        <?php endif; ?>

    <?php else : ?>
        <h3><?php echo JText::_('MOD_HUMMINGBIRD_MINICART_TITLE'); ?></h3>
        <p><?php echo JText::_('MOD_HUMMINGBIRD_MINICART_TITLE_SERVICES'); ?></p>

        <div class="minicart">

            <?php if ( isset($request->elements) && count($request->elements) > 0) : ?>

                    <ul class="list-content mb-6">
                        <?php foreach ($request->elements as $element) : ?>
                        <li>
                            <?php echo $element->translated_name; ?>
                            <?php if ($request->item->prices_visible) : ?>
                                <div class="price"><?php echo $element->price; ?></div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>

                        <?php if ($request->item->prices_visible) : ?>
                            <li style="text-align: right;">
                                <span style="padding-right: 15px;"><?php echo JText::_('MOD_HUMMINGBIRD_MINICART_PRICE_TOTAL'); ?>:</span>
                                <div class="price"><strong><?php echo $request->item->price; ?></strong></div>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <a class="readmore_999 btn btn-primary btn-icon" href="<?php echo JRoute::_('index.php?option=com_hummingbird&view=request&id=' . (int) $request->item->id); ?>">
                        <?php echo JText::_('MOD_HUMMINGBIRD_MINICART_SHOW_REQUEST'); ?>
                    </a>

                    <p class="advice">
                        <?php echo JText::_('MOD_HUMMINGBIRD_MINICART_ADVICE_1'); ?>
                        <br>
                        <?php echo JText::_('MOD_HUMMINGBIRD_MINICART_ADVICE_2'); ?>
                    </p>

            <?php else : ?>
                <p class="font-weight-regular"><?php echo JText::_('MOD_HUMMINGBIRD_MINICART_EMPTY'); ?></p>
            <?php endif; ?>

        </div>
    <?php endif; ?>
</div>

