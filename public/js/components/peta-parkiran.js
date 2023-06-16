import { qs, qsa } from "../utils/dom-selector.js";
import { CustomDialog } from "./dialog.js";

export class PetaParkiran {
  /** @type {HTMLElement[]} */
  #slotParkiran;

  /** @type {CustomDialog} */
  #dialogDetailMotor;

  /**
   * @param {string} slotParkiran
   * @param {CustomDialog} dialogDetailMotor
   */
  constructor(slotParkiran, dialogDetailMotor) {
    this.#slotParkiran = qsa(slotParkiran);
    this.#dialogDetailMotor = dialogDetailMotor;

    this.#slotParkiran?.forEach(slot => {
      const motorYangParkir = slot.getAttribute("data-plat-motor") || null;
      const lokasiParkir = slot.getAttribute("data-no-token");

      // inisialisasi tooltip pada slot parkiran
      tippy(slot, {
        content: motorYangParkir
          ? `${motorYangParkir} Parkir Di ${lokasiParkir}`
          : `${lokasiParkir} Kosong`,
      });

      if (!this.#dialogDetailMotor) {
        return;
      }

      const namaPemilikSpan =
        this.#dialogDetailMotor.dialogEl.querySelector("#nama-pemilik");
      const platMotorSpan =
        this.#dialogDetailMotor.dialogEl.querySelector("#plat-motor");
      const tanggalMasukSpan =
        this.#dialogDetailMotor.dialogEl.querySelector("#tanggal-masuk");
      const lokasiParkirSpan =
        this.#dialogDetailMotor.dialogEl.querySelector("#lokasi-parkir");

      slot.addEventListener("click", async () => {
        if (!motorYangParkir) {
          return;
        }

        try {
          const { pemilik, plat, tanggal_masuk, lokasi_parkir } = await fetch(
            `../api/cari-motor-dari-plat.php?plat=${motorYangParkir}`,
          ).then(res => res.json());

          namaPemilikSpan.textContent = pemilik;
          platMotorSpan.textContent = plat;
          tanggalMasukSpan.textContent = tanggal_masuk;
          lokasiParkirSpan.textContent = lokasi_parkir;

          this.#dialogDetailMotor.openDialog();
        } catch (error) {
          console.error(error);
        }
      });
    });
  }
}
