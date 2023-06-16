import { qs } from "../utils/dom-selector.js";

export class Sidebar {
  static LEBAR_SIDEBAR_REM = 20;

  static #sidebarClasses =
    "fixed shadow shadow-slate-400 w-full md:w-80 h-screen bg-slate-50 z-[15000] left-0".split(
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

  terbuka = window.innerWidth >= 768;

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
      window.addEventListener("resize", () => {
        const { innerWidth } = window;

        if (this.terbuka) {
          if (innerWidth >= 768) {
            this.#mainContent?.classList.add("translate-x-80");
            this.#mainContent.style.width = `calc(100% - ${Sidebar.LEBAR_SIDEBAR_REM}rem)`;
          } else {
            this.#mainContent?.classList.remove("translate-x-80");
            this.#mainContent.style.width = `auto`;
          }
        }
      });

      Sidebar.#terinisiasiSekali = true;
    }

    // mengatur posisi awal sidebar
    if (window.innerWidth < 768) {
      this.#sidebar?.classList.add("-translate-x-full");
    }

    // mengatur posisi awal konten
    if (window.innerWidth >= 768) {
      this.#mainContent?.classList.add("translate-x-80");
      this.#mainContent.style.width = `calc(100% - ${Sidebar.LEBAR_SIDEBAR_REM}rem)`;
    } else {
      this.#mainContent?.classList.remove("translate-x-80");
      this.#mainContent.style.width = `auto`;
    }

    // ketika semua selesai di inisialiasi baru tambahkan transisi
    setTimeout(() => {
      this.#sidebar?.classList.add(
        "transition-transform",
        "duration-300",
        "ease-out",
      );

      this.#mainContent?.classList.add(
        "transition-transform",
        "duration-300",
        "ease-out",
      );
    }, 100);
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

    this.#mainContent?.classList.add("translate-x-80");

    if (window.innerWidth >= 768) {
      this.#mainContent.style.width = `calc(100% - ${Sidebar.LEBAR_SIDEBAR_REM}rem)`;
    }
  }

  #closeSidebarAnimation() {
    this.#sidebar?.classList.add("-translate-x-full");

    this.#mainContent?.classList.remove("translate-x-80");
    this.#mainContent.style.width = `auto`;
  }
}
