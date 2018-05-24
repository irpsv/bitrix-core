<?php

namespace olof_core\components\classes;

class SorterView extends \CBitrixComponent
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

		$columns = (array) ($this->arParams['columns'] ?? []);
		if (empty($columns)) {
			throw new \Exception("Parametr 'columns' must be array");
		}

		$this->arResult['sorter'] = new \olof_core\data\Sorter($columns);
		$this->includeComponentTemplate();
	}
}
