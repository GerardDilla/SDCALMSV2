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

    <!--Body-->
    <section class="body-sign">
        <!--Body Component-->
        <?php if ($middle) echo $middle; ?>
        <!--/Body Component-->
    </section>
    <!--/Body-->

    <!--Script-->
    <?php if ($script) echo $script; ?>
    <!--/Script-->
	</body>
</html>