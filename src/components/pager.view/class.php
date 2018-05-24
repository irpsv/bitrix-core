<?php

namespace olof_core\components\classes;

class PagerView extends \CBitrixComponent
{
	public function executeComponent()
	{
		// кеширование
		$cacheTime = $this->arParams['CACHE_TIME'] ?? 3600;
		$cacheAdditionalId = null;
		$cachePath = preg_replace('/[^a-z0-9]/i', '_', __CLASS__);
		if ($this->startResultCache($cacheTime, $cacheAdditionalId, $cachePath)) {
			$this->run();
			$this->endResultCache();
		}
	}

	public function run()
	{
		\CModule::includeModule('olof_core');

		$pageNow = (int) ($this->arParams['pageNow'] ?? 1);
		if ($pageNow < 1) {
			throw new \Exception("Parametr 'pageNow' must be greater 1");
		}

		$pageSize = (int) ($this->arParams['pageSize'] ?? 10);
		if ($pageSize < 1) {
			throw new \Exception("Parametr 'pageSize' must be greater 1");
		}

		$totalCount = (int) $this->arParams['totalCount'];
		if ($totalCount < 1) {
			throw new \Exception("Parametr 'totalCount' must be greater 1");
		}

		$this->arResult['pager'] = new \olof_core\data\Pager($pageSize, $totalCount, $pageNow);
		$this->includeComponentTemplate();
	}
}
