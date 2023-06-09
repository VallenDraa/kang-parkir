/**
 *
 * @param {"dark" | "light"} theme
 */
export function initAdminTooltip(theme = "light") {
  const settings = {
    theme: "dark",
  };

  tippy("#edit-user-btn", { ...settings, content: "Edit User" });
  tippy("#hapus-user-btn", { ...settings, content: "Hapus User" });

  tippy("#info-motor-btn", { ...settings, content: "Info Motor" });
  tippy("#hapus-motor-btn", { ...settings, content: "Hapus Motor" });
}
