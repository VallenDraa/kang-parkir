import {
  actionDialog,
  editUserBtns,
  formEditUser,
  formTambahMotor,
  hapusUserforms,
} from "./admin-index.js";
import { qs } from "../../utils/dom-selector.js";

export function editUserHandler(users) {
  editUserBtns?.forEach(btn => {
    btn.addEventListener("click", async () => {
      actionDialog?.openDialog();

      const idUser = parseInt(btn.getAttribute("data-id-user"));

      // TODO: error handling ketika idUser tidak ada
      if (!idUser) {
        console.error("Id user tidak ada");
      }

      const { username, is_admin: isAdmin } = users.find(u => u.id === idUser);

      // ambil data motor milik user
      try {
        const motorArr = await fetch(
          `../../../../parkiran-dua/api/cari-motor-dari-user-id.php?id-user=${idUser}`,
        ).then(res => res.json());

        // isi list motor di dalam dialog
        let htmlListMotor = "";
        motorArr.forEach(m => {
          htmlListMotor += `
          <li class="flex gap-5">
            <span>${m.plat}</span>
            <span>${m.lokasi_parkir}</span>
            <span>${new Date(m.tanggal_masuk).toLocaleString()}</span>
          </li>
          `;
        });

        qs("#list-motor-user").innerHTML = htmlListMotor;

        // isi data di dalam form
        qs("#id-user-edit").value = idUser;
        qs("[name='username']").value = username;
        qs("[name='is-admin']").checked = isAdmin === "1";

        formEditUser?.classList.remove("hidden");
        formTambahMotor?.classList.add("hidden");
      } catch (error) {
        console.error(error);
      }
    });

    // konfirmasi ketika menghapus motor
    hapusUserforms?.forEach(form => {
      form.addEventListener("submit", e => {
        e.preventDefault();

        const konfirmasiHapus = confirm(
          "Apakah anda yakin ingin menghapus user ini ?",
        );

        if (konfirmasiHapus) form.submit();
      });
    });
  });
}
