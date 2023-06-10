<?php
function infoJs(string $info, ?string $redirect): string
{
  $redirect_js = $redirect !== null ?  "window.location.href = '$redirect';" : "";

  return "<script>alert('$info'); $redirect_js</script>";
}
