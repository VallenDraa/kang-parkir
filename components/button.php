<?php

function Button(string $content, string $color, ?string $html_id = null): string
{
  $id = $html_id ? "id='$html_id'" : "";

  $class = "class='px-4 py-2 font-medium text-white transition-colors bg-gradient-to-b from-$color-400 to-$color-500 rounded-md hover:from-$color-300 hover:to-$color-400 shadow-$color-500 shadow-sm active:from-$color-500 active:to-$color-600'";

  $button = "<button $id $class>$content</button>";

  return $button;
}
