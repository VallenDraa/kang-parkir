import { KontrolTabel } from "../../components/kontrol-tabel.js";
import { Sidebar } from "../../components/sidebar.js";
import { Tema } from "../../components/tema.js";
import { qs } from "../../utils/dom-selector.js";

export const sidebar = new Sidebar(
  "#sidebar",
  "#hamburger-menu-btn",
  "#close-sidebar-btn",
  "#content",
);

new KontrolTabel("#input-halaman", halaman => {
  window.location.href = `?halaman=${halaman}&keyword=${window.keyword}`;
});

new Tema("#tema-btn", "#icon-tema");
