<?php
namespace hybridmind\prevent_double_reg;


class ext extends \phpbb\extension\base
{

	public function is_enableable()
	{
		$config = $this->container->get('config');
		return version_compare($config['version'], '3.2.0', '>=');
	}
}
