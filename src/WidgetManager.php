<?php

/**
 * This file is part of the Voonne platform (http://www.voonne.org)
 *
 * Copyright (c) 2016 Jan Lavička (mail@janlavicka.name)
 *
 * For the full copyright and license information, please view the file licence.md that was distributed with this source code.
 */

namespace Voonne\Widgets;

use Nette\SmartObject;
use Nette\Utils\Strings;
use ReflectionClass;


class WidgetManager
{

	use SmartObject;

	private $widgets = [];


	public function addWidget(Widget $widget, $priority = 100)
	{
		$name = Strings::firstLower((new ReflectionClass($widget))->getShortName());

		if (isset($this->getWidgets()[$name])) {
			throw new DuplicateEntryException("Widget named '" . get_class($widget) . "' is already exists.");
		}

		$this->widgets[$priority][$name] = $widget;
	}


	/**
	 * @return array
	 */
	public function getWidgets()
	{
		$widgets = [];

		krsort($this->widgets);

		foreach ($this->widgets as $priority) {
			foreach ($priority as $name => $widget) {
				$widgets[$name] = $widget;
			}
		}

		return $widgets;
	}

}
