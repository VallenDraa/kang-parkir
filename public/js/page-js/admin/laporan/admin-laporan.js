import { CustomDialog } from "../../../components/dialog.js";
import { PetaParkiran } from "../../../components/peta-parkiran.js";
import { Sidebar } from "../../../components/sidebar.js";
import { qs, qsa } from "../../../utils/dom-selector.js";
import { adminChart } from "./admin-chart.js";
import { adminDetailMotorTerparkir } from "./admin-detail-motor-terparkir.js";

export const actionDialog = new CustomDialog(
  "#action-dialog",
  "#close-action-dialog-btn",
);

export const sidebar = new Sidebar(
  "#sidebar",
  "#hamburger-menu-btn",
  "#close-sidebar-btn",
  "#content",
);

export const petaParkiran = new PetaParkiran("#slot-parkiran");
export const slotParkiran = qsa("#slot-parkiran");

export const kapasitasParkiranChart = qs("#kapasitas-parkiran");

export const dataMotorPeriodikChart = qs("#data-motor-perhari");
export const pilihanPeriodeMotor = qs("#pilihan-periode-motor");

export const printLaporan = qs("#print-laporan-btn");

export const dialogDetailMotorTerparkir = new CustomDialog(
  "#dialog",
  "#close-dialog-btn",
);

// inisialisasi
adminChart();
adminDetailMotorTerparkir();
