import { inputHalaman } from "./admin-index.js";

export function adminTabel() {
  let timeoutId;

  inputHalaman?.addEventListener("input", () => {
    // cek nilai dari halaman
    if (Number.isNaN(inputHalaman.valueAsNumber)) {
      inputHalaman.value = 1;
    }

    // hanya akan berganti halaman ketika
    // tidak ada perubahan nilai setealh 1.5 detik
    // ini dinamakan 'debounce'
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      if (inputHalaman.valueAsNumber > window.tabelMaksHalaman) {
        inputHalaman.value = window.tabelMaksHalaman;
      }
      window.location.href = `?tab=${window.tabAktif}&halaman=${inputHalaman.value}`;
    }, 1200);
  });
}
