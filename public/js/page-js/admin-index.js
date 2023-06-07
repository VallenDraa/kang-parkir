import { qs, qsa } from "../utils/dom-selector.js";

const tambahMotorBtn = qs("#tambah-motor-btn");
const submitMotorBtn = qs("#submit-motor-btn");
const hapusMotorforms = qsa("#hapus-motor-form");
const inputPlat = qs("[name='plat-motor']");

/** @type {HTMLInputElement} */
const platUserBaruCheckbox = qs("[name='plat-user-baru']");

/** @type {HTMLSelectElement} */
const platUserLamaSelection = qs("[name='plat-user-lama']");

/** @type {HTMLDialogElement} */
const actionDialog = qs("#action-dialog");
const closeActionDialogBtn = qs("#close-action-dialog-btn");

// tampilkan modal ketika tombol tambah motor ditekan
tambahMotorBtn?.addEventListener("click", () => {
  actionDialog?.showModal();
});

// konfirmasi ketika menghapus motor
hapusMotorforms?.forEach(form => {
  form.addEventListener("submit", e => {
    e.preventDefault();

    const konfirmasiHapus = confirm(
      "Apakah anda yakin ingin menghapus motor ini ?",
    );

    if (konfirmasiHapus) form.submit();
  });
});

// tutup modal ketika mengsubmit motor baru
submitMotorBtn?.addEventListener("click", () => {
  if (inputPlat.value !== "") {
    actionDialog?.close();
  }
});

// tutup modal ketika user meneka tombol x pada modal
closeActionDialogBtn?.addEventListener("click", () => {
  actionDialog?.close();
});

// matikan opsi untuk memasukkan plat ke user lama
platUserBaruCheckbox?.addEventListener("change", e => {
  if (e.target.checked) {
    platUserLamaSelection.setAttribute("disabled", e.target.checked);
  } else {
    platUserLamaSelection.removeAttribute("disabled");
  }
});
