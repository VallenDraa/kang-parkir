/** @param {string} selector */
export function qs(selector) {
  return document.querySelector(selector);
}

/** @param {string} selector */
export function qsa(selector) {
  return document.querySelectorAll(selector);
}
