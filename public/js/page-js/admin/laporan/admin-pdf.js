import { printLaporan, targetPrint } from "./admin-laporan.js";

export function adminPdf() {
  printLaporan.setAttribute("disabled", true);

  printLaporan?.addEventListener("click", () => {
    window.print();

    // html2pdf(targetPrint, {
    //   margin: 1,
    //   image: { type: "jpeg", quality: 0.98 },
    //   filename: `laporan_${new Date().toLocaleString()}.pdf`,
    //   html2canvas: {
    //     width: 2250,
    //     height: 1080,
    //     windowWidth: 1280,
    //     windowHeight: 720,
    //   },
    //   jsPDF: {
    //     orientation: "landscape",
    //     unit: "px",
    //     format: "a4",
    //   },
    // });
  });

  setTimeout(() => {
    printLaporan.removeAttribute("disabled");
  }, 1000);
}
