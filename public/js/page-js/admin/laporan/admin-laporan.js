import { Sidebar } from "../../../components/sidebar.js";
import { qs } from "../../../utils/dom-selector.js";
import { adminChart } from "./admin-chart.js";

export const sidebar = new Sidebar(
  "#sidebar",
  "#sidebar-backdrop",
  "#hamburger-menu-btn",
  "#close-sidebar-btn",
  "#content",
);

export const kapasitasParkiranChart = qs("#kapasitas-parkiran");

export const dataMotorPeriodikChart = qs("#data-motor-perhari");
export const pilihanPeriodeMotor = qs("#pilihan-periode-motor");

export const printLaporan = qs("#print-laporan-btn");

// inisialisasi
adminChart();