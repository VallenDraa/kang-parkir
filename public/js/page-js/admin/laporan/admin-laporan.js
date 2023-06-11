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
export const dataMotorPerhariChart = qs("#data-motor-perhari");
export const userMotorTerbanyakChart = qs("#user-motor-terbanyak");
export const motorDurasiParkirTerlamaChart = qs("#motor-durasi-parkir-terlama");

// inisialisasi
document.addEventListener("DOMContentLoaded", () => {
  adminChart();
});
