import { CustomDialog } from "../../components/dialog.js";
import { KontrolTabel } from "../../components/kontrol-tabel.js";
import { PetaParkiran } from "../../components/peta-parkiran.js";
import { Sidebar } from "../../components/sidebar.js";
import { Tema } from "../../components/tema.js";

new Sidebar(
  "#sidebar",
  "#hamburger-menu-btn",
  "#close-sidebar-btn",
  "#content",
);

new KontrolTabel("#input-halaman", halaman => {
  window.location.href = `?halaman=${halaman}&keyword=${window.keyword}`;
});

new Tema("#tema-btn", "#icon-tema");

const dialogDetailMotorTerparkir = new CustomDialog(
  "#dialog",
  "#close-dialog-btn",
);

new PetaParkiran(
  "#slot-parkiran",
  dialogDetailMotorTerparkir,
  "./api/cari-motor-dari-plat.php",
);
