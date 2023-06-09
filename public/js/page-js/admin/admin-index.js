import { qs, qsa } from "../../utils/dom-selector.js";
import { adminMotorHandler } from "./admin-motor-handler.js";
import { editUserHandler } from "./admin-user-handler.js";
import { initAdminTooltip } from "./admin-tooltip.js";
import { CustomDialog } from "../../components/dialog.js";

export const tambahMotorBtn = qs("#tambah-motor-btn");
export const submitMotorBtn = qs("#submit-motor-btn");
export const hapusMotorforms = qsa("#hapus-motor-form");
export const inputPlat = qs("[name='plat-motor']");

export const opsiUser = qsa("#opsi-user");
export const editUserBtns = qsa("#edit-user-btn");

/** @type {HTMLInputElement} */
export const platUserBaruCheckbox = qs("[name='plat-user-baru']");

/** @type {HTMLSelectElement} */
export const platUserLamaSelection = qs("[name='plat-user-lama']");

export const actionDialog = new CustomDialog(
  "#action-dialog",
  "#close-action-dialog-btn",
  () => {
    formEditUser?.classList.add("hidden");
    formTambahMotor?.classList.add("hidden");
  },
);

// konten dialog
export const formTambahMotor = qs("#form-tambah-motor");
export const formEditUser = qs("#form-edit-user");

// inisialisasi
initAdminTooltip();
editUserHandler();
adminMotorHandler();
