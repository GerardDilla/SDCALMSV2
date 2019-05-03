<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php if ($title) echo $title; ?></title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net">

        <?php if ($header) echo $header; ?>

	</head>
	<body>
    <section class="body">

    <!--Navbar Component-->
    <?php if ($navbar) echo $navbar; ?>
    <!--/Navbar Component-->

    <!--Sidebar & Body-->
    <div class="inner-wrapper">

        <!--Sidebar Component-->
        <?php if ($sidebar) echo $sidebar; ?>
        <!--/Sidebar Component-->

        <!--Body Component-->
        <?php if ($middle) echo $middle; ?>
        <!--/Body Component-->

        <!--Footer Component-->
        <?php if ($footer) echo $footer; ?>
        <!--/Footer Component-->

    </div>
    <!--/Sidebar & Body-->

    </section>

    <!--Script-->
    <?php if ($script) echo $script; ?>
    <!--/Script-->
	</body>
</html>