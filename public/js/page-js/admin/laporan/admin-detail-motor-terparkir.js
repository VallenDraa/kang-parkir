import { qs } from "../../../utils/dom-selector.js";
import { dialogDetailMotorTerparkir, slotParkiran } from "./admin-laporan.js";

export function adminDetailMotorTerparkir() {
  const namaPemilik = qs("#nama-pemilik");
  const platMotor = qs("#plat-motor");
  const tanggalMasuk = qs("#tanggal-masuk");
  const lokasiParkir = qs("#lokasi-parkir");

  slotParkiran.forEach(slot => {
    slot.addEventListener("click", async e => {
      const platMotorTerparkir = e.target.getAttribute("data-plat-motor");

      if (!platMotorTerparkir) {
        return;
      }

      try {
        const { pemilik, plat, tanggal_masuk, lokasi_parkir } = await fetch(
          `../api/cari-motor-dari-plat.php?plat=${platMotorTerparkir}`,
        ).then(res => res.json());

        namaPemilik.textContent = pemilik;
        platMotor.textContent = plat;
        tanggalMasuk.textContent = tanggal_masuk;
        lokasiParkir.textContent = lokasi_parkir;

        dialogDetailMotorTerparkir.openDialog();
      } catch (error) {
        console.error(error);
      }
    });
  });
}
