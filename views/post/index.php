<!-- masonry -->
<section class="s-bricks">
    <div class="masonry">
        <div class="bricks-wrapper h-group">
            <div class="grid-sizer"></div>

            <?php use yii\helpers\Html;
            use yii\helpers\Url;

            foreach ($dataProvider->getModels() as $model):
                $img = null;
                if(isset($model->images[0]->image_url)){
                    $img = $model->images[0]->image_url;
                }else if($model->category->name == 'Programming'){
                    $img = '/images/writer.png';
                }else{
                    $img = '/images/home.jpg';
                }
                ?>
                <article class="brick entry format-standard animate-this">
                    <div class="entry__thumb">
                        <a href="<?= Url::to(['/post/view?id='.$model->id]) ?>" class="thumb-link">
                            <!-- Display image using Yii alias -->
                            <img class="card-img" src="<?= Yii::getAlias('@web') . '/images/'.$img ?>"
                                 srcset="<?= Yii::getAlias('@web') .  $img  ?> 1x, <?= Yii::getAlias('@web') . '/images/'. $img  ?> 2x"
                                 alt="<?= Html::encode($model->title) ?>">

                        </a>

                    </div> <!-- end entry__thumb -->

                    <div class="entry__text">
                        <div class="entry__header">
                            <h1 class="entry__title"><a href="<?= Url::to(['/post/view?id='.$model->id]) ?>"><?= $model->title ?></a></h1>
                        </div>
                        <div class="entry__excerpt">

                            <p><?= rtrim(substr($model->body, 0, rand(100, 280)+20), '.') . ' ...' ?></p>
                        </div>
                    </div> <!-- end entry__text -->
                </article> <!-- end brick entry -->
            <?php endforeach; ?>

        </div> <!-- end bricks-wrapper -->
    </div> <!-- end masonry -->

    <!-- Pagination Section -->
    <div class="row">
        <div class="column large-12">
            <nav class="pgn">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                    'options' => [
                        'class' => 'pgn__list',
                    ],
                    'linkOptions' => [
                        'class' => 'pgn__num',
                    ],
                    'activePageCssClass' => 'pgn__num inactive',
                    // Set prevPageLabel and nextPageLabel to false to prevent empty elements
                    'prevPageLabel' => '< ',
                    'nextPageLabel' => ' >',
                ]); ?>

            </nav>


        </div> <!-- end column -->
    </div> <!-- end row -->
</section> <!-- end s-bricks -->