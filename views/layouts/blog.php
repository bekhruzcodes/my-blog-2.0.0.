<?php

use app\helpers\MyUrl;
use app\models\Category;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

/** @var string $content */
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="no-js" lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!-- CSS -->
        <link rel="stylesheet" href="<?= Url::to('@web/css/styles.css') ?>">
        <link rel="stylesheet" href="<?= Url::to('@web/css/vendor.css') ?>">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?= Url::to('@web/images/apple-touch-icon.png') ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::to('@web/images/favicon-96x96.png') ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Url::to('@web/images/b.png') ?>">
        <link rel="manifest" href="<?= Url::to('@web/site.webmanifest') ?>">
        <script src="<?= Url::to('@web/js/imagesloaded.pkgd.min.js') ?>"></script>


    </head>

    <body id="top">
    <?php $this->beginBody() ?>

    <!-- Preloader -->
    <div id="preloader">
        <div id="loader"></div>

    </div>

    <!-- Header -->
    <header class="s-header">
        <div class="row s-header__content">
            <div class="s-header__logo">
                <a class="logo" href="<?= MyUrl::to(['/']) ?>">
                    <img src="<?= Url::to('@web/images/b.png') ?>" alt="Homepage">
                </a>
            </div>

            <nav class="s-header__nav-wrap">
                <h2 class="s-header__nav-heading h6">Site Navigation</h2>
                <ul class="s-header__nav">
                    <li><a href="<?= MyUrl::to(['/']) ?>" title="">Home</a></li>
                    <li class="has-children">
                        <a href="." title="">Categories</a>
                        <ul class="sub-menu">
                            <?php
                            $categories = \app\models\Category::getAllCategories();
                            foreach ($categories as $category) {
                                ?>
                                <li>
                                    <a href="<?= MyUrl::to(['/post?category_id=' . ($category->id ?? 1)]) ?>"><?= $category->name ?? 'Not Found' ?></a>
                                </li>

                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?= MyUrl::to(['/site/about']) ?>" title="">About</a></li>
                    <li><a href="<?= MyUrl::to(['/site/contact']) ?>" title="">Contact</a></li>
                </ul>
                <a href="#" title="Close Menu" class="s-header__overlay-close close-mobile-menu"></a>
            </nav>

            <a class="s-header__toggle-menu" href="#" title="Menu"><span>Menu</span></a>
            <div class="s-header__search">
                <form role="search" name="searchForm" method="get" class="s-header__search-form"
                      action="<?= MyUrl::to(['/post/']) ?>">
                    <label>
                        <input type="search" class="s-header__search-field" placeholder="Type Your Keywords"
                               name="search"
                               autocomplete="off">
                    </label>
                    <input type="submit" class="s-header__search-submit" value="Search">
                </form>
                <a href="#" title="Close Search" class="s-header__overlay-close"></a>
            </div>
            <a class="s-header__search-trigger" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 18a7.952 7.952 0 004.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0018 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
                </svg>
            </a>
        </div>
    </header>

        <!-- Content -->
        <?= $content ?>

    <!-- Footer -->
    <footer class="s-footer">
        <div class="s-footer__main">
            <div class="row">

                <div class="column large-4 medium-12 tab-6 s-footer__site-links">
                    <h5>Site Links</h5>
                    <ul>
                        <li><a href="<?= MyUrl::to(['/site/about']) ?>">About Me</a></li>
                        <!-- Add other site links -->
                    </ul>
                </div>
                <div class="column large-4 medium-12 tab-6 s-footer__social-links">
                    <h5>Social</h5>
                    <ul>
                        <li><a href="https://t.me/Bek_and_dev">Telegram</a></li>

                    </ul>
                </div>
                <div class="column large-4 medium-12 s-footer__subscribe">
                    <h5>Subscribe</h5>
                    <div class="subscribe-form">
                        <form id="mc-form-unique" class="group" novalidate="novalidate"
                              data-submit-url="<?= MyUrl::to(['post/send-comment']) ?>">
                            <input type="email" name="dEmail" class="email" id="mc-email-unique"
                                   placeholder="Type & press enter" required="">
                            <input type="submit" name="subscribe">
                            <label for="mc-email-unique" class="subscribe-message-unique"></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="s-footer__bottom">
            <div class="row">
                <div class="column">
                    <div class="ss-copyright">
                        <span>© All rights reserved</span>
                        <span>Created by <a href="https://t.me//richard_9757/">Bekhruzbek</a></span>
                    </div>
                </div>
            </div>
            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M6 4h12v2H6zm5 10v6h2v-6h5l-6-6-6 6z"/>
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>