<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<?php if (count($arResult['QUESTIONS']) > 0) : ?>
    <div class="question-block" itemscope="" itemtype="https://schema.org/FAQPage">
        <div class="question-block__title">
            <div class="question-block__icon"></div>
            <div class="question-block__desc">Часто задаваемые вопросы</div>
        </div>
        <div class="question-block__body">
            <?php foreach ($arResult['QUESTIONS'] as $key => $question) : ?>
                <div class="question-block__item question-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <div data-trigger="<?=$key?>" class="question-item__title js-accordion-trigger" itemprop="name">
                        <?=$question['TITLE']?>
                    </div>
                    <div class="question-item__body js-accordion trigger_<?=$key?>" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <?=$question['ANSWER']?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
