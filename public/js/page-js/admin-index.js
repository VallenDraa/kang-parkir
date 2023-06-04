import { qs, qsa } from "../utils/dom-selector.js";

const tambahMotorBtn = qs("#tambah-motor-btn");
const submitMotorBtn = qs("#submit-motor-btn");
const hapusMotorforms = qsa("#hapus-motor-form");
const inputPlat = qs("[name='plat-motor']");

/** @type {HTMLDialogElement} */
const actionDialog = qs("#action-dialog");
const closeActionDialogBtn = qs("#close-action-dialog-btn");

tambahMotorBtn?.addEventListener("click", () => {
  actionDialog?.showModal();
});

hapusMotorforms?.forEach(form => {
  form.addEventListener("submit", e => {
    e.preventDefault();

    const konfirmasiHapus = confirm(
      "Apakah anda yakin ingin menghapus motor ini ?",
    );

    if (konfirmasiHapus) form.submit();
  });
});

submitMotorBtn?.addEventListener("click", () => {
  if (inputPlat.value !== "") {
    actionDialog?.close();
  }
});

closeActionDialogBtn?.addEventListener("click", () => {
  actionDialog?.close();
});
