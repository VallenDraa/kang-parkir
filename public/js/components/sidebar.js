import { qs } from "../utils/dom-selector.js";

export class Sidebar {
  static LEBAR_SIDEBAR_REM = 24;

  static #backdropClasses =
    "opacity-0 transition-opacity duration-300 ease-out bg-slate-600/50 md:backdrop-blur-sm fixed z-[12000]".split(
      " ",
    );

  static #sidebarClasses =
    "-translate-x-full fixed transition-transform duration-300 ease-out shadow shadow-slate-400 w-full md:w-96 h-screen bg-slate-50 z-[15000] left-0".split(
      " ",
    );

  static #terinisiasiSekali = false;

  /**@type {HTMLElement} */
  #sidebar;

  /**@type {HTMLElement} */
  #menuBtn;

  /**@type {HTMLElement} */
  #mainContent;

  /**@type {HTMLElement} */
  #closeBtn;

  terbuka = false;

  /**
   * @param {string} sidebar
   * @param {string} menuBtn
   * @param {string} closeBtn
   * @param {string} mainContent
   *
   * pastikan sidebar ada diluar HTML mainContent
   */
  constructor(sidebar, menuBtn, closeBtn, mainContent) {
    this.#sidebar = qs(sidebar);
    this.#mainContent = qs(mainContent);
    this.#menuBtn = qs(menuBtn);
    this.#closeBtn = qs(closeBtn);

    // menambahkan kelas ke elemen
    this.#sidebar?.classList.add(...Sidebar.#sidebarClasses);

    this.#menuBtn?.addEventListener("click", () => {
      if (this.terbuka) {
        this.closeSidebar();
      } else {
        this.openSidebar();
      }
    });

    this.#closeBtn?.addEventListener("click", () => {
      this.closeSidebar();
    });

    // sembunyikan dialog ketika escape ditekan
    if (!Sidebar.#terinisiasiSekali) {
      window.addEventListener("keyup", e => {
        if (!this.terbuka) return;

        if (e.key === "Escape") {
          this.closeSidebar();
        }
      });

      window.addEventListener("click", e => {
        if (
          !this.#menuBtn?.contains(e.target) &&
          !this.#sidebar?.contains(e.target)
        ) {
          this.closeSidebar();
        }
      });
      Sidebar.#terinisiasiSekali = true;
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
    this.#sidebar?.classList.remove("-translate-x-full");

    this.#mainContent?.classList.add("translate-x-96");

    if (window.innerWidth >= 768) {
      this.#mainContent.style.width = `calc(100% - ${Sidebar.LEBAR_SIDEBAR_REM}rem)`;
    }
  }

  #closeSidebarAnimation() {
    this.#sidebar?.classList.add("-translate-x-full");
    this.#mainContent?.classList.remove("translate-x-96");
    this.#mainContent.style.width = `auto`;
  }
}
