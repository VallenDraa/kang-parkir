import { qs } from "../utils/dom-selector.js";

export class CustomDialog {
  /** @type {HTMLDialogElement | null} */
  #dialogEl;

  /** @type {HTMLButtonElement | null} */
  #closeButtonEl;

  static #closeAnimationClasses = [
    "backdrop:opacity-0",
    "scale-95",
    "opacity-0",
  ];

  static #openAnimationClasses = [
    "backdrop:opacity-100",
    "scale-100",
    "opacity-100",
  ];

  static #classes =
    "backdrop:transition-opacity backdrop:transition-300 transition duration-300 m-0 max-w-[100vw] max-h-screen md:m-auto w-screen h-screen md:rounded-lg shadow-md shadow-gray-300 md:w-[650px] md:h-max md:backdrop:backdrop-blur-sm ease-out"
      .split(" ")
      .concat(CustomDialog.#closeAnimationClasses);

  /**
   * @param {string} dialogSelector
   * @param {string} dialogSelector
   * @param {() => void | null} dialogSelector
   */
  constructor(dialogSelector, closeBtnSelector, onClose = null) {
    this.#dialogEl = qs(dialogSelector);
    this.#closeButtonEl = qs(closeBtnSelector);

    this.#dialogEl?.classList.add(...CustomDialog.#classes);

    // sembunyikan dialog ketika backdrop di click
    this.#dialogEl?.addEventListener("click", e => {
      const rect = this.#dialogEl.getBoundingClientRect();
      const isInDialog =
        rect.top <= e.clientY &&
        e.clientY <= rect.top + rect.height &&
        rect.left <= e.clientX &&
        e.clientX <= rect.left + rect.width;

      if (!isInDialog) {
        this.hideDialog(onClose);
      }
    });

    this.#closeButtonEl?.addEventListener("click", () => {
      this.hideDialog(onClose);
    });
  }

  /** @param {boolean} open  */
  #openAnimation(open) {
    this.#dialogEl?.classList[open ? "add" : "remove"](
      ...CustomDialog.#openAnimationClasses,
    );
  }

  /** @param {boolean} open  */
  #closeAnimation(open) {
    this.#dialogEl?.classList[open ? "add" : "remove"](
      ...CustomDialog.#closeAnimationClasses,
    );
  }

  openDialog(callback = null) {
    document.body.style.overflow = "hidden";

    this.#dialogEl?.showModal();

    this.#closeAnimation(false);
    this.#openAnimation(true);

    if (callback) callback();
  }

  hideDialog(callback = null) {
    document.body.style.overflow = "auto";

    this.#openAnimation(false);
    this.#closeAnimation(true);

    setTimeout(() => {
      this.#dialogEl?.close();

      if (callback) callback();
    }, 300);
  }
}
