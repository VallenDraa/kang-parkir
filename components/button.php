<?php

function Button(string $content, string $color, string $html_id): string
{
  $id = $html_id ? "id='$html_id'" : "";

  $class = "class='px-4 py-2 font-medium text-white transition-colors duration-200 bg-$color-500 rounded-md shadow hover:bg-$color-400 shadow-$color-400 active:shadow-sm hover:shadow-lg active:bg-$color-600'";

  $button = "<button $id $class>$content</button>";

  return $button;
}
