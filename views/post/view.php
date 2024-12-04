<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<section class="s-content s-content--single">
    <div class="row">
        <div class="column large-12">
            <article class="s-post entry format-standard">

                <?php if (isset($post->images) and !empty($post->images)) { ?>
                    <div class="masonry">
                        <div class="s-content__media">
                            <div class="s-content__post-thumbs">
                                <?php foreach (array_slice($post->images, 0, 4) as $image): ?>
                                    <div class="s-content__post-thumb">
                                        <?php
                                        // Get image dimensions if available
                                        $imageSize = getimagesize(Yii::getAlias('@webroot') . $image->image_url);
                                        $width = $imageSize[0] ?? null;
                                        $height = $imageSize[1] ?? null;
                                        ?>
                                        <?= Html::img(Yii::getAlias('@web') . $image->image_url, [
                                            'sizes' => '(max-width: 2100px) 100vw, 2100px',
                                            'alt' => 'Picture here',
                                            'data-width' => $width,
                                            'data-height' => $height
                                        ]) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="s-content__primary">
                    <h2 class="s-content__title s-content__title--post"><?= Html::encode($post->title) ?></h2>

                    <ul class="s-content__post-meta">
                        <li class="date"><?= Yii::$app->formatter->asDate($post->created_at, 'php:F j, Y') ?></li>
                        <li class="cat">
                            <?= Html::a($post->category->name, ['category/view', 'id' => $post->category_id]) ?>
                        </li>
                    </ul>

<!---->
<!--                    <blockquote>-->
<!--                        <p>--><?php //= Html::encode($post->brief) ?><!--</p>-->
<!--                        <cite>--><?php //= Html::encode($post->user->username) ?><!--</cite>-->
<!--                    </blockquote>-->

                    <p><?= Html::encode($post->body) ?></p>



                    <div class="s-content__pagenav group">
                        <?php if (isset($prevPost)): ?>
                            <div class="prev-nav">
                                <a href="view?id=<?= $prevPost->id ?>" rel="prev">
                                    <span>Previous</span>
                                    <?= Html::encode($prevPost->title) ?>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="prev-nav">
                                <a href="." class="disabled" rel="prev" onclick="return false;">
                                    <span>Current</span>
                                    This is the first post
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($nextPost)): ?>
                            <div class="next-nav">
                                <a href="view?id=<?= $nextPost->id ?>" rel="next">
                                    <span>Next</span>
                                    <?= Html::encode($nextPost->title) ?>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="next-nav">
                                <a href="." class="disabled" rel="next" onclick="return false;">
                                    <span>Current</span>
                                    This is the last post
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </article>
        </div>
    </div>

    <!-- comments -->
    <div class="comments-wrap">
        <div id="comments" class="row">
            <div class="column">
                <div class="row comment-respond">
                    <div id="respond" class="column">
                        <h3>Leave Comment</h3>
                        <form id="commentForm" autocomplete="off"
                              data-url="<?= Url::to(['posts/send-comment']) ?>"
                              data-csrf="<?= Yii::$app->request->csrfToken ?>">
                            <fieldset>
                                <div class="form-field">
                                    <input name="cName" id="cName" class="h-full-width" placeholder="Your Name" type="text">
                                </div>

                                <div class="form-field">
                                    <input name="cWebsite" id="cWebsite" class="h-full-width" placeholder="Telegram username" type="text">
                                </div>
                                <div class="message form-field">
                                    <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                                </div>
                                <input name="post_id" id="post_id" type="hidden" value="<?= $post->id ?>">
                                <button type="button" id="submitComment" class="btn btn--primary btn-wide btn--large h-full-width">
                                    Leave Comment
                                </button>
                            </fieldset>
                        </form>
                        <div id="commentFeedback" style="margin-top: 20px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>