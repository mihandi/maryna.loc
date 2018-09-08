<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gamma Gallery - A Responsive Image Gallery Experiment"/>
    <meta name="keywords" content="html5, responsive, image gallery, masonry, picture, images, sizes, fluid, history api, visibility api"/>
    <meta name="author" content="Codrops"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="/gamma_gallery/css/style.css"/>
    <script src="/gamma_gallery/js/modernizr.custom.70736.js"></script>
    <noscript><link rel="stylesheet" type="text/css" href="/gamma_gallery/css/noJS.css"/></noscript>
    <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
</head>
<body>
<div class="container">
    <div class="main">


        <div class="gamma-container gamma-loading" id="gamma-container">

            <ul class="gamma-gallery">
                <?php foreach($photos as $photo):?>
                    <li>
                        <div data-alt="img03" data-description="<h3>Sky high</h3>">
                            <div data-src="<?= '/elfinder/global/gallery/'.$gallery['dir_name'].'/'.$photo?>"></div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>

            <div class="gamma-overlay"></div>

            <div id="loadmore" class="loadmore">Example for loading more items...</div>

        </div>

    </div><!--/main-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/gamma_gallery/js/jquery.masonry.min.js"></script>
<script src="/gamma_gallery/js/jquery.history.js"></script>
<script src="/gamma_gallery/js/js-url.min.js"></script>
<script src="/gamma_gallery/js/jquerypp.custom.js"></script>
<script src="/gamma_gallery/js/gamma.js"></script>
<script type="text/javascript">

    $(function() {

        var GammaSettings = {
            // order is important!
            viewport : [ {
                width : 1200,
                columns : 5
            }, {
                width : 900,
                columns : 4
            }, {
                width : 500,
                columns : 3
            }, {
                width : 320,
                columns : 2
            }, {
                width : 0,
                columns : 2
            } ]
        };

        Gamma.init( GammaSettings );
    });

</script>
</body>

