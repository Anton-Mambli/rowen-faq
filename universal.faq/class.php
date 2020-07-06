<?php

namespace Avenumed\Components;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Avenumed\Main\Orm\Faq\FaqAnalizesTable;
use Avenumed\Main\Orm\Faq\FaqArticleTable;
use Avenumed\Main\Orm\Faq\FaqSpecializationTable;
use \Bitrix\Main\Loader;

class UnversalFaq extends \CBitrixComponent
{
    private $elementId = 0;
    
    public function executeComponent()
    {
        $this->elementId = (int) $this->arParams['ELEMENT_ID'];
        
        $this->arResult['QUESTIONS'] = $this->getQuestions();
        
        $this->includeComponentTemplate();
    }
    
    private function getQuestions() : array
    {
        if ($this->elementId <= 0) {
            return [];
        }
        
        Loader::includeModule('iblock');
        
        $queryResult = [];
        
        switch ($this->arParams['FAQ_IBLOCK_ID']) {
            case FAQ_ARTICLE_IBLOCK_ID:
                $queryResult = $this->articleQuery();
                break;
            case FAQ_ANALIZES_IBLOCK_ID:
                $queryResult = $this->analizesQuery();
                break;
            case FAQ_SPECIALIZATION_IBLOCK_ID:
                $queryResult = $this->specializationQuery();
                break;
        }
        
        return $queryResult;
    }

    private function articleQuery()
    {
        return FaqArticleTable::query()
            ->addFilter('=IBLOCK_ID', $this->arParams['FAQ_IBLOCK_ID'])
            ->addFilter('ACTIVE', 'Y')
            ->addSelect('ID')
            ->addSelect('NAME', 'TITLE')
            ->addSelect('DETAIL_TEXT', 'ANSWER')
            ->addFilter('UTS.ARTICLE', $this->elementId)
            ->fetchAll();
    }
    
    private function analizesQuery()
    {
        return FaqAnalizesTable::query()
            ->addFilter('=IBLOCK_ID', $this->arParams['FAQ_IBLOCK_ID'])
            ->addFilter('ACTIVE', 'Y')
            ->addSelect('ID')
            ->addSelect('NAME', 'TITLE')
            ->addSelect('DETAIL_TEXT', 'ANSWER')
            ->addFilter('UTS.ANALIZE', $this->elementId)
            ->fetchAll();
    }
    
    private function specializationQuery()
    {
        return FaqSpecializationTable::query()
            ->addFilter('=IBLOCK_ID', $this->arParams['FAQ_IBLOCK_ID'])
            ->addFilter('ACTIVE', 'Y')
            ->addSelect('ID')
            ->addSelect('NAME', 'TITLE')
            ->addSelect('DETAIL_TEXT', 'ANSWER')
            ->addFilter('UTS.SPECIALIZATION', $this->elementId)
            ->fetchAll();
    }
}
