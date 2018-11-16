<?php defined( '_JEXEC' ) or die;

// variables
$doc = JFactory::getDocument();
$tpath = $this->baseurl.'/templates/'.$this->template;

// generator tag
$this->setGenerator(null);

// load sheets and scripts
// $doc->addStyleSheet($tpath.'/css/print.css?v=1');

JHtml::_('stylesheet', 'print.css', array('version' => 'auto', 'relative' => true));

?><!doctype html>

<html lang="<?php echo $this->language; ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <jdoc:include type="head" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700" type="text/css" />

  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/reservations/dist/styles/main.css" type="text/css" />
</head>

<body id="print">
  <div id="overall">

    <div class="wrap container" role="document">
        <div class="content">
            <main class="main">

                <jdoc:include type="message" />
                <jdoc:include type="component" />

            </main>
        </div>
    </div>

  </div>
  <?php // if ($_GET['print'] == '1') echo '<script type="text/javascript">window.print();</script>'; ?>
</body>

</html>
