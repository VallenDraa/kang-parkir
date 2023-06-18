import { printLaporan, targetPrint } from "./admin-laporan.js";

export function adminPdf() {
  printLaporan.setAttribute("disabled", true);

  printLaporan?.addEventListener("click", () => window.print());

  // menunggu grafik selesai dibuat
  setTimeout(() => {
    printLaporan.removeAttribute("disabled");
  }, 1000);
}
