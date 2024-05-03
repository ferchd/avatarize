<?php

namespace Ferchd\Avatarize\Strategies;

define("DEFAULT_FONT_PATH", __DIR__ . "/../Assets/Fonts/Ubuntu-Medium.ttf");

use Ferchd\Avatarize\Interfaces\IAvatarGenerator;
use GdImage;

abstract class BaseAvatarGenerator implements IAvatarGenerator
{
	/**
	 * @param string $text
	 * @param int $fontSize
	 * @return false|GdImage
	 */
	protected function build(string $text, int $fontSize): false|GdImage
	{
		$initials = $this->getInitials($text);
		$randomColor = $this->getRandomColor($text);
		$complementaryColor = $this->getComplementaryColor($randomColor);

		$image = imagecreatetruecolor(100, 100);

		$backgroundColor = imagecolorallocate($image, $randomColor[0], $randomColor[1], $randomColor[2]);
		$fontColor = imagecolorallocate($image, $complementaryColor[0], $complementaryColor[1], $complementaryColor[2]);

		imagefilledrectangle($image, 0, 0, 99, 99, $backgroundColor);
		$box = imagettfbbox($fontSize, 0, DEFAULT_FONT_PATH, $initials);

		$x = $box[0] + (imagesx($image) / 2) - ($box[4] / 2) - 5;
		$y = $box[1] + (imagesy($image) / 2) - ($box[5] / 2) - 5;

		imagettftext($image, $fontSize, 0, $x, $y, $fontColor, DEFAULT_FONT_PATH, $initials);

		return $image;

	}

	/**
	 * @param string $text
	 * @return string
	 */
	private function getInitials(string $text): string
	{
		$words = explode(" ", $text, 3);
		return ucfirst($words[0][0]) . ucfirst($words[1][0]);
	}

	/**
	 * @param string $text
	 * @return array
	 */
	private function getRandomColor(string $text): array
	{
		return sscanf(substr(md5($text), 0, 6), "#%02x%02x%02x");
	}

	/**
	 * @param array $backgroundColor
	 * @return array
	 */
	private function getComplementaryColor(array $backgroundColor): array
	{
		if (((0.299 * $backgroundColor[0] + 0.587 * $backgroundColor[1] + 0.114 * $backgroundColor[2]) / 255) > 0.5) {
			return [255, 255, 255];
		}
		return [36, 36, 36];
	}
}