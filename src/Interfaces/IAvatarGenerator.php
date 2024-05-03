<?php

namespace Ferchd\Avatarize\Interfaces;

interface IAvatarGenerator
{
	/**
	 * @param string $text
	 * @param int $fontSize
	 * @param string|null $path
	 * @return string
	 */
	public function generate(string $text, int $fontSize, ?string $path): string;
}