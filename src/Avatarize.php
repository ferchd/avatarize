<?php

namespace Ferchd\Avatarize;

use Ferchd\Avatarize\Strategies\PNGAvatarGenerator;
use InvalidArgumentException;

readonly class Avatarize
{
	/**
	 * @param string $text
	 * @param string|null $path
	 * @param int $fontSize
	 * @return string
	 */
	public static function png(string $text, ?string $path = "", int $fontSize = 35): string
	{
		if (empty($text)) {
			throw new InvalidArgumentException();
		}
		return (new PNGAvatarGenerator())->generate($text, $fontSize, $path);
	}
}