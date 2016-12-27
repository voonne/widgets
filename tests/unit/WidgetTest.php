<?php

namespace Voonne\TestWidgets;

use Codeception\Test\Unit;
use Mockery;
use UnitTester;
use Voonne\Widgets\Widget;


class WidgetTest extends Unit
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	/**
	 * @var Widget
	 */
	private $widget;


	protected function _before()
	{
		$this->widget = new Widget();
	}


	protected function _after()
	{
		Mockery::close();
	}


	public function testSetTitle()
	{
		$this->assertNull($this->widget->getTitle());

		$this->widget->setTitle('title');

		$this->assertEquals('title', $this->widget->getTitle());
	}

}
