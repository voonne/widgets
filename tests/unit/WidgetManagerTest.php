<?php

namespace Voonne\TestWidgets;

use Codeception\Test\Unit;
use Mockery;
use Nette\Utils\Strings;
use ReflectionClass;
use UnitTester;
use Voonne\Widgets\DuplicateEntryException;
use Voonne\Widgets\Widget;
use Voonne\Widgets\WidgetManager;


class WidgetManagerTest extends Unit
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	/**
	 * @var WidgetManager
	 */
	private $widgetManager;


	protected function _before()
	{
		$this->widgetManager = new WidgetManager();
	}


	public function testAddPanel()
	{
		$widget1 = Mockery::mock(TestWidget1::class);
		$widget2 = Mockery::mock(TestWidget2::class);

		$name1 = Strings::firstLower((new ReflectionClass($widget1))->getShortName());
		$name2 = Strings::firstLower((new ReflectionClass($widget2))->getShortName());

		$this->widgetManager->addWidget($widget1);
		$this->widgetManager->addWidget($widget2, 110);

		$this->assertEquals([
			$name2 => $widget2,
			$name1 => $widget1
		], $this->widgetManager->getWidgets());
	}


	public function testAddPanelDuplicate()
	{
		$widget = Mockery::mock(TestWidget1::class);

		$this->widgetManager->addWidget($widget);

		$this->expectException(DuplicateEntryException::class);
		$this->widgetManager->addWidget($widget);
	}

}


class TestWidget1 extends Widget
{

}


class TestWidget2 extends Widget
{

}
