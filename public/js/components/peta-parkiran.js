import { qsa } from "../utils/dom-selector.js";

export class PetaParkiran {
  /** @type {HTMLElement[]} */
  #slotParkiran;

  constructor(slotParkiran) {
    this.#slotParkiran = qsa(slotParkiran);

    this.#slotParkiran?.forEach(slot => {
      const motorYangParkir = slot.getAttribute("data-plat-motor") || null;
      const lokasiParkir = slot.getAttribute("data-no-token");

      tippy(slot, {
        content: motorYangParkir
          ? `${motorYangParkir} Parkir Di ${lokasiParkir}`
          : `${lokasiParkir} Kosong`,
      });
    });
  }
}
