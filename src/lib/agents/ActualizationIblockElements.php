<?php

namespace olof_core\agents;

class ActualizationIblockElements
{
	public static function runAgent()
	{
		$self = new self();
		$self->run();
		return __METHOD__.'();';
	}

	public function run()
	{
		// деактивация элементов, у которых подошел срок
	}
}
