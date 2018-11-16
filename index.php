<?php defined( '_JEXEC' ) or die;

include_once JPATH_THEMES.'/'.$this->template.'/logic.php';

unset($this->_scripts[JURI::root(true).'/media/jui/js/bootstrap.min.js']);

$component_input = JFactory::getApplication()->input;
$sidebar_class = 'sidebar-primary';
// if ( $component_input->get('option') === 'com_users' ) {
//     $sidebar_class = '';
// }

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <jdoc:include type="head" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700" type="text/css" />

  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/reservations/dist/styles/main.css" type="text/css" />
</head>

<body class="<?php echo (isset($active) ? $active->alias : '') . ' ' . $pageclass; ?> <?php echo $sidebar_class; ?>">
  <jdoc:include type="modules" name="header" />

  <div class="wrap container" role="document">
    <div class="content">

      <nav class="breadcrumb-nav" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ecimat/"><?php echo JText::_('TPL_RESERVATIONS_RESOURCES_TITLE'); ?></a></li>
            <li class="breadcrumb-item"><a href="/ecimat/portal-de-reservas/"><?php echo JText::_('TPL_RESERVATIONS_RESOURCES_RESERVATION_PORTAL'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo JText::_('TPL_RESERVATIONS_RESOURCES_REQUEST_SERVICE_TITLE'); ?></li>
        </ol>
      </nav>

      <main class="main">

      <jdoc:include type="modules" name="top" />
        <jdoc:include type="component" />

        <jdoc:include type="modules" name="debug" />
        <jdoc:include type="modules" name="bottom" />

      </main>

        <aside class="sidebar">
            <jdoc:include type="modules" name="right" />
        </aside>

    <?php /*
      <?php if ( $component_input->get('option') !== 'com_users' ) : ?>
        <aside class="sidebar">
            <jdoc:include type="modules" name="right" />
        </aside>
      <?php else : ?>
          <aside class="sidebar">
            <jdoc:include type="modules" name="user1" />
          </aside>
      <?php endif; ?>
      */ ?>

    </div>
  </div>

  <jdoc:include type="modules" name="footer" />

  <script src="templates/reservations/dist/scripts/main.js"></script>
</body>
</html>
