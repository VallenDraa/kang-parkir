<?php
function Dialog(string $content, string $dialog_title, string $dialog_id, string $dialog_close_btn_id): string
{
  $id = $dialog_id ? "id = $dialog_id" : "";

  $close_btn_id = $dialog_close_btn_id ? "id = $dialog_close_btn_id" : "";
  $close_button = "
    <button $close_btn_id>
      <i class='fa fa-window-close' aria-hidden='true'></i>
    </button>
  ";

  $dialog = "
    <dialog 
      $id 
      class='w-screen h-screen rounded-md shadow-sm lg:w-[650px] lg:h-max backdrop:backdrop-blur-sm'
    >
      <div class='bg-gray-100'>
        <span>$dialog_title</span>
        $close_button
      </div>

      $content
    </dialog>
  ";

  return $dialog;
}
