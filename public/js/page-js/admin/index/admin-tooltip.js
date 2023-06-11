/**
 *
 * @param {"dark" | "light"} theme
 */
export function initAdminTooltip(theme = "light") {
  tippy("#edit-user-btn", { content: "Edit User" });
  tippy("#hapus-user-btn", { content: "Hapus User" });

  tippy("#halaman-sebelumnya-btn", { content: "Halaman Sebelumnya" });
  tippy("#halaman-berikutnya-btn", { content: "Halaman Berikutnya" });

  tippy("#info-motor-btn", { content: "Info Motor" });
  tippy("#hapus-motor-btn", { content: "Hapus Motor" });

  const themeTooltip = tippy("#theme-btn", { content: "Matikan Lampu" });
}
