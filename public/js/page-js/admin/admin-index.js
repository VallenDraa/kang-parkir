import { qs, qsa } from "../../utils/dom-selector.js";
import { initAdminTooltip } from "./admin-tooltip.js";
import * as T from "../../utils/types.js";

const tambahMotorBtn = qs("#tambah-motor-btn");
const submitMotorBtn = qs("#submit-motor-btn");
const hapusMotorforms = qsa("#hapus-motor-form");
const inputPlat = qs("[name='plat-motor']");

const opsiUser = qsa("#opsi-user");
const editUserBtn = qsa("#edit-user-btn");
const listMotorUser = qs("#list-motor-user");

/** @type {HTMLInputElement} */
const platUserBaruCheckbox = qs("[name='plat-user-baru']");

/** @type {HTMLSelectElement} */
const platUserLamaSelection = qs("[name='plat-user-lama']");

/** @type {HTMLDialogElement} */
const actionDialog = qs("#action-dialog");
const closeActionDialogBtn = qs("#close-action-dialog-btn");

// konten dialog
const formTambahMotor = qs("#form-tambah-motor");
const formEditUser = qs("#form-edit-user");

// inisialisasi
initAdminTooltip();

// tampilkan modal ketika tombol tambah motor ditekan
tambahMotorBtn?.addEventListener("click", () => {
  actionDialog?.showModal();

  formEditUser?.classList.add("hidden");
  formTambahMotor?.classList.remove("hidden");
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

  formEditUser?.classList.add("hidden");
  formTambahMotor?.classList.add("hidden");
});

// matikan opsi untuk memasukkan plat ke user lama
platUserBaruCheckbox?.addEventListener("change", e => {
  if (e.target.checked) {
    platUserLamaSelection.setAttribute("disabled", e.target.checked);
  } else {
    if (opsiUser.length > 0) platUserLamaSelection.removeAttribute("disabled");
  }
});

editUserBtn?.forEach(btn => {
  btn.addEventListener("click", async () => {
    actionDialog?.showModal();

    const idUser = btn.getAttribute("data-id-user");

    // ambil data motor milik user
    try {
      const HTMLListMotor = await fetch(
        "../../../../parkiran-dua/api/cari-motor.php",
        {
          method: "POST",
          body: JSON.stringify({ "id-user": parseInt(idUser) }),
        },
      ).then(res => res.text());

      // reset list motor user
      listMotorUser.innerHTML = HTMLListMotor;

      formEditUser?.classList.remove("hidden");
      formTambahMotor?.classList.add("hidden");
    } catch (error) {
      console.error(error);
    }
  });
});
