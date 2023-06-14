import { qs, qsa } from "../../../utils/dom-selector.js";
import { adminMotorHandler } from "./admin-motor-handler.js";
import { editUserHandler } from "./admin-user-handler.js";
import { initAdminTooltip } from "./admin-tooltip.js";
import { CustomDialog } from "../../../components/dialog.js";
import { adminTabel } from "./admin-tabel.js";
import { Sidebar } from "../../../components/sidebar.js";

export const tambahMotorBtn = qs("#tambah-motor-btn");
export const submitMotorBtn = qs("#submit-motor-btn");
export const hapusMotorforms = qsa("#hapus-motor-form");
// export const inputPlat = qs("[name='plat-motor']");

export const opsiUser = qsa("#opsi-user");
export const editUserBtns = qsa("#edit-user-btn");
export const hapusUserforms = qsa("#hapus-user-form");

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

export const sidebar = new Sidebar(
  "#sidebar",
  "#hamburger-menu-btn",
  "#close-sidebar-btn",
  "#content",
);

// konten tabel
/** @type {HTMLInputElement} */
export const inputHalaman = qs("#input-halaman");

// konten dialog
export const dialogTitle = qs("#dialog-title");
export const formTambahMotor = qs("#form-tambah-motor");
export const formEditUser = qs("#form-edit-user");

// inisialisasi
initAdminTooltip();
editUserHandler(window.users);
adminMotorHandler();
adminTabel();
