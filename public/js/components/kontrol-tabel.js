import { qs } from "../utils/dom-selector.js";

export class KontrolTabel {
  /** @type {HTMLInputElement} */
  #inputHalaman;

  constructor(inputHalaman, callback) {
    this.#inputHalaman = qs(inputHalaman);

    let timeoutId;

    this.#inputHalaman?.addEventListener("input", () => {
      // cek nilai dari halaman
      if (Number.isNaN(this.#inputHalaman.valueAsNumber)) {
        this.#inputHalaman.value = 1;
      }

      // hanya akan berganti halaman ketika
      // tidak ada perubahan nilai setealh 1.5 detik
      // ini dinamakan 'debounce'
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => {
        if (this.#inputHalaman.valueAsNumber > window.tabelMaksHalaman) {
          this.#inputHalaman.value = window.tabelMaksHalaman;
        }

        callback(this.#inputHalaman.value);
      }, 1200);
    });
  }
}
