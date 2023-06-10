import { qs } from "../utils/dom-selector.js";

export class Sidebar {
  static #backdropClasses =
    "opacity-0 transition-opacity duration-300 ease-out bg-gray-600/50 md:backdrop-blur-sm absolute z-[12000]".split(
      " ",
    );

  static #sidebarClasses =
    "-translate-x-full transition-transform duration-300 shadow shadow-gray-300 absolute w-full md:w-96 h-screen bg-gray-50 z-[15000] left-0".split(
      " ",
    );

  static #escCloseTelahDiSetel = false;

  /**@type {HTMLElement} */
  #sidebar;

  /**@type {HTMLElement} */
  #backdrop;

  /**@type {HTMLElement} */
  #menuBtn;

  /**@type {HTMLElement} */
  #mainContent;

  /**@type {HTMLElement} */
  #closeBtn;

  terbuka = false;

  /**
   * @param {string} sidebar
   * @param {string} backdrop
   * @param {string} menuBtn
   * @param {string} `closeBtn`
   * @param {string} mainContent
   *
   * pastikan sidebar ada diluar HTML mainContent
   */
  constructor(sidebar, backdrop, menuBtn, closeBtn, mainContent) {
    this.#sidebar = qs(sidebar);
    this.#backdrop = qs(backdrop);
    this.#mainContent = qs(mainContent);
    this.#menuBtn = qs(menuBtn);
    this.#closeBtn = qs(closeBtn);

    // menambahkan kelas ke elemen
    this.#backdrop?.classList.add(...Sidebar.#backdropClasses);
    this.#sidebar?.classList.add(...Sidebar.#sidebarClasses);

    this.#menuBtn?.addEventListener("click", () => {
      this.openSidebar();
    });

    this.#closeBtn?.addEventListener("click", () => {
      this.closeSidebar();
    });

    // tertutup ketika backdrop ditekan
    this.#backdrop.addEventListener("click", () => {
      this.closeSidebar();
    });

    // sembunyikan dialog ketika escape ditekan
    if (!Sidebar.#escCloseTelahDiSetel) {
      window.addEventListener("keyup", e => {
        if (!this.terbuka) return;

        if (e.key === "Escape") {
          this.closeSidebar();
        }
      });
      Sidebar.#escCloseTelahDiSetel = true;
    }
  }

  openSidebar() {
    this.#openSidebarAnimation();
    this.terbuka = true;
  }

  closeSidebar() {
    this.#closeSidebarAnimation();
    this.terbuka = false;
  }

  #openSidebarAnimation() {
    document.body.style.overflowX = "hidden";
    this.#backdrop.classList.add("inset-0");
    this.#backdrop.classList.replace("opacity-0", "opacity-100");

    this.#sidebar?.classList.remove("-translate-x-full");

    this.#mainContent?.classList.add("translate-x-96", "2xl:translate-x-64");
  }

  #closeSidebarAnimation() {
    this.#backdrop.classList.replace("opacity-100", "opacity-0");

    setTimeout(() => {
      this.#backdrop.classList.remove("inset-0");
      document.body.style.overflowX = "auto";
    }, 300);

    this.#sidebar?.classList.add("-translate-x-full");

    this.#mainContent?.classList.remove("translate-x-96", "2xl:translate-x-64");
  }
}
