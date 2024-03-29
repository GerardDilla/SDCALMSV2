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

        <style>

            ul li{
                color: #AAAAAA;
                display: block;
                position: relative;
                float: left;
                width: 100%;
                height: 100px;
                    border-bottom: 1px solid #333;
            }

            ul li input[type=radio]{
                position: absolute;
                visibility: hidden;
            }

            ul li label{
                display: block;
                position: relative;
                font-weight: 300;
                font-size: 1.35em;
                padding: 25px 25px 25px 80px;
                margin: 10px auto;
                height: 30px;
                z-index: 9;
                cursor: pointer;
                -webkit-transition: all 0.25s linear;
            }

            ul li:hover label{
                color: #FFFFFF;
            }

            ul li .check{
                display: block;
                position: absolute;
                border: 5px solid #AAAAAA;
                border-radius: 100%;
                height: 25px;
                width: 25px;
                top: 30px;
                left: 20px;
                    z-index: 5;
                    transition: border .25s linear;
                    -webkit-transition: border .25s linear;
            }

            ul li:hover .check {
                border: 5px solid #FFFFFF;
            }

            ul li .check::before {
                display: block;
                position: absolute;
                    content: '';
                border-radius: 100%;
                height: 15px;
                width: 15px;
                top: 5px;
                    left: 5px;
                margin: auto;
                    transition: background 0.25s linear;
                    -webkit-transition: background 0.25s linear;
            }

            input[type=radio]:checked ~ .check {
                border: 5px solid #0DFF92;
            }

            input[type=radio]:checked ~ .check::before{
                background: #0DFF92;
            }

            input[type=radio]:checked ~ label{
                color: #0DFF92;
            }
        </style>

	</head>
	<body>

    <!--Body-->
    <section>
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