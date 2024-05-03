<?php

namespace Ferchd\Avatarize\Strategies;

class PNGAvatarGenerator extends BaseAvatarGenerator
{

	/**
	 * @param string $text
	 * @param int $fontSize
	 * @param string|null $path
	 * @return string
	 */
	public function generate(string $text, int $fontSize, ?string $path): string
	{
		$image = $this->build($text, $fontSize);

		if (empty($path)) {
			$path = sprintf("%s.png", time());
		}

		return imagepng($image, $path);
	}
}