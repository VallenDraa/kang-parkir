import { qs } from "../utils/dom-selector.js";

export class Tema {
  /** @type {"dark" | "light"} */
  #tema = "light";

  /** @type {HTMLButtonElement} */
  #tombolToggle;

  #icon;

  /**
   * @param {string} tombolToggle
   * @param {string} icon
   */
  constructor(tombolToggle, icon) {
    this.#tombolToggle = qs(tombolToggle);
    this.#icon = qs(icon);

    // untuk mengecek apakah ada tema yang tersimpan di local storage
    const temaTersimpan = localStorage.getItem("tema");

    if (!temaTersimpan) {
      this.#tema = window.matchMedia("(prefers-color-scheme: dark)").matches
        ? "dark"
        : "light";

      localStorage.setItem("tema", this.#tema);
    } else {
      this.#tema = temaTersimpan;
    }

    this.#update();

    // mentoggle tema ketika tombol toggle ditekan
    this.#tombolToggle?.addEventListener("click", () => {
      this.#tema = this.#tema === "light" ? "dark" : "light";

      localStorage.setItem("tema", this.#tema);

      this.#update();
    });
  }

  #update() {
    // perbarui style di html
    if (this.#tema === "light") {
      document.documentElement.classList.remove("dark");
    } else {
      document.documentElement.classList.add(this.#tema);
    }

    document.documentElement.style.colorScheme = this.#tema;

    this.#icon?.classList.replace(
      this.#tema === "dark" ? "fa-solid" : "fa-regular",
      this.#tema === "dark" ? "fa-regular" : "fa-solid",
    );
  }

  get tema() {
    return this.#tema;
  }
}
