<?php

/**
 * @param "type adalah primary, secondary, link"
 */
function Button(string $content, string $color, string $type, ?string $html_id = null): string
{
  $id = $html_id ? "id='$html_id'" : "";

  $class = "px-5 py-1 rounded-lg ";

  switch (strtolower($type)) {
    case 'primary':
      $class .=
        "text-white bg-gradient-to-b from-$color-400 to-$color-500 shadow-$color-300 shadow hover:opacity-70 active:opacity-95 active:shadow-none";
      break;

    case 'secondary':
      $class .=
        "text-$color-500 hover:text-white active:text-white bg-gradient-to-b border border-$color-500 hover:bg-gradient-to-b hover:from-$color-400 hover:to-$color-500 active:bg-gradient-to-b active:from-$color-400 active:to-$color-500 hover:shadow active:shadow shadow-$color-300 hover:opacity-70 active:opacity-95 active:shadow-none";
      break;

    case 'link':
      $class .=
        "text-$color-500 hover:text-$color-400 hover:opacity-70 active:opacity-95";
      break;
  }


  $button = "<button $id class='$class'>$content</button>";

  return $button;
}
